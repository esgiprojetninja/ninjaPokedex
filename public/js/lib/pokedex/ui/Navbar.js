import React from "react";
import {PropTypes as T} from 'prop-types';
import AppBar from 'material-ui/AppBar';
import IconButton from 'material-ui/IconButton';
import FlatButton from 'material-ui/FlatButton';
import ToggleSVG from 'material-ui/svg-icons/image/dehaze';
import LocationSVG from 'material-ui/svg-icons/action/room';
import SearchSVG from 'material-ui/svg-icons/action/search';
import MailSVG from 'material-ui/svg-icons/content/mail';

const styles = {
    navShow: {
        width: '100%',
        maxWidth: '400px',
        right: '0',
        position: 'fixed',
        transition: 'all .2s ease-in-out'
    },
    navNotShowed: {
        width: '100%',
        maxWidth: '10px',
        right: '0',
        position: 'fixed',
        transition: 'all .2s ease-in-out'
    },
    leftContainer: {
        backgroundColor: 'inherit'
    },
    roundEl: {
        position: 'absolute',
        height: '150%',
        width: '90px',
        backgroundColor: 'inherit',
        left: '-40px',
        borderRadius: '100%',
        borderTopLeftRadius: '80%',
        top: 'calc(-50%)',
    }
};

export default class Navbar extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderRoundEffectElement() {
        return (
            <div style={styles.roundEl}></div>
        )
    }

    renderSearchElement() {
        return (
            <IconButton children={<SearchSVG color="white"/>}/>
        )
    }

    renderMapElement() {
        return (
            <IconButton children={<LocationSVG color="white"/>}/>
        )
    }

    renderContactElement() {
        return (
            <IconButton children={<MailSVG color="white"/>}/>
        )
    }

    renderLeftElements() {
        if ( this.props.navbar.show ) {
            return (
                <div style={styles.leftContainer}>
                    {this.renderRoundEffectElement()}
                    {this.renderSearchElement()}
                    {this.renderMapElement()}
                    {this.renderContactElement()}
                </div>
            )
        }
        return <div></div>;
    }

    renderRightElementChildren() {
        if ( this.props.navbar.show ) {
            return (
                <div>
                    {this.renderRoundEffectElement()}
                    <ToggleSVG color="white"/>
                </div>
            )
        } else {
            return (
                <ToggleSVG color="white"/>
            );
        }
    }

    render () {
        return (
            <AppBar
                title=""
                style={this.props.navbar.show ? styles.navShow : styles.navNotShowed }
                iconElementLeft={this.renderLeftElements()}
                iconStyleLeft={styles.leftContainer}
                iconElementRight={<IconButton onTouchTap={this.props.toggleNavbar} children={this.renderRightElementChildren()}/>}
            />
        );
    }
}


Navbar.propTypes = {
    toggleNavbar: T.func.isRequired,
    testAction: T.func.isRequired,
    navbar: T.shape({
        show: T.bool.isRequired,
    }).isRequired
};
