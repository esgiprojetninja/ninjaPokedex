import * as types from "../actions/cardTypes";

const initialSate = {
    show: true
};

const card = (state = initialSate, action) => {
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

export default card;
