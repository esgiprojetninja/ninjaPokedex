import * as types from "../actions/pokemonTypes";

const initialSate = {
    all: false,
    marked: false,
    isFetching: false,
    addingPokemonMarker: false,
    requestFailMsg: false
};

const pokemons = (state = initialSate, action) => {
    switch (action.type) {
        case types.REQUESTING:
            return {
                ...state,
                isFetching: true
            }
        case types.REQUEST_FAIL:
            return {
                ...state,
                isFetching: false,
                addingPokemonMarker: false,
                requestFailMsg: action.error
            }
        case types.RECEIVED_ALL_POKEMONS:
            return {
                ...state,
                isFetching: false,
                all: action.pokemons
                    .map(pokemon => {
                        return {...pokemon, evolutions: action.pokemons
                            .filter(poke => poke.id_parent === pokemon.id_national)
                            .map( pokemon_2 => {
                                return {
                                    ...pokemon_2,
                                    evolutions: action.pokemons.find( poke => poke.id_parent === pokemon_2.id_national ) ?
                                        action.pokemons.filter( poke => poke.id_parent === pokemon_2.id_national )  :
                                        false
                                }
                            })
                        }
                    })
            }
        case types.RECEIVED_MARKED_POKEMONS:
            return {
                ...state,
                isFetching: false,
                marked: action.pokemons
            }
        case types.RECEIVED_SIGNAL_SUCCESS:
            return {
                ...state,
                addingPokemonMarker: false,
                marked: [...state.marked, action.marker]
            }
        case types.ADDING_POKEMON_MARKER:
            return {
                ...state,
                addingPokemonMarker: true
            }
        default:
            return state;
    }
};

export default pokemons;
