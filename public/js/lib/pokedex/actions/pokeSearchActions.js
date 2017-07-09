import * as types from "./pokeSearchTypes";

export const setSearchedPokemons = pokemon => {
    return {
        type: types.SET_SEARCHED_POKEMONS,
        pokemon
    }
}
