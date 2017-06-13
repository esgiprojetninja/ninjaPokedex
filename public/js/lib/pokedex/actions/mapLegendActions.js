import * as types from "./mapLegendTypes";
import PokemonApi from "../api/pokemon";

const pokemonApi = new PokemonApi();

export const toggleForm = () => {
    return {
        type: types.TOGGLE_FORM
    }
}
export const setSelectedPokemon = pokemon => {
    return {
        type: types.CHANGE_POKEMON,
        pokemon
    }
}
