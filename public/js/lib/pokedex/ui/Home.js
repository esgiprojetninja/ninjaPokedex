import React from "react";
import {PropTypes as T} from 'prop-types';
import MapContainer from '../container/MapContainer';
import Cards from "../container/Cards";

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
                  <div className="col-md-12">
                    <Cards/>
                  </div>
                  <div className="col-md-6">
                    <div className="title-lg">
                      Le pokedex le plus complet et le plus rapide
                    </div>
                  </div>
                </section>
                <MapContainer/>
            </div>
        );
    }
}
