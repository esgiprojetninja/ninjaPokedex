import {connect} from "react-redux";
import TableComponent from "../ui/Table";

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
