import React from "react";
import PropTypes from 'prop-types';
import Navbar from "../container/Navbar";

export default class App extends React.PureComponent {
    constructor(props) {
        super(props);
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
            </div>
        );
    }
}
