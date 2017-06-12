import React from "react";
import {PropTypes as T} from 'prop-types';
import { withGoogleMap, GoogleMap, Marker } from "react-google-maps";
import MapLegend from '../container/MapLegend';

const styles = {
    containerElement: {
        height: '80%',
        minWidth: '320px'
    }
};

const markers = [
  {
      position: {
        lat: 25.0112183,
        lng: 121.52067570000001,
      },
      key: 'Taiwan',
      defaultAnimation: 2,
  }
];
const GettingStartedGoogleMap = withGoogleMap(props => (
    <GoogleMap
      ref={props.onMapLoad}
      defaultZoom={3}
      defaultCenter={{ lat: -25.363882, lng: 131.044922 }}
      onClick={props.onMapClick}
    >
    </GoogleMap>
));

export default class MapContainer extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    handleMapLoad = map => {
        if ( map ) {
            console.log(map);
            this._mapComponent = map;
            console.log(map.getZoom());
        }
    }

    /*
    * This is called when you click on the map.
    * Go and try click now.
    */
    handleMapClick = event => {
        console.log("handling map click,", event);
    }

    handleMarkerRightClick = targetMarker => {
        /*
        * All you modify is data, and the view is driven by data.
        * This is so called data-driven-development. (And yes, it's now in
        * web front end and even with google maps API.)
        */
        console.log("handling map RIGHT click,", targetMarker);
    }

    render () {
        return (
            <section style={{background: this.props.theme.current.palette.primary1Color}} className="map-wrapper full-height full-width display-flex-row space-around">
                <GettingStartedGoogleMap
                    containerElement={
                      <div style={styles.containerElement} className="margin-auto width-14" />
                    }
                    mapElement={
                      <div className="full-height full-width" />
                    }
                    onMapLoad={this.handleMapLoad}
                    onMapClick={this.handleMapClick}
                />
              <MapLegend/>

            </section>
        );
    }
}
