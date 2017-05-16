import React from "react";
import {PropTypes as T} from 'prop-types';
import AppBar from 'material-ui/AppBar';
import IconButton from 'material-ui/IconButton';
import FlatButton from 'material-ui/FlatButton';
import ActionHome from 'material-ui/svg-icons/action/home';

const styles = {
    navStyle: {
        background: "whocares",
        backgroundColor: "whocares",
        boxShadow: "whocares",
        height: "10vh",
        position: "fixed",
        top: 0,
        left: 0,
        paddingLeft: "34px",
        paddingBottom: "5px"
    },
    mediumIcon : {
        height: 30,
        width: 30,
        cursor: "pointer"
    },
    medium: {
        width: "auto",
        height: "auto",
        cursor: "pointer"
    },
    logo:{
        width: "auto",
        height: "100%",
        cursor: "pointer"
    },
    linkLabel: {
        color: "#fff",
        textTransform: "capitalize"
    },
    centerLinksContainer: {
        width: "85%"
    },
    leftElementsContainer: {
        width: "95%"
    }
};

export default class Navbar extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
            <AppBar
                style={styles.navStyle}
                className="pokedex-navbar"
                iconStyleLeft={styles.leftElementsContainer}
            />
        );
    }
}


Navbar.propTypes = {
    toggleNavbar: T.func.isRequired
};
