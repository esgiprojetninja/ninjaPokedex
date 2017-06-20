import React from "react";
import {PropTypes as T} from 'prop-types';
import MapContainer from '../container/MapContainer';
import Cards from "../container/Cards";
import SubHome from "../ui/SubHome";
import {Grid, Row, Col} from 'react-bootstrap';
import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';
import LocationSVG from 'material-ui/svg-icons/action/room';
import AddCircleOutlineSVG from 'material-ui/svg-icons/content/add-circle-outline';

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
                <Col md={12}>
                  <SubHome/>
                </Col>
              </Row>
            </section>
            <MapContainer/>
          </Grid>
        );
    }
}
