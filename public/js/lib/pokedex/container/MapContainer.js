import {connect} from "react-redux";
import MapContainerComponent from "../ui/MapContainer";
import {
    mapLoaded,
    addMarker
} from "../actions/mapWrapActions";

const mapStateToProps = state => state;

const mapDispatchToProps = dispatch => {
    return {
        mapLoaded(mapComponent){
            dispatch(mapLoaded(mapComponent))
        },
        addMarker(marker) {
            dispatch(addMarker(marker))
        }
    }
}

const MapContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(MapContainerComponent);

export default MapContainer;
