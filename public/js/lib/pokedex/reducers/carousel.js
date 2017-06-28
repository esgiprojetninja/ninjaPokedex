import * as types from "../actions/carouselTypes";

const initialSate = {
    showDetails: false,
    selectedPokemonForDetails: {}
};

const carousel = (state = initialSate, action) => {
    switch (action.type) {
        case types.SELECT_POKEMON:
            return {
                ...state,
                selectedPokemonForDetails: action.pokemon || {}
            }
        case types.TOGGLE_DETAILS:
            return {
                ...state,
                showDetails: !state.showDetails
            }
        default:
            return state;
    }
};

export default carousel;
