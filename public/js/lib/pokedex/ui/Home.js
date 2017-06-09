import React from "react";
import {PropTypes as T} from 'prop-types';

const styles = {
};

export default class Home extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
            <div className="container">
              <section className="index-wrapper">

              </section>
              <section className="map-wrapper">

              </section>
            </div>
        );
    }
}


// Home.propTypes = {
//     toggleNavbar: T.func.isRequired,
//     testAction: T.func.isRequired
// };
