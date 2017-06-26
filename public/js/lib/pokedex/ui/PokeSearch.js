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

    render () {
        return (
          <div className="search-fixed">
            <IconButton onClick={this.props.toggleSearch} style={styles.buttonClose} iconStyle={styles.iconClose} children={<Close/>}/>
            <Grid>
              <Row>
                <Col md={12} className="search-content">
                  <div className="search-intro">Tape le nom dun Pokémon et appuies sur entrée</div>
                  <input className="search-input" type="text" placeholder="Rechercher"/>
                  <span className="search-found"><span className="search-found-count">1</span> Pokémon trouvé</span>
                  <div className="filters filters-type">
                      <span className="filters-name">Types :</span>
                      <ul>
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
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Acier"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Glace"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                      </ul>
                      <ul>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Feu"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Eau"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Plante"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                      </ul>
                      <ul>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Psy"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Poison"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Fée"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                      </ul>
                      <ul>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Combat"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Electrik"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Vol"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                      </ul>
                      <ul>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Roche"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Insecte"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
                        <li>
                          <Checkbox
                            checkedIcon={<ActionFavorite />}
                            uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                            label="Sol"
                            labelStyle={styles.checkboxLabel}
                            iconStyle={styles.checkboxIcon}
                            style={styles.checkbox}
                          />
                        </li>
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
