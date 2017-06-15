import {combineReducers} from "redux";
import theme from "./theme";
import navbar from "./navbar";
import pokemons from "./pokemons";
import mapLegend from "./mapLegend";
import mapContainer from "./mapContainer";
import mapWrap from "./mapWrap";

const Main = combineReducers({
    navbar,
    theme,
    pokemons,
    mapWrap,
    mapLegend,
    mapContainer
});

export default Main;
