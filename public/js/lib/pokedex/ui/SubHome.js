import React from "react";
import {PropTypes as T} from 'prop-types';
import {Grid, Row, Col} from 'react-bootstrap';
import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';
import LocationSVG from 'material-ui/svg-icons/action/room';
import AddCircleOutlineSVG from 'material-ui/svg-icons/content/add-circle-outline';
import scrollToElement from 'scroll-to-element';

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
        <div className="text-center title-btn-wrapper hidden-xs">
          <RaisedButton
            target="_blank"
            label="Voir la map"
            labelColor="#ffffff"
            secondary={true}
            buttonStyle={{backgroundColor: this.props.theme.current.palette.primary1Color}}
            style={styles.button}
            icon={<LocationSVG/>}
            onTouchTap={
                () => {
                    scrollToElement('.map-wrapper');
                }
            }
          />
        </div>
      )
    }

    render () {
        return (
          <div className="align full-height hidden-xs hidden-sm">
            <div className="subtitle-wrapper">
              {this.renderSubTitle()}
              {this.renderSubtitleBtn()}
            </div>
            <div className="full-height align">
              <img className="random-btn-image" src="img/randomBtn.png"/>
            </div>
          </div>
        )
    }
}

SubHome.propTypes = {
    theme: T.shape({
        current: T.shape({})
    })
};
