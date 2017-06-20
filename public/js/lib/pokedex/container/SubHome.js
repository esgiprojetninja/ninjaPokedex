import {connect} from "react-redux";
import SubHomeComponent from "../ui/SubHome";

import {
    testAction
} from "../actions/subHomeActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        testAction() {
            dispatch(testAction());
        }
    };
}

const SubHome = connect(
    mapStateToProps,
    mapDispatchToProps
)(SubHomeComponent);

export default SubHome;