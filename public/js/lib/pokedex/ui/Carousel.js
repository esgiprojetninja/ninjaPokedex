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
  cardIconDescriptionWrapper : {
    width: '25px',
    height: '25px',
    position: 'absolute',
    right: '0',
    top: '0',
    padding: '3px'
  },
  cardIconDescription : {
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

    renderDetails () {
        return (
          <div className="card-details">
            testDetails
          </div>
        )
    }

    renderCards (p, key) {
      return (
        <div key={key} className="align" style={styles.cardWrapper}>
            <div className="card">
              <span className="card-number">{this.props.pokemons.all[key].id_national}</span>
              <img src={this.props.pokemons.all[key].icon} className="card-pokemon"/>
              {this.renderDetails()}
              <IconButton
                style={styles.cardIconDescriptionWrapper}
                iconStyle={styles.cardIconDescription}
                tooltipPosition="top-center"
                tooltip="Détails"
                children={<DescriptionSVG/>}
                onTouchTap={this.props.toggleDetails}
              />
              <span className="card-title">
                {this.props.pokemons.all[key].name}
              </span>
              <span className="card-description">
                Reptincel est tiré du dinosaure, il possède de grandes et puissantes griffes acérées, qui laident notamment à déchirer la peau de ses ennemis.
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
