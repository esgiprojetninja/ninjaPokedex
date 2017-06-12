import React from "react";
import {PropTypes as T} from 'prop-types';
import Slider from 'react-slick';

const styles = {
  cardWrapper : {
    display: 'flex',
    height: '560px'
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
            <div className="card-wrapper">
              <Slider {...sliderSettings}>
                <div className="align" style={styles.cardWrapper}>
                  <div className="card">
                    <span className="card-number">008</span>
                    <img src="img/reptincel.png" className="card-pokemon"/>
                    <span className="card-title">
                      Reptincel
                    </span>
                    <span className="card-description">
                      Reptincel est tiré du dinosaure, il possède de grandes et puissantes griffes acérées, qui laident notamment à déchirer la peau de ses ennemis.
                    </span>
                    <div className="card-type align">
                      <img src="img/feu.png"/>
                    </div>
                  </div>
                </div>
                <div className="align" style={styles.cardWrapper}>
                  <div className="card">
                    <span className="card-number">008</span>
                    <img src="img/reptincel.png" className="card-pokemon"/>
                    <span className="card-title">
                      Reptincel
                    </span>
                    <span className="card-description">
                      Reptincel est tiré du dinosaure, il possède de grandes et puissantes griffes acérées, qui laident notamment à déchirer la peau de ses ennemis.
                    </span>
                    <div className="card-type align">
                      <img src="img/feu.png"/>
                    </div>
                  </div>
                </div><div className="align" style={styles.cardWrapper}>
                  <div className="card">
                    <span className="card-number">008</span>
                    <img src="img/reptincel.png" className="card-pokemon"/>
                    <span className="card-title">
                      Reptincel
                    </span>
                    <span className="card-description">
                      Reptincel est tiré du dinosaure, il possède de grandes et puissantes griffes acérées, qui laident notamment à déchirer la peau de ses ennemis.
                    </span>
                    <div className="card-type align">
                      <img src="img/feu.png"/>
                    </div>
                  </div>
                </div><div className="align" style={styles.cardWrapper}>
                  <div className="card">
                    <span className="card-number">008</span>
                    <img src="img/reptincel.png" className="card-pokemon"/>
                    <span className="card-title">
                      Reptincel
                    </span>
                    <span className="card-description">
                      Reptincel est tiré du dinosaure, il possède de grandes et puissantes griffes acérées, qui laident notamment à déchirer la peau de ses ennemis.
                    </span>
                    <div className="card-type align">
                      <img src="img/feu.png"/>
                    </div>
                  </div>
                </div><div className="align" style={styles.cardWrapper}>
                  <div className="card">
                    <span className="card-number">008</span>
                    <img src="img/reptincel.png" className="card-pokemon"/>
                    <span className="card-title">
                      Reptincel
                    </span>
                    <span className="card-description">
                      Reptincel est tiré du dinosaure, il possède de grandes et puissantes griffes acérées, qui laident notamment à déchirer la peau de ses ennemis.
                    </span>
                    <div className="card-type align">
                      <img src="img/feu.png"/>
                    </div>
                  </div>
                </div>
              </Slider>
            </div>
        );
    }
}
