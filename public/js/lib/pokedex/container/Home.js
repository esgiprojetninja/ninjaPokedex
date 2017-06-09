import {connect} from "react-redux";
import HomeComponent from "../ui/Home";

import {
} from "../actions/homeActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
    };
}

const Home = connect(
    mapStateToProps,
    mapDispatchToProps
)(HomeComponent);

export default Home;
