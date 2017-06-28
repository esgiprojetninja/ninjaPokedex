import {connect} from "react-redux";
import CarouselComponent from "../ui/Carousel";

import {
    setSelectedPokemonForDetails
} from "../actions/carouselActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
      setSelectedPokemonForDetails(pokemon) {
        dispatch(setSelectedPokemonForDetails(pokemon))
      }
    };
}

const Carousel = connect(
    mapStateToProps,
    mapDispatchToProps
)(CarouselComponent);

export default Carousel;
