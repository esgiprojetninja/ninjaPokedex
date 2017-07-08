import * as types from "./carouselTypes";

export const setSelectedPokemonForDetails = currentPokemon => {
    return {
        type: types.SET_CURRENT,
        currentPokemon
    }
}

export const openDetails = () => {
    return {
        type: types.TOGGLE_DETAILS
    }
}
