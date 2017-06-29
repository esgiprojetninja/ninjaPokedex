import * as types from "./carouselTypes";

export const setSelectedPokemonForDetails = currentPokemon => {
    return {
        type: types.SET_CURRENT,
        currentPokemon
    }
}

export const setSelectedPokemonStarter = starterPokemon => {
    return {
        type: types.SET_STARTER,
        starterPokemon
    }
}

export const setSelectedPokemonEvolution = evolutionPokemon => {
    return {
        type: types.SET_EVOLUTION,
        evolutionPokemon
    }
}

export const openDetails = () => {
    return {
        type: types.TOGGLE_DETAILS
    }
}
