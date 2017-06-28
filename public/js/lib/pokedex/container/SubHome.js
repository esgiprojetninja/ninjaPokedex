import {connect} from "react-redux";
import SubHomeComponent from "../ui/SubHome";

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
