import {connect} from "react-redux";
import MapContainerComponent from "../ui/MapContainer";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
    }
}

const MapContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(MapContainerComponent);

export default MapContainer;
