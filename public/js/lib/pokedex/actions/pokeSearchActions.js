import * as types from "./pokeSearchTypes";

export const setSearchedPokemons = pokemon => {
    return {
        type: types.SET_SEARCHED_POKEMONS,
        pokemon
    }
}

export const resetSearchedPokemons = () => {
    return {
        type: types.RESET_SEARCHED_POKEMONS
    }
}
