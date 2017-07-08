import {connect} from "react-redux";
import PokeSearchComponent from "../ui/PokeSearch";

import {
    toggleSearch,
} from "../actions/navbarActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        toggleSearch() {
            dispatch(toggleSearch());
        }
    };
}

const PokeSearch = connect(
    mapStateToProps,
    mapDispatchToProps
)(PokeSearchComponent);

export default PokeSearch;
