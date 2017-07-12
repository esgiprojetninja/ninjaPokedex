import React from "react";
import {PropTypes as T} from 'prop-types';
import {Grid, Row, Col} from 'react-bootstrap';
import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';
import IconButton from 'material-ui/IconButton';
import LocationSVG from 'material-ui/svg-icons/action/room';
import Card from '../container/Card';
import AddCircleOutlineSVG from 'material-ui/svg-icons/content/add-circle-outline';
import DescriptionSVG from 'material-ui/svg-icons/action/description';
import scrollToElement from 'scroll-to-element';
import ZeroFill from 'zero-fill';

const styles = {
    button: {
        margin: '15px 0'
    },
    cardIconLocationWrapper : {
        width: '25px',
        height: '25px',
        position: 'absolute',
        right: '0',
        top: '0',
        padding: '3px'
    },
    cardIconLocation : {
        width: '20px',
        height: '20px',
        color: 'white'
    }
};

export default class Table extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderCards (p, key) {
      return (
          <div key={key} className="card text-center table-card" style={{display: 'inline-block', margin: '15px'}}>
            <span className="card-number">#{ZeroFill(3, this.props.pokemons.all[key].id_national)}</span>
            <img src={this.props.pokemons.all[key].image} className="card-pokemon"/>
            <IconButton
                style={styles.cardIconLocationWrapper}
                iconStyle={styles.cardIconLocation}
                tooltipPosition="top-center"
                tooltip="Détails"
                children={<DescriptionSVG/>}
                onTouchTap={
                    () => {
                        this.props.setSelectedPokemonForDetails(this.props.pokemons.all[key]);
                        this.props.openDetails();
                    }
                }
            />
            <span className="card-title table-title">
              {this.props.pokemons.all[key].name}
            </span>
            <div className="card-type align">
                {(this.props.pokemons.all[key].type.map((ps, ks) => this.renderType(ps, ks)))}
            </div>
          </div>
        )
    }

    renderSearchedCards(poke, pokeKey) {
        return (
            <div key={pokeKey} className="card text-center table-card" style={{display: 'inline-block', margin: '15px'}}>
              <span className="card-number">{poke.id_national}</span>
              <img src={poke.image} className="card-pokemon"/>
              <IconButton
                  style={styles.cardIconLocationWrapper}
                  iconStyle={styles.cardIconLocation}
                  tooltipPosition="top-center"
                  tooltip="Détails"
                  children={<DescriptionSVG/>}
                  onTouchTap={
                      () => {
                          this.props.setSelectedPokemonForDetails(poke);
                          this.props.openDetails();
                      }
                  }
              />
              <span className="card-title table-title">
                {poke.name}
              </span>
              <div className="card-type align">
                  {(poke.type.map((ps, ks) => this.renderType(ps, ks)))}
              </div>
            </div>
          )
    }

    renderType (ps, ks) {
        return (
            <span key={ks} className="type" style={{backgroundColor: ps.color}}>{ps.nom_type}</span>
        )
    }

    renderPokemonsList () {
        if(this.props.pokesearch.searchedPokemons && this.props.pokesearch.searchedPokemons.length !== 0) {
            return (this.props.pokesearch.searchedPokemons.map((poke, pokeKey) => this.renderSearchedCards(poke, pokeKey)))
        } else {
            return (this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))
        }
    }

    renderQueryFilter () {
        if(this.props.pokesearch.searchedParams.query) {
            return (
                <span className="type" style={{backgroundColor: 'white', padding: '10px 15px', fontSize: '14px', color: '#292929'}}>{this.props.pokesearch.searchedParams.query}</span>
            )
        }
    }

    renderTypeFilter (value, key) {
        const typeColor = this.props.types.all.find(type => type.name_type === value).color;
        return (
            <span key={key} className="type" style={{backgroundColor: typeColor, padding: '10px 15px', fontSize: '14px'}}>{value}</span>
        )
    }

    renderTypesFilter () {
        if(this.props.pokesearch.searchedParams.pokemonType.length !== 0) {
            return (this.props.pokesearch.searchedParams.pokemonType.map((value, key) => this.renderTypeFilter(value, key)))
        }
    }

    renderFilterTitle () {
        if(this.props.pokesearch.searchedParams.pokemonType.length !== 0 || this.props.pokesearch.searchedParams.query) {
            return (
                <span style={{color: 'white'}}> Filtres (<span style={{fontWeight: 800, color: 'red'}}>{this.props.pokesearch.searchedPokemons.length}</span> résultat(s)) : </span>
            )
        }
    }

    render () {
      if(this.props.pokemons.all) {
        return (
          <Grid className="animate fadeInLeft full-height" style={{padding: '50px 20px'}}>
            <Row className="full-height">
              <Col md={12}>
                <div>
                  <div className="table-filters">
                    <Col md={10} style={{padding: '10px'}}>
                        {this.renderFilterTitle()}
                        {this.renderQueryFilter()}
                        {this.renderTypesFilter()}
                    </Col>
                    <Col md={2}>
                        <RaisedButton
                          target="_blank"
                          label="Voir la map"
                          labelColor="#ffffff"
                          secondary={true}
                          onTouchTap={
                              () => {
                                  scrollToElement('.map-wrapper');
                              }
                          }
                          style={{margin: 0}}
                          buttonStyle={{backgroundColor: this.props.theme.current.palette.primary1Color}}
                          icon={<LocationSVG/>}
                        />
                    </Col>
                  </div>
                </div>
              </Col>
              <Col md={12} style={{textAlign: 'center', overflowY: 'auto', height: '85vh'}}>
                  {this.renderPokemonsList()}
              </Col>
            </Row>
          </Grid>
        )
      } else {
        return (
          <div>
            Loading...
          </div>
        )
      }
    }
}
