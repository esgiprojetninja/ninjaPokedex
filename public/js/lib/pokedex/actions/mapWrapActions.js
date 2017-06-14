import * as types from "./mapWrapTypes";

export const mapLoaded = mapRef => {
    return {
        type: types.MAP_LOADED,
        mapRef
    }
};

export const addMarker = marker => {
    return {
        type: types.ADD_MARKER,
        marker
    }
};
