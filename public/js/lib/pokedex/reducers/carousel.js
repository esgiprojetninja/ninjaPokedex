import * as types from "../actions/carouselTypes";

const initialSate = {
    showDetails: false,
    selectedCurrent: {},
    selectedStarter: {},
    selectedEvolution: []
};

const carousel = (state = initialSate, action) => {
    switch (action.type) {
        case types.SET_CURRENT:
            return {
                ...state,
                selectedCurrent: action.currentPokemon || {}
            }
        case types.SET_STARTER:
            return {
                ...state,
                selectedStarter: action.starterPokemon || {}
            }
        case types.SET_EVOLUTION:
            return {
                ...state,
                selectedEvolution: action.evolutionPokemon || []
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
