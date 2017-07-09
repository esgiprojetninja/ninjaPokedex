import {connect} from "react-redux";
import NavbarComponent from "../ui/Navbar";

import {
    toggleNavbar,
    toggleSearch
} from "../actions/navbarActions";

import {
    getTableView
} from "../actions/homeActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        toggleNavbar() {
            dispatch(toggleNavbar());
        },
        toggleSearch() {
            dispatch(toggleSearch());
        },
        getTableView() {
            dispatch(getTableView());
        }
    };
}

const Navbar = connect(
    mapStateToProps,
    mapDispatchToProps
)(NavbarComponent);

export default Navbar;
