import React from "react";
import {PropTypes as T} from 'prop-types';
import Slider from 'react-slick';
import Card from '../container/Card';
import IconButton from 'material-ui/IconButton';
import LocationSVG from 'material-ui/svg-icons/action/room';
import DescriptionSVG from 'material-ui/svg-icons/action/description';

const styles = {
    cardWrapper : {
        display: 'flex'
        // height: '433px'
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

const sliderSettings = {
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 3,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }
    ]
};

export default class Carousel extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderCards (p, key) {
      return (
        <div key={key} className="align" style={styles.cardWrapper}>
            <div className="card">
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
                            let pokemon = {};
                            pokemon.current = this.props.pokemons.all[key];
                            pokemon.evolution = [];
                            pokemon.starter = {};
                            //Gère les évolutions
                            for(var i = 0; i < this.props.pokemons.all.length; i++) {
                                if(this.props.pokemons.all[i].id_parent === pokemon.current.id_national) {
                                    pokemon.evolution.push(this.props.pokemons.all[i]);
                                }
                            }
                            //Gère les starteurs
                            for(var j = 0; j < this.props.pokemons.all.length; j++) {
                                if(this.props.pokemons.all[j].id_national === pokemon.current.id_parent) {
                                    pokemon.starter = this.props.pokemons.all[j];
                                }
                            }
                            this.props.setSelectedPokemonForDetails(pokemon);
                            this.props.openDetails();
                        }
                    }
                />
                <span className="card-title">
                    {this.props.pokemons.all[key].name}
                </span>
                <span className="card-description">
                    {this.props.pokemons.all[key].description}
                </span>
                <div className="card-type align">
                    <span className="type">Feu</span>
                </div>
                </div>
          </div>
        )
    }

    render () {
      if(this.props.pokemons.all) {
        return (
          <div className="card-wrapper">
            <Slider {...sliderSettings}>
              {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
            </Slider>
          </div>
        )
      } else {
        return (
          <div className="align full-height" style={{height: '49vh'}}>
            Loading...
          </div>
        )
      }
    }
}
