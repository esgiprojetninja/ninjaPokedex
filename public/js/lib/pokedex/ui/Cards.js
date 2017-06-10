import React from "react";
import {PropTypes as T} from 'prop-types';
import Slider from 'react-slick';

const styles = {
  cardWrapper : {
    display: 'flex'
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

export default class Cards extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
            <div>
              <Slider {...sliderSettings}>
                <div className="align" style={styles.cardWrapper}>
                  <div className="card">
                  </div>
                </div>
                <div className="align" style={styles.cardWrapper}>
                  <div className="card">
                  </div>
                </div>
                <div className="align" style={styles.cardWrapper}>
                  <div className="card">
                  </div>
                </div>
                <div className="align" style={styles.cardWrapper}>
                  <div className="card">
                  </div>
                </div>
                <div className="align" style={styles.cardWrapper}>
                  <div className="card">
                  </div>
                </div>
              </Slider>
            </div>
        );
    }
}
