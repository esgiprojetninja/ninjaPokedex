import * as types from "../actions/carouselTypes";

const initialSate = {
    showDetails: false
};

const carousel = (state = initialSate, action) => {
    switch (action.type) {
        case types.TOGGLE_DETAILS:
            return {
                ...state,
                showDetails: !state.showDetails
            }
        default:
            return state;
    }
};

export default carousel;
