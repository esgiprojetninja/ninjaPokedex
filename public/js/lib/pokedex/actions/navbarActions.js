import * as types from "./navbarTypes";
import PokemonApi from "../api/pokemon";

const pokemonApi = new PokemonApi();

export const toggleNavbar = () => {
    return {
        type: types.TOGGLE_DISPLAY
    }
}

export const testAction = () => {
    return (dispatch, getState) => {
        console.log("mother fucker bitch ", getState());
        pokemonApi.getAll(response => {
            console.debug("GetAll -- SERVER RESPONSE", response);
        });
        pokemonApi.get(1, response => {
            console.debug("GET -- SERVER RESPONSE", response);
        });
        pokemonApi.create(undefined, response => {
            console.debug("CREATE -- SERVER RESPONSE", response);
        });
        pokemonApi.update(undefined, undefined, response => {
            console.debug("UPDATE -- SERVER RESPONSE", response);
        });
        pokemonApi.delete(undefined, response => {
            console.debug("DELETE -- SERVER RESPONSE", response);
        });
    }
}
