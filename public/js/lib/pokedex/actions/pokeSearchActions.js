import * as types from "./pokeSearchTypes";

export const setSearchedPokemons = pokemons => {
    return {
        type: types.SET_SEARCHED_POKEMONS,
        pokemons
    }
}

export const setSearchedQuery = query => {
    return {
        type: types.SET_SEARCHED_QUERY,
        query
    }
}

export const setSearchedType = newType => {
    return {
        type: types.SET_SEARCHED_TYPE,
        newType
    }
}

export const removeSearchedParamsType = removedType => {
    return {
        type: types.REMOVE_SEARCHED_PARAMS_TYPE,
        removedType
    }
}

export const resetSearchedParams = () => {
    return {
        type: types.RESET_SEARCHED_PARAMS
    }
}


export const resetSearchedPokemons = () => {
    return {
        type: types.RESET_SEARCHED_POKEMONS
    }
}
