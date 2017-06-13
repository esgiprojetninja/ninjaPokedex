import React from "react";
import {PropTypes as T} from 'prop-types';
import { withGoogleMap, GoogleMap, Marker } from "react-google-maps";
import MapLegend from '../container/MapLegend';
import CircularProgress from 'material-ui/CircularProgress';

const styles = {
    containerElement: {
        height: '80%',
        minWidth: '320px'
    }
};

const GettingStartedGoogleMap = withGoogleMap(props => (
    <GoogleMap
      ref={props.onMapLoad}
      defaultZoom={3}
      defaultCenter={{ lat: -25.363882, lng: 131.044922 }}
      onClick={props.onMapClick}
    >
        {props.markers.map( (marker, key) => (
            <Marker
              {...marker}
              key={key}
              onRightClick={props.onMarkerRightClick}
            />
        ))}
    </GoogleMap>
));

export default class MapContainer extends React.PureComponent {
    constructor(props) {
        super(props);
        this._mapComponent = null;
    }

    handleMapLoad = map => {
        if ( map ) this._mapComponent = map;
    }

    handleMapClick = ({latLng}) => {
        console.debug("handling map click,", latLng);
        if ( this.props.mapLegend.placingPokemon ) {
            console.log("trying to place pokemon ", this)
            const marker = new google.maps.Marker({
                position: latLng,
                title: 'Hello World!',
                icon: this.props.mapLegend.selectedPokemon.icon
            });
            marker.setMap(this._mapComponent.getStreetView())
        }
    }

    handleMarkerRightClick = targetMarker => {
        /*
        * All you modify is data, and the view is driven by data.
        * This is so called data-driven-development. (And yes, it's now in
        * web front end and even with google maps API.)
        */
        console.debug("handling map RIGHT click,", targetMarker);
        targetMarker.stop();
    }

    renderSpinner() {
        return (
            <section style={{background: this.props.theme.current.palette.primary1Color}} className="map-wrapper full-height full-width display-flex-row space-around">
                <div style={{...styles.containerElement, background: this.props.theme.current.palette.primary2Color}} className="display-flex-column space-around margin-auto width-14">
                    <CircularProgress className="margin-reset" color="white" size={80} thickness={5}/>
                </div>
                <MapLegend/>
            </section>
        )
    }

    renderMap() {
        const focusStyle =  this.props.mapLegend.placingPokemon ? {border: "2px solid", borderColor: this.props.theme.current.palette.accent1Color} : {};
        return (
            <section style={{background: this.props.theme.current.palette.primary1Color, padding: "10px 0"}} className="map-wrapper full-height full-width display-flex-row space-around">
                <GettingStartedGoogleMap
                    containerElement={
                      <div style={{...styles.containerElement, ...focusStyle}} className="margin-auto width-14" />
                    }
                    mapElement={
                      <div className="full-height full-width" />
                    }
                    markers={this.props.pokemons.marked}
                    onMapLoad={this.handleMapLoad}
                    onMapClick={this.handleMapClick}
                    onMarkerRightClick={this.handleMarkerRightClick}
                />
              <MapLegend/>

            </section>
        );
    }

    render () {
        return ( this.props.pokemons.marked ) ?
            this.renderMap():
            this.renderSpinner();
    }
}
MapContainer.propTypes = {
    pokemons: T.shape({
        isFetching: T.bool.isRequired,
    }).isRequired,
    theme: T.shape({}).isRequired,
    mapLegend: T.shape({
        placingPokemon: T.bool.isRequired,
        selectedPokemon: T.shape({})
    }).isRequired,
};
