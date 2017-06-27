import {connect} from "react-redux";
import AppComponent from "../ui/App";
import {initTheme} from "../actions/themeActions";
import {
    getAll,
    getMarked
} from "../actions/pokemonActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        beforeReady(default_theme) {
            dispatch(initTheme(default_theme));
        },
        onReady() {
            dispatch(getAll());
            dispatch(getMarked());
        }
    };
}

const App = connect(
    mapStateToProps,
    mapDispatchToProps
)(AppComponent);

export default App;
