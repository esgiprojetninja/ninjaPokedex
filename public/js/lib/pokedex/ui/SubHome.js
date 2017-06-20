import React from "react";
import {PropTypes as T} from 'prop-types';
import {Grid, Row, Col} from 'react-bootstrap';
import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';
import LocationSVG from 'material-ui/svg-icons/action/room';
import AddCircleOutlineSVG from 'material-ui/svg-icons/content/add-circle-outline';

const styles = {
  button: {
    margin: 12,
    width: 'auto'
  }
};

export default class SubHome extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderSubTitle () {
      return (
        <div>
          <span className="title-lg">
            Le pokedex
          </span>
          <span className="title-lg">
            le plus complet
          </span>
          <span className="title-lg">
            et le plus rapide
          </span>
        </div>
      )
    }

    renderSubtitleBtn() {
      return (
        <div className="text-center title-btn-wrapper">
          <RaisedButton
            href="https://github.com/callemall/material-ui"
            target="_blank"
            label="Ajouter un pokémon"
            labelColor="#ffffff"
            backgroundColor="#a4c639"
            style={styles.button}
            icon={<AddCircleOutlineSVG/>}
          />
          <RaisedButton
            href="https://github.com/callemall/material-ui"
            target="_blank"
            label="Voir la map"
            labelColor="#ffffff"
            secondary={true}
            style={styles.button}
            icon={<LocationSVG/>}
          />
        </div>
      )
    }

    render () {
        return (
          <div className="align">
            <div>
              {this.renderSubTitle()}
              {this.renderSubtitleBtn()}
            </div>
            <div>
              <img className="random-btn-image" src="img/randomBtn.png"/>
            </div>
          </div>
        )
    }
}