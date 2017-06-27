import {connect} from "react-redux";
import NavbarComponent from "../ui/Navbar";

import {
    toggleNavbar,
    testAction,
    toggleSearch
} from "../actions/navbarActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        toggleNavbar() {
            dispatch(toggleNavbar());
        },
        toggleSearch() {
            dispatch(toggleSearch());
        }
    };
}

const Navbar = connect(
    mapStateToProps,
    mapDispatchToProps
)(NavbarComponent);

export default Navbar;
