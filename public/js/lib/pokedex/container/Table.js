import {connect} from "react-redux";
import TableComponent from "../ui/Table";

import {
    testAction
} from "../actions/tableActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {

    };
}

const Table = connect(
    mapStateToProps,
    mapDispatchToProps
)(TableComponent);

export default Table;
