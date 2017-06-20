import {connect} from "react-redux";
import HomeComponent from "../ui/Home";

import {
    toggleView,
    testAction
} from "../actions/homeActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        toggleView() {
            dispatch(toggleView());
        },
        testAction() {
            dispatch(testAction());
        }
    };
}

const Home = connect(
    mapStateToProps,
    mapDispatchToProps
)(HomeComponent);

export default Home;
