import * as types from "../actions/pokeSearchTypes";

const initialSate = {
    searchedPokemons : [],
    searchedQuery : null
};

const pokesearch = (state = initialSate, action) => {
    switch (action.type) {
        case types.SET_SEARCHED_POKEMONS:
            return {
                ...state,
                searchedPokemons: action.pokemons || []
            }
        case types.SET_SEARCHED_QUERY:
            return {
                ...state,
                searchedQuery: action.query || null
            }
        case types.RESET_SEARCHED_QUERY:
            return {
                ...state,
                searchedQuery: null
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
