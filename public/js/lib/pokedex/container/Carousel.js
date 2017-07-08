import {connect} from "react-redux";
import CarouselComponent from "../ui/Carousel";

import {
    setSelectedPokemonForDetails,
    setSelectedPokemonStarter,
    setSelectedPokemonEvolution,
    openDetails
} from "../actions/carouselActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        setSelectedPokemonForDetails(currentPokemon) {
            dispatch(setSelectedPokemonForDetails(currentPokemon));
        },
        setSelectedPokemonStarter(starterPokemon) {
            dispatch(setSelectedPokemonStarter(starterPokemon));
        },
        setSelectedPokemonEvolution(evolutionPokemon) {
            dispatch(setSelectedPokemonEvolution(evolutionPokemon));
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
