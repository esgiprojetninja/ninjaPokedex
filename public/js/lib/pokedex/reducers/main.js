import {combineReducers} from "redux";
import theme from "./theme";
import navbar from "./navbar";

const Main = combineReducers({
    navbar,
    theme
});

export default Main;
