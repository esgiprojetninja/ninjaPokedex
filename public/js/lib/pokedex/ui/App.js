import React from "react";
import {PropTypes as T} from 'prop-types';
import Navbar from "../container/Navbar";
import Home from "../ui/Home";
import muiThemeable from 'material-ui/styles/muiThemeable';

class App extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    componentWillMount() {
        this.props.beforeReady(this.props.muiTheme);
    }
    componentDidMount() {
        this.props.onReady();
    }

    render () {
        return (
            <div className="full-height">
                <Navbar/>
                <Home/>
            </div>
        );
    }
}
App.propTypes = {
    beforeReady: T.func.isRequired,
    onReady: T.func.isRequired,
    navbar: T.shape({
        show: T.bool.isRequired,
    }).isRequired,
    pokemons: T.shape({
        isFetching: T.bool.isRequired,
    }).isRequired,
    theme: T.shape({}).isRequired,
};


export default muiThemeable()(App);
