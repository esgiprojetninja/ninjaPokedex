import {connect} from "react-redux";
import CarouselComponent from "../ui/Carousel";

import {
    testAction
} from "../actions/carouselActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        testAction() {
            dispatch(testAction());
        }
    };
}

const Carousel = connect(
    mapStateToProps,
    mapDispatchToProps
)(CarouselComponent);

export default Carousel;
