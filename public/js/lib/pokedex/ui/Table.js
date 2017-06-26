import React from "react";
import {PropTypes as T} from 'prop-types';
import {Grid, Row, Col} from 'react-bootstrap';
import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';
import IconButton from 'material-ui/IconButton';
import LocationSVG from 'material-ui/svg-icons/action/room';
import Card from '../container/Card';

const styles = {

};

export default class Table extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    renderCards (p, key) {
      return (
          <div key={key} className="card text-center table-card" style={{display: 'inline-block', margin: '15px'}}>
            <span className="card-number">{this.props.pokemons.all[key].id_national}</span>
            <img src={this.props.pokemons.all[key].icon} className="card-pokemon"/>
            <span className="card-title table-title">
              {this.props.pokemons.all[key].name}
            </span>
            <div className="card-type table-type align">
              <img src="img/feu.png"/>
            </div>
          </div>
        )
    }

    render () {
      if(this.props.pokemons.all) {
        return (
          <Grid>
            <Row>
              <Col md={12} style={{textAlign: 'center'}}>
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
                {(this.props.pokemons.all.map((p, key) => this.renderCards(p, key)))}
              </Col>
            </Row>
          </Grid>
        )
      } else {
        return (
          <div>
            Loading...
          </div>
        )
      }
    }
}
