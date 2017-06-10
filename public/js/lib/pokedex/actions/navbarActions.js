import * as types from "./navbarTypes";
import PokemonApi from "../api/pokemon";

const pokemonApi = new PokemonApi();

export const toggleNavbar = () => {
    return {
        type: types.TOGGLE_DISPLAY
    }
}
