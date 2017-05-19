import React from "react";
import {PropTypes as T} from 'prop-types';
import AppBar from 'material-ui/AppBar';
import IconButton from 'material-ui/IconButton';
import FlatButton from 'material-ui/FlatButton';
import NavigationClose from 'material-ui/svg-icons/navigation/close';

const styles = {
};

export default class Navbar extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
            <AppBar
                title="Pokedex"
                iconElementLeft={<IconButton><NavigationClose /></IconButton>}
                iconElementRight={<FlatButton label="Oops" onTouchTap={this.props.testAction} />}
            />
        );
    }
}


Navbar.propTypes = {
    toggleNavbar: T.func.isRequired,
    testAction: T.func.isRequired
};
