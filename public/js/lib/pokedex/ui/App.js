import React from "react";
import PropTypes from 'prop-types';
import Navbar from "../container/Navbar";
import Home from "../ui/Home";
import muiThemeable from 'material-ui/styles/muiThemeable';

class App extends React.PureComponent {
    constructor(props) {
        super(props);
        console.log("mofo", props);
    }

    componentDidMount() {
        this.props.onReady();
    }

    renderContent(){

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

export default muiThemeable()(App);
