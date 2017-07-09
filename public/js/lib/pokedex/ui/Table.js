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


const styles = {
    button: {
        width: '100%',
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
            <span className="card-number">{this.props.pokemons.all[key].id_national}</span>
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

    renderType (ps, ks) {
        return (
            <span key={ks} className="type" style={{backgroundColor: ps.color}}>{ps.nom_type}</span>
        )
    }

    render () {
      if(this.props.pokemons.all) {
        return (
          <Grid className="animate fadeInLeft full-height" style={{padding: '50px 20px'}}>
            <Row className="full-height">
              <Col md={2} className="align full-height">
              <div className="text-center">
                <RaisedButton
                  target="_blank"
                  label="Ajouter"
                  labelColor="#ffffff"
                  backgroundColor="#a4c639"
                  style={styles.button}
                  icon={<AddCircleOutlineSVG/>}
                />
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
                  style={styles.button}
                  buttonStyle={{backgroundColor: this.props.theme.current.palette.primary1Color}}
                  icon={<LocationSVG/>}
                />
              </div>
              </Col>
              <Col md={10} style={{textAlign: 'center', overflowY: 'auto'}} className="full-height">
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
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
