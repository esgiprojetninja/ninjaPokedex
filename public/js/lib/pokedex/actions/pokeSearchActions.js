import * as types from "./pokeSearchTypes";

export const setSearchedPokemons = pokemons => {
    return {
        type: types.SET_SEARCHED_POKEMONS,
        pokemons
    }
}

export const resetSearchedPokemons = () => {
    return {
        type: types.RESET_SEARCHED_POKEMONS
    }
}
