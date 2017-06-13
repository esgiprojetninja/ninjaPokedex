import React from "react";
import {PropTypes as T} from 'prop-types';
import { withGoogleMap, GoogleMap, Marker } from "react-google-maps";
import MapLegend from '../container/MapLegend';
import CircularProgress from 'material-ui/CircularProgress';

const styles = {
    containerElement: {
        height: '80%',
        minWidth: '320px',
        borderRadius: '10px'
    }
};

const chibar = targetMarker => {
    console.debug("right here right now:", targetMarker);
}


const GettingStartedGoogleMap = withGoogleMap(props => (
    <GoogleMap
      ref={props.onMapLoad}
      defaultZoom={3}
      defaultCenter={{ lat: -25.363882, lng: 131.044922 }}
      onClick={props.onMapClick}
    >
        {props.markers.map(marker => (
            <Marker
              {...marker}
              onRightClick={chibar}
            />
        ))}
    </GoogleMap>
));

export default class MapContainer extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    handleMapLoad = map => {
        if ( map ) {
            this._mapComponent = map;
        }
    }

    /*
    * This is called when you click on the map.
    * Go and try click now.
    */
    handleMapClick = event => {
        console.debug("handling map click,", event);
    }

    handleMarkerRightClick = targetMarker => {
        /*
        * All you modify is data, and the view is driven by data.
        * This is so called data-driven-development. (And yes, it's now in
        * web front end and even with google maps API.)
        */
        console.debug("handling map RIGHT click,", targetMarker);
    }

    renderSpinner() {
        return (
            <section style={{background: this.props.theme.current.palette.primary1Color}} className="map-wrapper full-height full-width display-flex-row space-around">
                <div style={{...styles.containerElement, background: this.props.theme.current.palette.primary2Color}} className="display-flex-column space-around margin-auto width-14">
                    <CircularProgress className="margin-auto" color="white" size={80} thickness={5}/>
                </div>
                <MapLegend/>
            </section>
        )
    }

    renderMap() {
        return (
            <section style={{background: this.props.theme.current.palette.primary1Color}} className="map-wrapper full-height full-width display-flex-row space-around">
                <GettingStartedGoogleMap
                    containerElement={
                      <div style={styles.containerElement} className="margin-auto width-14" />
                    }
                    mapElement={
                      <div className="full-height full-width" />
                    }
                    markers={this.props.pokemons.marked}
                    onMapLoad={this.handleMapLoad}
                    onMapClick={this.handleMapClick}
                />
              <MapLegend/>

            </section>
        );
    }

    render () {
        return ( this.props.pokemons.marked ) ?
            this.renderMap() :
            this.renderSpinner();
    }
}
MapContainer.propTypes = {
    navbar: T.shape({
        show: T.bool.isRequired,
    }).isRequired,
    pokemons: T.shape({
        isFetching: T.bool.isRequired,
    }).isRequired,
    theme: T.shape({}).isRequired,
};
