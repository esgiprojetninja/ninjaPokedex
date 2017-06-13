import React from "react";
import {PropTypes as T} from 'prop-types';

import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';
import MapSVG from 'material-ui/svg-icons/maps/place';

const styles = {
    container: {
        height: '80%',
        borderRadius: '10px'
    },
    icon: {
        height: '45px',
        width: '45px'
    },
    el: {
        margin: '20px 0 0 20px'
    },
    btn: {
        marginTop: '20px'
    }
};

export default class MapLegend extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    addPokemonHandler = () => {
        console.log("mofo i'm ill");
    }

    renderForm() {

    }

    renderDescription() {
        return (
            <div className="full-width margin-auto display-flex-column">
                <p style={{...styles.el, color: this.props.theme.current.palette.textColor}}>Regarde les Pokémons aux alentours et si tu n'en trouves pas, utilise la Recherche !</p>
                <RaisedButton
                    label="ajouter un pokémon"
                    secondary={true}
                    style={{...styles.btn, background: this.props.theme.current.palette.primary3Color, color: this.props.theme.current.palette.textColor}}
                    icon={<FontIcon className="muidocs-icon-custom-github" />}
                    onTouchTap={this.addPokemonHandler}
                />
            </div>
        )
    }

    render () {
        return (
            <div style={{...styles.container, background:this.props.theme.current.palette.primary2Color}} className="width-5 margin-auto display-flex-column justify-start">
                <div style={styles.el} className="margin-reset width-auto display-flex-row align-start">
                    <MapSVG style={styles.icon} color={this.props.theme.current.palette.textColor}/>
                    <h3 style={{color: this.props.theme.current.palette.textColor}} className="uppercase header-title">map</h3>
                </div>
                {this.renderDescription()}
            </div>
        );
    }
}
