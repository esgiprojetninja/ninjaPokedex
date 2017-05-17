import * as types from "./navbarTypes";
import PokemonApi from "../api/pokemon";

const pokemonApi = new PokemonApi();

export const toggleNavbar = () => {
    return {
        type: types.TOGGLE_DISPLAY
    }
}

export const testAction = () => {
    return dispatch => {
        pokemonApi.getTest( response => {
            console.debug("NIKTAMERE", response);
        });
    }
}
