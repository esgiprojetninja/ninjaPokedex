import * as types from "./pokemonTypes";
import {
    setNoticedAddEDPokeLocationMsgFalse,
    setNoticedFailedAddEDPokeLocationMsgFalse
} from './mapContainerActions';
import {cleanMarker} from './mapWrapActions';
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
            .catch( err => {
                  dispatch(requestFailed(err))
            });
    };
}

const addingLocation = () => {
    return {
        type: types.ADDING_POKEMON_MARKER
    }
}

const receivedSignalSucces = marker => {
    return {
        type: types.RECEIVED_SIGNAL_SUCCESS,
        marker
    }
}

export const signalPosition = addedMarker => {
    return (dispatch, getState) => {
        dispatch(addingLocation());
        const lat = getState().mapWrap.addedMarker.position.lat();
        const lng = getState().mapWrap.addedMarker.position.lng();
        const id_pokemon = getState().mapLegend.selectedPokemon.id_pokemon;
        pokemonApi.signal(id_pokemon, lat, lng)
            .then( response => {
                if ( response.error ) {
                    dispatch(setNoticedFailedAddEDPokeLocationMsgFalse());
                    dispatch(cleanMarker(addedMarker));
                    dispatch(requestFailed());
                } else {
                    dispatch(setNoticedAddEDPokeLocationMsgFalse())
                    dispatch(receivedSignalSucces(addedMarker));
                    dispatch(getMarked());
                }
            })
            .catch( err => {
                  dispatch(requestFailed(err))
            });
    }
}

export const tickMarkers = () => {
    return {
        type: types.TICK_MARKERS
    }
}
