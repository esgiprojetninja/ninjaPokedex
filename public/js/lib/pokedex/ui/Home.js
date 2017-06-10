import React from "react";
import {PropTypes as T} from 'prop-types';
import MapContainer from '../container/MapContainer';
import Cards from "../container/Cards";
import {Grid, Row, Col} from 'react-bootstrap';

const styles = {
};

export default class Home extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
          <Grid className="container full-height full-width">
            <section className="index-wrapper full-height full-width">
              <Row className="show-grid">
                <Col md={8} mdOffset={2}>
                  <Cards/>
                </Col>
                <Col md={6}>
                  <div className="title-lg">
                  </div>
                </Col>
              </Row>
            </section>
            <MapContainer/>
          </Grid>
        );
    }
}
