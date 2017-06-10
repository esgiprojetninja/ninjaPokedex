import {connect} from "react-redux";
import CardsComponent from "../ui/Cards";

import {
    toggleCards,
    testAction
} from "../actions/cardsActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        toggleCards() {
            dispatch(toggleCards());
        },
        testAction() {
            dispatch(testAction());
        }
    };
}

const Cards = connect(
    mapStateToProps,
    mapDispatchToProps
)(CardsComponent);

export default Cards;
