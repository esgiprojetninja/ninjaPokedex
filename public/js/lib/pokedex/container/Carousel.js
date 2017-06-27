import {connect} from "react-redux";
import CarouselComponent from "../ui/Carousel";

import {
    toggleDetails,
} from "../actions/carouselActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
      toggleDetails() {
          dispatch(toggleDetails());
      }
    };
}

const Carousel = connect(
    mapStateToProps,
    mapDispatchToProps
)(CarouselComponent);

export default Carousel;
