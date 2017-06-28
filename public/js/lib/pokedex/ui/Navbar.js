import React from "react";
import {PropTypes as T} from 'prop-types';
import AppBar from 'material-ui/AppBar';
import IconButton from 'material-ui/IconButton';
import FlatButton from 'material-ui/FlatButton';
import ToggleSVG from 'material-ui/svg-icons/image/dehaze';
import LocationSVG from 'material-ui/svg-icons/action/room';
import SearchSVG from 'material-ui/svg-icons/action/search';
import MailSVG from 'material-ui/svg-icons/content/mail';
import scrollToElement from 'scroll-to-element';

const styles = {
    navShow: {
        width: '100%',
        maxWidth: '240px',
        right: '0',
        position: 'fixed',
        transition: 'all .2s ease-in-out',
        maxHeight: '60px'
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
        right: '17px',
        top: '4.7px',
        width: '38px',
        height: '38px',
        padding: '2px'
    },
    iconHide: {
        transition: 'all .4s ease-in-out',
        width: 'cancer',
        height: 'cancer'
    },
    icon: {
      color: 'white'
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
            <IconButton className="animate slow fadeInHeaderIcon" onTouchTap={this.props.toggleSearch} style={styles.iconHide} iconStyle={styles.icon} tooltip="EXPLORER" children={<SearchSVG/>}/>
        )
    }

    renderMapElement() {
        return (
            <IconButton
                className="animate slow fadeInHeaderIcon"
                style={styles.iconHide}
                iconStyle={styles.icon}
                tooltip="MAP"
                children={<LocationSVG/>}
                onTouchTap={
                    () => {
                        scrollToElement('.map-wrapper');
                    }
                }
            />
        )
    }

    renderContactElement() {
        return (
            <IconButton className="animate slow fadeInHeaderIcon" style={styles.iconHide} iconStyle={styles.icon} tooltip="CONTACT" children={<MailSVG/>}/>
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

    renderToggleBtn() {
        return (
            <IconButton style={{...styles.toggleNavbar, background: this.props.theme.current.palette.primary2Color}} onTouchTap={this.props.toggleNavbar} children={<ToggleSVG color="white"/>}/>
        );
    }

    renderRightElementChildren() {
        if ( !this.props.navbar.show ) {
            return (
                <div style={styles.leftContainer}>
                    {this.renderRoundEffectElement()}
                    {this.renderToggleBtn()}
                </div>
            )
        }
        return this.renderToggleBtn();
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
    navbar: T.shape({
        show: T.bool.isRequired,
    }).isRequired,
    theme: T.shape({
        current: T.shape({})
    })
};
