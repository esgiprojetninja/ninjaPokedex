import * as types from "../actions/pokeSearchTypes";

const initialSate = {
    searchedPokemons : []
};

const pokesearch = (state = initialSate, action) => {
    switch (action.type) {
        case types.SET_SEARCHED_POKEMONS:
            return {
                ...state,
                searchedPokemons: action.pokemons || []
            }
        case types.RESET_SEARCHED_POKEMONS:
            return {
                ...state,
                searchedPokemons: []
            }
        default:
            return state;
    }
};

export default pokesearch;
