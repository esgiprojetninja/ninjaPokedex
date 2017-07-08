import {connect} from "react-redux";
import HomeComponent from "../ui/Home";

import {
    toggleView,
} from "../actions/homeActions";

import {
    setSelectedPokemonForDetails,
    openDetails
} from "../actions/carouselActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        setSelectedPokemonForDetails(pokemon) {
            dispatch(setSelectedPokemonForDetails(pokemon));
        },
        toggleView() {
            dispatch(toggleView());
        },
        openDetails() {
            dispatch(openDetails());
        }
    };
}

const Home = connect(
    mapStateToProps,
    mapDispatchToProps
)(HomeComponent);

export default Home;
