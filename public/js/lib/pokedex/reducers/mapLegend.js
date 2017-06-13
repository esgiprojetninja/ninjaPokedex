import * as types from "../actions/mapLegendTypes";

const initialSate = {
    displayForm: false,
    selectedPokemon: {},
    displayMapModal: false
};

const navbar = (state = initialSate, action) => {
    switch (action.type) {
        case types.TOGGLE_FORM:
            return {
                ...state,
                displayForm: !state.displayForm,
                selectedPokemon: {}
            }
        case types.CHANGE_POKEMON:
            return {
                ...state,
                selectedPokemon: action.pokemon || {}
            }
        default:
            return state;
    }
};

export default navbar;
