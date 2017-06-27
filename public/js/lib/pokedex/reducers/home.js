import * as types from "../actions/homeTypes";

const initialSate = {
    showCarousel: true
};

const home = (state = initialSate, action) => {
    switch (action.type) {
        case types.TOGGLE_CAROUSEL:
            return {
                ...state,
                showCarousel: !state.showCarousel
            }
        default:
            return state;
    }
};

export default home;
