import * as types from "../actions/carouselTypes";

const initialSate = {
    selectedPokemonForDetails: {}
};

const carousel = (state = initialSate, action) => {
    switch (action.type) {
        case types.SELECT_POKEMON:
            return {
                ...state,
                selectedPokemonForDetails: action.pokemon || {}
            }
        default:
            return state;
    }
};

export default carousel;
