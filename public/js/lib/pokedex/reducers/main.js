import {combineReducers} from "redux";
import theme from "./theme";
import navbar from "./navbar";
import pokemons from "./pokemons";
import mapLegend from "./mapLegend";
import mapContainer from "./mapContainer";
import mapWrap from "./mapWrap";
import subhome from "./subhome";
import home from "./home";

const Main = combineReducers({
    navbar,
    theme,
    pokemons,
    mapWrap,
    mapLegend,
    mapContainer,
    subhome,
    home
});

export default Main;
