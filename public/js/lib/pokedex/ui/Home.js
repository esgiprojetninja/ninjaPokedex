import React from "react";
import {PropTypes as T} from 'prop-types';
import MapContainer from '../container/MapContainer';
import Carousel from "../container/Carousel";
import SubHome from "../container/SubHome";
import Table from "../container/Table";
import {Grid, Row, Col} from 'react-bootstrap';
import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';
import LocationSVG from 'material-ui/svg-icons/action/room';
import AddCircleOutlineSVG from 'material-ui/svg-icons/content/add-circle-outline';

export default class Home extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderHomeTable() {
      return (
        <Row className="show-grid">
          <Col md={12}>
            <Table/>
          </Col>
        </Row>
      )
    }

    renderHomeCarousel() {
      return (
        <Row className="show-grid">
          <Col md={8} mdOffset={2}>
            <Carousel/>
          </Col>
          <Col md={12}>
            <SubHome/>
          </Col>
        </Row>
      )
    }

    renderOnToggleView() {
      if( this.props.home.showCarousel ) {
        return this.renderHomeCarousel();
      } else {
        return this.renderHomeTable();
      }
    }

    render () {
        return (
          <Grid className="container full-height full-width">
            <section className="index-wrapper full-height full-width">
              <button onClick={this.props.toggleView}>toggleView</button>
              {this.renderOnToggleView()}
            </section>
            <MapContainer/>
          </Grid>
        );
    }
}

Home.propTypes = {
    toggleView: T.func.isRequired
};
