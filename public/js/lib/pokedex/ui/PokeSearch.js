import React from "react";
import {PropTypes as T} from 'prop-types';
import {Grid, Row, Col} from 'react-bootstrap';
import IconButton from 'material-ui/IconButton';
import Close from 'material-ui/svg-icons/action/highlight-off';
import Checkbox from 'material-ui/Checkbox';
import {RadioButton, RadioButtonGroup} from 'material-ui/RadioButton';
import ActionFavorite from 'material-ui/svg-icons/action/favorite';
import ActionFavoriteBorder from 'material-ui/svg-icons/action/favorite-border';
import TextField from 'material-ui/TextField';

const colors = [
  'Red',
  'Orange',
  'Yellow',
  'Green',
  'Blue',
  'Purple',
  'Black',
  'White',
];

const styles = {
  buttonClose : {
    position: 'absolute',
    top: '0',
    right: '0',
    margin: '15px',
    height: '100px',
    width: '100px'
  },
  iconClose : {
    color: 'white',
    height: '80px',
    width: '80px'
  },
  checkbox: {
    color: 'white',
    width: 'auto'
  },
  checkboxLabel: {
    color: 'white',
    width: 'auto'
  },
  checkboxIcon: {
    color: 'white'
  }
};

export default class PokeSearch extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderTypes() {
        return (
            <li>
              <Checkbox
                checkedIcon={<ActionFavorite />}
                uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                label="Normal"
                labelStyle={styles.checkboxLabel}
                iconStyle={styles.checkboxIcon}
                style={styles.checkbox}
              />
            </li>
        )
    }

    render () {
        // {(this.props.carousel.selectedCurrent.type.map((ps, ks) => this.renderTypes(ps, ks)))}
        return (
          <div className="search-fixed">
            <IconButton onClick={this.props.toggleSearch} style={styles.buttonClose} iconStyle={styles.iconClose} children={<Close/>}/>
            <Grid>
              <Row>
                <Col md={12} className="search-content">
                  <div className="search-intro">Tape le nom dun Pokémon et appuies sur entrée</div>
                  <input onChange={() => {
                    console.log('Search for a pokemon');
                  }} className="search-input" type="text" placeholder="Rechercher"/>
                  <span className="search-found"><span className="search-found-count">1</span> Pokémon trouvé</span>
                  <div className="filters filters-type">
                      <span className="filters-name">Types :</span>
                      {this.renderTypes()}
                      <ul>
                    </ul>
                  </div>
                  <div className="filters filters-evolution">
                      <span className="filters-name">Evolution :</span>
                      <ul>
                        <li>
                        <RadioButtonGroup name="shipSpeed" defaultSelected="not_light">
                           <RadioButton
                             value="multiple"
                             label="Multiple"
                             checkedIcon={<ActionFavorite style={{color: '#F44336'}} />}
                             uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                             labelStyle={styles.checkboxLabel}
                             iconStyle={styles.checkboxIcon}
                             style={styles.checkbox}
                           />
                           <RadioButton
                             value="solo"
                             label="Solo"
                             checkedIcon={<ActionFavorite style={{color: '#F44336'}} />}
                             uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                             labelStyle={styles.checkboxLabel}
                             iconStyle={styles.checkboxIcon}
                             style={styles.checkbox}
                           />
                         </RadioButtonGroup>
                        </li>
                      </ul>
                  </div>
                </Col>
              </Row>
            </Grid>
          </div>
        )
    }
}
