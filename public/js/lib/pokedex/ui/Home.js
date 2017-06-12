import React from "react";
import {PropTypes as T} from 'prop-types';
import MapContainer from '../container/MapContainer';

const styles = {
};

export default class Home extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
            <div className="container full-height full-width">
              <section className="index-wrapper full-height full-width">

              </section>
              <MapContainer/>
            </div>
        );
    }
}
