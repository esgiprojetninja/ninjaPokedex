import {connect} from "react-redux";
import HomeComponent from "../ui/Home";

import {
    toggleNavbar,
    testAction
} from "../actions/homeActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        toggleNavbar() {
            dispatch(toggleNavbar());
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
