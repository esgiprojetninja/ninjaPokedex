import * as types from "../actions/pokemonTypes";

const initialSate = {
    all: false,
    marked: false,
    isFetching: false,
    requestFailMsg: false
};

const pokemons = (state = initialSate, action) => {
    switch (action.type) {
        case types.REQUESTING:
            return {
                ...state,
                isFetching: true
            }
        case types.REQUEST_FAIL:
            return {
                ...state,
                isFetching: false,
                requestFailMsg: action.error
            }
        case types.RECEIVED_ALL_POKEMONS:
            return {
                ...state,
                isFetching: false,
                all: action.pokemons
            }
        case types.RECEIVED_MARKED_POKEMONS:
            return {
                ...state,
                isFetching: false,
                marked: action.pokemons
            }
        default:
            return state;
    }
};

export default pokemons;
