import {connect} from "react-redux";
import AppComponent from "../ui/App";
import {initTheme} from "../actions/themeActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        beforeReady(default_theme) {
            dispatch(initTheme(default_theme));
        }
    };
}

const App = connect(
    mapStateToProps,
    mapDispatchToProps
)(AppComponent);

export default App;
