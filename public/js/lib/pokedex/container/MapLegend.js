import {connect} from "react-redux";
import MapLegendComponent from "../ui/MapLegend";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {

    }
}

const MapLegend = connect(
    mapStateToProps,
    mapDispatchToProps
)(MapLegendComponent);

export default MapLegend;
