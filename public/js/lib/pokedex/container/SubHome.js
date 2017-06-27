import {connect} from "react-redux";
import SubHomeComponent from "../ui/SubHome";

import {
    testAction
} from "../actions/subHomeActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {

    };
}

const SubHome = connect(
    mapStateToProps,
    mapDispatchToProps
)(SubHomeComponent);

export default SubHome;
