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
import StringSimilarity from 'string-similarity';

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

    renderTypes(thisP, thisK) {
        return (
            <div className="search-checkbox-wrapper" key={thisK}>
              <Checkbox
                checkedIcon={<ActionFavorite />}
                uncheckedIcon={<ActionFavoriteBorder style={{fill: 'white'}} />}
                label={thisP.name_type}
                labelStyle={{
                    backgroundColor: thisP.color,
                    width: 'auto',
                    color: 'white',
                    borderBottomLeftRadius: '10px',
                    borderTopRightRadius: '10px',
                    fontSize: '11px',
                    minWidth: '80px',
                    textAlign: 'center'
                }}
                iconStyle={styles.checkboxIcon}
                style={styles.checkbox}
              />
            </div>
        )
    }

    render () {
        return (
          <div className="search-fixed">
            <IconButton onClick={this.props.toggleSearch} style={styles.buttonClose} iconStyle={styles.iconClose} children={<Close/>}/>
            <Grid>
              <Row>
                <Col md={12} className="search-content">
                  <div className="search-intro">Tape le nom dun Pokémon et appuies sur entrée</div>
                  <input
                      onChange={(event) => {
                         const target = this.props.pokemons.all.filter(pokemon => StringSimilarity.compareTwoStrings(pokemon.name, event.target.value) > 0.5);
                         if(target) {
                             this.props.setSearchedPokemons(target);
                         }
                      }}
                      className="search-input"
                      type="text"
                      placeholder="Rechercher"
                  />
                  <span className="search-found"><span className="search-found-count">{this.props.pokesearch.searchedPokemons.length}</span> Pokémon trouvé</span>
                  <div className="filters filters-type">
                      <span className="filters-name">Types :</span>
                      {
                          (this.props.types.all.map((thisP, thisKey) => this.renderTypes(thisP, thisKey)))
                      }
                  </div>
                </Col>
              </Row>
            </Grid>
          </div>
        )
    }
}
