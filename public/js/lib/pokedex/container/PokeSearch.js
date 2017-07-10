import {connect} from "react-redux";
import PokeSearchComponent from "../ui/PokeSearch";

import {
    toggleSearch,
} from "../actions/navbarActions";

import {
    setSearchedPokemons,
    resetSearchedPokemons
} from "../actions/pokeSearchActions"

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        toggleSearch() {
            dispatch(toggleSearch());
        },
        setSearchedPokemons(pokemons) {
            dispatch(setSearchedPokemons(pokemons));
        },
        resetSearchedPokemons() {
            dispatch(resetSearchedPokemons());
        }
    };
}

const PokeSearch = connect(
    mapStateToProps,
    mapDispatchToProps
)(PokeSearchComponent);

export default PokeSearch;
