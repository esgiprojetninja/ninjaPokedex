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
        maxWidth: '70px',
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
    },
    toggleNavbar: {
        borderRadius: '100%',
        background: 'white',
        right: '17px',
        top: '4.7px',
        width: '38px',
        height: '38px',
        padding: '2px'
    }
};

export default class Navbar extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderRoundEffectElement() {
        console.log("sup?");
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

        if ( !this.props.navbar.show ) {
            return (
                <div style={styles.leftContainer}>
                    {this.renderRoundEffectElement()}
                    <IconButton style={styles.toggleNavbar} onTouchTap={this.props.toggleNavbar} children={<ToggleSVG color="rgb(0, 188, 212)"/>}/>
                </div>
            )
        } else {
            return (
                <IconButton style={styles.toggleNavbar} onTouchTap={this.props.toggleNavbar} children={<ToggleSVG color="rgb(0, 188, 212)"/>}/>
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
                iconStyleRight={styles.leftContainer}
                iconElementRight={this.renderRightElementChildren()}
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
