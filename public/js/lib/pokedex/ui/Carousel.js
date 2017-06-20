import React from "react";
import {PropTypes as T} from 'prop-types';
import Slider from 'react-slick';
import Card from '../container/Card';
import IconButton from 'material-ui/IconButton';
import LocationSVG from 'material-ui/svg-icons/action/room';

const styles = {
  cardWrapper : {
    display: 'flex',
    height: '433px'
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

    render () {
        return (
            <div className="card-wrapper">
              <Slider {...sliderSettings}>
                <div>
                  <Card/>
                </div>
                <div>
                  <Card/>
                </div>
                <div>
                  <Card/>
                </div>
                <div>
                  <Card/>
                </div>
                <div>
                  <Card/>
                </div>
                <div>
                  <Card/>
                </div>
              </Slider>
            </div>
        );
    }
}
