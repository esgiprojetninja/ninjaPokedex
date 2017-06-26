import React from "react";
import {PropTypes as T} from 'prop-types';
import {Grid, Row, Col} from 'react-bootstrap';
import IconButton from 'material-ui/IconButton';
import Close from 'material-ui/svg-icons/action/highlight-off';
import AutoComplete from 'material-ui/AutoComplete';

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
                <Col md={8} className="search-content">
                  <AutoComplete
                    floatingLabelText="Tape le nom d'un Pokémon et appuies sur entrée"
                    filter={AutoComplete.caseInsensitiveFilter}
                    dataSource={colors}
                    fullWidth={true}
                  />
                </Col>
              </Row>
            </Grid>
          </div>
        )
    }
}
