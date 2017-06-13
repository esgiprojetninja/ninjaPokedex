import * as types from "./pokemonTypes";
import PokemonApi from "../api/pokemon";

const pokemonApi = new PokemonApi();

const requestDispatched = () => {
    return {
        type: types.REQUESTING
    }
};

const requestFailed = error => {
    return {
        type: types.REQUEST_FAIL,
        error
    }
}

const receivedAllPokemons = pokemons => {
    return {
        type: types.RECEIVED_ALL_POKEMONS,
        pokemons
    }
}
const receivedMarkedPokemons = pokemons => {
    return {
        type: types.RECEIVED_MARKED_POKEMONS,
        pokemons
    }
}

export const getAll = () => {
    return dispatch => {
        dispatch(requestDispatched());
        pokemonApi.getAll()
            .then( response => {
                if(response.error)
                    dispatch(requestFailed());
                else
                    dispatch(receivedAllPokemons(response.data));
            })
            .catch( error => {dispatch(requestFailed(error))});
    };
}

export const getMarked = () => {
    return dispatch => {
        dispatch(requestDispatched());
        pokemonApi.getMarked()
            .then( response => {
                if(response.error)
                    dispatch(requestFailed());
                else
                    dispatch(receivedMarkedPokemons(response.data));
            })
            .catch(dispatch(requestFailed()));
    };
}
