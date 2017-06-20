import React from "react";
import {PropTypes as T} from 'prop-types';
import MapContainer from '../container/MapContainer';
import Cards from "../container/Cards";
import {Grid, Row, Col} from 'react-bootstrap';
import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';

const styles = {
  button: {
    margin: 12,
    width: 'auto'
  },
  exampleImageInput: {
    cursor: 'pointer',
    position: 'absolute',
    top: 0,
    bottom: 0,
    right: 0,
    left: 0,
    width: '100%',
    opacity: 0,
  },
};

export default class Home extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
          <Grid className="container full-height full-width">
            <section className="index-wrapper full-height full-width">
              <Row className="show-grid">
                <Col md={8} mdOffset={2}>
                  <Cards/>
                </Col>
                <Col md={6}>
                  <div className="title-lg-wrapper align">
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
                      <div className="text-center">
                        <RaisedButton
                          href="https://github.com/callemall/material-ui"
                          target="_blank"
                          label="Ajouter un pokémon"
                          labelColor="#ffffff"
                          backgroundColor="#a4c639"
                          style={styles.button}
                          icon={<FontIcon className="muidocs-icon-custom-github" />}
                        />
                        <RaisedButton
                          href="https://github.com/callemall/material-ui"
                          target="_blank"
                          label="Voir la map"
                          labelColor="#ffffff"
                          secondary={true}
                          style={styles.button}
                          icon={<FontIcon className="muidocs-icon-custom-github" />}
                        />
                      </div>
                    </div>
                  </div>
                </Col>
                <Col md={6}>
                  <img className="random-btn-image" src="img/randomBtn.png"/>
                </Col>
              </Row>
            </section>
            <MapContainer/>
          </Grid>
        );
    }
}
