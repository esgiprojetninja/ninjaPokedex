import * as types from "./carouselTypes";

export const setSelectedPokemonForDetails = pokemon => {
    return {
        type: types.SELECT_POKEMON,
        pokemon
    }
}
