import {combineReducers} from "redux";
import theme from "./theme";
import navbar from "./navbar";
import pokemons from "./pokemons";

const Main = combineReducers({
    navbar,
    theme,
    pokemons
});

export default Main;
