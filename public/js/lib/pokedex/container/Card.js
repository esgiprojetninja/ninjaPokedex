import {connect} from "react-redux";
import CardComponent from "../ui/Card";

import {
    testAction
} from "../actions/cardActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {

    };
}

const Card = connect(
    mapStateToProps,
    mapDispatchToProps
)(CardComponent);

export default Card;
