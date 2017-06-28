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
import Close from 'material-ui/svg-icons/action/highlight-off';

const styles = {
    buttonClose : {
        position: 'absolute',
        top: '0',
        right: '0',
        margin: '15px',
        height: '100px',
        width: '100px'
    },
    iconClose : {
        color: 'white',
        height: '80px',
        width: '80px'
    },
    icon: {
        height: '30px',
        color: 'white'
    },
    pokemonName: {
        fontSize: '35px',
        fontWeight: 800
    },
    pokemonId: {
        fontSize: '25px',
        marginTop: 0
    }
};

export default class Home extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderSearch () {
      return (
        <div>
          <PokeSearch/>
        </div>
      )
    }

    renderSearchWrapper () {
      if( this.props.navbar.showSearch ) {
        return this.renderSearch();
      }
    }

    renderHomeTable () {
      return (
        <Row className="show-grid full-height">
          <Col md={12} className="full-height">
            <Table/>
          </Col>
        </Row>
      )
    }

    renderHomeCarousel () {
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

    renderOnToggleView () {
      if( this.props.home.showCarousel ) {
        return this.renderHomeCarousel();
      } else {
        return this.renderHomeTable();
      }
    }

    renderPokemonDetailsStarter () {
        if(this.props.carousel.selectedPokemonForDetails.starter && this.props.carousel.selectedPokemonForDetails.starter.image) {
            return (
                <img src={this.props.carousel.selectedPokemonForDetails.starter.image}/>
            )
        }
    }

    renderPokemonDetailsCurrent () {
        if(this.props.carousel.selectedPokemonForDetails.current && this.props.carousel.selectedPokemonForDetails.current.image) {
            return (
                <img src={this.props.carousel.selectedPokemonForDetails.current.image}/>
            )
        }
    }

    renderPokemonDetailsThisEvolution (thisP, thisKey) {
        return (
            <img src={this.props.carousel.selectedPokemonForDetails.evolution[thisKey].image}/>
        )
    }

    renderPokemonDetailsEvolutions () {
        if(this.props.carousel.selectedPokemonForDetails.evolution) {
            return (
                <div>
                    {(this.props.carousel.selectedPokemonForDetails.evolution.map((thisP, thisKey) => this.renderPokemonDetailsThisEvolution(thisP, thisKey)))}
                </div>
            )
        }
    }

    renderPokemonDetailsEvolution () {
        return (
            <div className="align">
                {this.renderPokemonDetailsStarter()}
                {this.renderPokemonDetailsCurrent()}
                {this.renderPokemonDetailsEvolutions()}
            </div>
        )
    }

    renderPokemonDetails () {
      if(this.props.carousel.showDetails) {
        return (
            <div className="card-details align full-height full-width">
            <IconButton onClick={this.props.openDetails} style={styles.buttonClose} iconStyle={styles.iconClose} children={<Close/>}/>
            <Col md={4} className="card-details-content">
                {this.renderPokemonDetailsEvolution()}
                <div className="card-details-body full-width">
                    <ul>
                        <li className="text-center">
                            <span style={styles.pokemonId}>No. {this.props.carousel.selectedPokemonForDetails.current.id_national}</span>
                        </li>
                        <li className="text-center">
                            <span style={styles.pokemonName}>{this.props.carousel.selectedPokemonForDetails.current.name}</span>
                        </li>
                        <li>
                            <span style={styles.pokemonDescription}>{this.props.carousel.selectedPokemonForDetails.current.description}</span>
                        </li>
                        <li>
                            <span>Feu</span>
                        </li>
                    </ul>
                </div>
            </Col>
            </div>
        )
      }
    }

    render () {
        return (
          <Grid className="container full-height full-width" style={{padding: 0}}>
            <section className="index-wrapper full-height full-width">
              <img src="img/pokemon-logo.png" className="index-logo"/>
              {this.renderPokemonDetails()}
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
