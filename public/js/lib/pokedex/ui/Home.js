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
import DashboardSVG from 'material-ui/svg-icons/action/dashboard';
import IconButton from 'material-ui/IconButton';
import FullscreenSVG from 'material-ui/svg-icons/navigation/fullscreen';
import AddCircleOutlineSVG from 'material-ui/svg-icons/content/add-circle-outline';
import PokeSearch from '../container/PokeSearch';
import jQuery from 'jquery';
import Screenfull from 'screenfull';

const styles = {
  icon: {
    height: '30px',
    color: 'white'
  }
};

export default class Home extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderSearch() {
      return (
        <div>
          <PokeSearch/>
        </div>
      )
    }

    renderSearchWrapper() {
      if( this.props.navbar.showSearch ) {
        return this.renderSearch();
      }
    }

    renderHomeTable() {
      return (
        <Row className="show-grid full-height">
          <Col md={12} className="full-height">
            <Table/>
          </Col>
        </Row>
      )
    }

    renderHomeCarousel() {
      return (
        <Row className="show-grid" style={{height: '50vh'}}>
          <Col md={8} mdOffset={2}>
            <Carousel/>
          </Col>
          <Col md={12} style={{height: '50vh'}}>
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
          <Grid className="container full-height full-width" style={{padding: 0}}>
            <section className="index-wrapper full-height full-width">
              <img src="img/pokemon-logo.png" className="index-logo"/>
              <div style={{position: 'absolute', bottom: 0, right: 0, zIndex: 10000, opacity: 0.5, margin: '15px'}}>
                <IconButton onTouchTap={this.props.toggleView} iconStyle={styles.icon} tooltipPosition="top-center" tooltip="Changer de vue" children={<DashboardSVG/>}/>
                <IconButton onTouchTap={
                  () => {
                    if (Screenfull.enabled) {
                      Screenfull.toggle();
                    }
                  }
                } iconStyle={styles.icon} tooltipPosition="top-center" tooltip="Fullscreen" children={<FullscreenSVG/>}/>
              </div>
              {this.renderOnToggleView()}
              {this.renderSearchWrapper()}
            </section>
            <MapContainer/>
          </Grid>
        );
    }
}

Home.propTypes = {
    toggleView: T.func.isRequired
};
