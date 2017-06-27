import * as types from "../actions/carouselTypes";

const initialSate = {
    show: true
};

const carousel = (state = initialSate, action) => {
    switch (action.type) {
        case types.TOGGLE_DISPLAY:
            return {
                ...state,
                show: !state.show
            }
        default:
            return state;
    }
};

export default carousel;
