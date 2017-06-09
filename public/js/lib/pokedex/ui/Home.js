import React from "react";
import {PropTypes as T} from 'prop-types';
import muiThemeable from 'material-ui/styles/muiThemeable';

const styles = {
};

class Home extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
            <div className="container full-height full-width">
              <section className="index-wrapper full-height full-width">

              </section>
              <section className="map-wrapper">

              </section>
            </div>
        );
    }
}

export default muiThemeable()(Home);
