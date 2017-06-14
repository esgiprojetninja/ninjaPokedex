import {combineReducers} from "redux";
import theme from "./theme";
import navbar from "./navbar";
import pokemons from "./pokemons";
import mapLegend from "./mapLegend";
import mapWrap from "./mapWrap";

const Main = combineReducers({
    navbar,
    theme,
    pokemons,
    mapWrap,
    mapLegend
});

export default Main;
