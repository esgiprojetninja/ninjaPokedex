import * as types from "./carouselTypes";

export const setSelectedPokemonForDetails = pokemon => {
    return {
        type: types.SELECT_POKEMON,
        pokemon
    }
}

export const openDetails = () => {
    return {
        type: types.TOGGLE_DETAILS
    }
}
