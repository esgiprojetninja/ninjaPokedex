import {combineReducers} from "redux";
import theme from "./theme";
import navbar from "./navbar";
import pokemons from "./pokemons";
import mapLegend from "./mapLegend";

const Main = combineReducers({
    navbar,
    theme,
    pokemons,
    mapLegend
});

export default Main;
