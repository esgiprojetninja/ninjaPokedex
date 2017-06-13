import {connect} from "react-redux";
import MapLegendComponent from "../ui/MapLegend";
import {
    toggleForm,
    setSelectedPokemon
} from "../actions/mapLegendActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        toggleForm() {
            dispatch(toggleForm())
        },
        setSelectedPokemon(pokemon) {
            dispatch(setSelectedPokemon(pokemon))
        }
    }
}

const MapLegend = connect(
    mapStateToProps,
    mapDispatchToProps
)(MapLegendComponent);

export default MapLegend;
