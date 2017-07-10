import {connect} from "react-redux";
import HomeComponent from "../ui/Home";

import {
    toggleView,
    getTableView
} from "../actions/homeActions";

import {
    setSelectedPokemonForDetails,
    openDetails
} from "../actions/carouselActions";

import {
    resetSearchedPokemons
} from "../actions/pokeSearchActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        setSelectedPokemonForDetails(pokemon) {
            dispatch(setSelectedPokemonForDetails(pokemon));
        },
        toggleView() {
            dispatch(toggleView());
        },
        openDetails() {
            dispatch(openDetails());
        },
        getTableView() {
            dispatch(getTableView());
        },
        resetSearchedPokemons() {
            dispatch(resetSearchedPokemons());
        }
    };
}

const Home = connect(
    mapStateToProps,
    mapDispatchToProps
)(HomeComponent);

export default Home;
