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

    renderPokemonDetailsCurrent () {
        if(this.props.carousel.selectedCurrent && this.props.carousel.selectedCurrent.image) {
            return (
                <img className="pokemon-details pokemon-current" src={this.props.carousel.selectedCurrent.image}/>
            )
        }
    }

    renderPokemonDetailsSecondThisEvolution (thisPp, thisKeyy) {
        return (
            <div>
                <img
                    key={thisKeyy}
                    className="pokemon-details pokemon-evolution"
                    src={this.props.carousel.selectedCurrent.evolutions[thisKeyy].evolutions[thisKeyy].image}
                    onTouchTap={
                        () => {
                            this.props.setSelectedPokemonForDetails(this.props.carousel.selectedCurrent.evolutions[thisKeyy].evolutions[thisKeyy]);
                        }
                    }
                />
            </div>
        )
    }

    renderPokemonDetailsThisEvolution (thisP, thisKey) {
        return (
            <div>
                <img
                    key={thisKey}
                    className="pokemon-details pokemon-evolution"
                    src={this.props.carousel.selectedCurrent.evolutions[thisKey].image}
                    onTouchTap={
                        () => {
                            this.props.setSelectedPokemonForDetails(this.props.carousel.selectedCurrent.evolutions[thisKey]);
                        }
                    }
                />
                {this.renderPokemonDetailsSecondEvolution(thisP, thisKey)}
            </div>
        )
    }

    renderPokemonDetailsSecondEvolution (thisP, thisKey) {
        if(this.props.carousel.selectedCurrent.evolutions[thisKey].evolutions) {
            return (
                <div>
                    {
                        (this.props.carousel.selectedCurrent.evolutions[thisKey].evolutions.map((thisPp, thisKeyy) => this.renderPokemonDetailsSecondThisEvolution(thisPp, thisKeyy)))
                    }
                </div>
            )
        }
    }

    renderPokemonDetailsFirstEvolution () {
        if(this.props.carousel.selectedCurrent.evolutions) {
            return (
                <div>
                    {
                        (this.props.carousel.selectedCurrent.evolutions.map((thisP, thisKey) => this.renderPokemonDetailsThisEvolution(thisP, thisKey)))
                    }
                </div>
            )
        }
    }

    renderPokemonDetailsSecondStarter (starter) {
        if(starter.id_parent) {
            const starter2 = this.props.pokemons.all.find(element => element.id_national === starter.id_parent)
            return (
                <div>
                    <img
                        className="pokemon-details pokemon-evolution"
                        src={starter2.image}
                        onTouchTap={
                            () => {
                                this.props.setSelectedPokemonForDetails(starter2);
                            }
                        }
                    />
                </div>
            )
        }
    }

    renderPokemonDetailsFirstStarter () {
        if(this.props.carousel.selectedCurrent.id_parent) {
            const starter = this.props.pokemons.all.find(element => element.id_national === this.props.carousel.selectedCurrent.id_parent)
            return (
                <div>
                    <img
                        className="pokemon-details pokemon-evolution"
                        src={starter.image}
                        onTouchTap={
                            () => {
                                this.props.setSelectedPokemonForDetails(starter);
                            }
                        }
                    />
                    {this.renderPokemonDetailsSecondStarter(starter)}
                </div>
            )
        }
    }

    renderPokemonDetailsEvolution () {
        return (
            <div className="align">
                {this.renderPokemonDetailsFirstStarter()}
                {this.renderPokemonDetailsCurrent()}
                {this.renderPokemonDetailsFirstEvolution()}
            </div>
        )
    }

    renderPokemonTypes (ps, ks) {
        return (
            <div key={ks} className="card-type card-type-size" style={{display: 'initial'}}>
                <span className="type" style={{background: this.props.carousel.selectedCurrent.type[ks].color}}>{this.props.carousel.selectedCurrent.type[ks].nom_type}</span>
            </div>
        )
    }

    renderPokemonDetails () {
      if(this.props.carousel.showDetails) {
        return (
            <div className="card-details align full-height full-width">
            <IconButton onClick={this.props.openDetails} style={styles.buttonClose} iconStyle={styles.iconClose} children={<Close/>}/>
            <Col md={4} className="card-details-content">
                <div className="card-details-body full-width">
                {this.renderPokemonDetailsEvolution()}
                    <ul>
                        <li className="text-center">
                            <span style={styles.pokemonId}>No. {this.props.carousel.selectedCurrent.id_national}</span>
                        </li>
                        <li className="text-center">
                            <span style={styles.pokemonName}>{this.props.carousel.selectedCurrent.name}</span>
                        </li>
                        <li>
                            <span style={styles.pokemonDescription}>{this.props.carousel.selectedCurrent.description}</span>
                        </li>
                        <li className="text-center">
                            {(this.props.carousel.selectedCurrent.type.map((ps, ks) => this.renderPokemonTypes(ps, ks)))}
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
