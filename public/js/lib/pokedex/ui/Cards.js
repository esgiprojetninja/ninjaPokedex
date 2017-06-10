import React from "react";
import {PropTypes as T} from 'prop-types';
import Slider from 'react-slick';

const styles = {
};

const sliderSettings = {
  dots: true,
  infinite: true,
  speed: 500,
  slidesToShow: 1,
  slidesToScroll: 1
};

export default class Cards extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
            <div>
              <Slider {...sliderSettings}>
                <div><h3>1</h3></div>
                <div><h3>2</h3></div>
                <div><h3>3</h3></div>
                <div><h3>4</h3></div>
                <div><h3>5</h3></div>
                <div><h3>6</h3></div>
              </Slider>
            </div>
        );
    }
}
