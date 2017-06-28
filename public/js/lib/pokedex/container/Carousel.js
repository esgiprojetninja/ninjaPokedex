import {connect} from "react-redux";
import CarouselComponent from "../ui/Carousel";

import {
    setSelectedPokemonForDetails,
    openDetails
} from "../actions/carouselActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
      setSelectedPokemonForDetails(pokemon) {
        dispatch(setSelectedPokemonForDetails(pokemon));
      },
      openDetails() {
        dispatch(openDetails());
      }
    };
}

const Carousel = connect(
    mapStateToProps,
    mapDispatchToProps
)(CarouselComponent);

export default Carousel;
