import React from "react";
import {PropTypes as T} from 'prop-types';
import {Grid, Row, Col} from 'react-bootstrap';
import RaisedButton from 'material-ui/RaisedButton';
import FontIcon from 'material-ui/FontIcon';
import Card from '../container/Card';

const styles = {

};

export default class Table extends React.PureComponent {
    constructor(props) {
        super(props);
    }

    render () {
        return (
          <div className="align">
            <Card/>
          </div>
        )
    }
}
