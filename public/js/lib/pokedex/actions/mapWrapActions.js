import * as types from "./mapWrapTypes";

export const mapLoaded = mapRef => {
    return {
        type: types.MAP_LOADED,
        mapRef
    }
};

export const cleanMarker = marker => {
    if ( marker )
        marker.setMap(null);
    return {
        type: types.CLEAN_MARKER
    }
}

const addMarker = marker => {
    return {
        type: types.ADD_MARKER,
        marker
    }
}

export const changeMarker = marker => {
    return (dispatch, getState) => {
        dispatch(cleanMarker(getState().mapWrap.addedMarker));
        dispatch(addMarker(marker));
        marker.setMap(getState().mapWrap.mapComponent.getStreetView())
    }
};


const setTickFunc = tickFunc => {
    return {
        type: types.SET_TICK_FUNC,
        tickFunc
    }
}

const tick = () => {
    return {
        type: types.TICK
    }
}

export const start_tick = () => {
    return dispatch => {
        const tickFunc = setInterval(tick, 1500);
        dispatch(setTickFunc(tickFunc));
    }
}
