import {connect} from "react-redux";
import CardComponent from "../ui/Card";

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
