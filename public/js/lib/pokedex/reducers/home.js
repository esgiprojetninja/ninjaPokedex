import * as types from "../actions/homeTypes";

const initialSate = {
    show: true
};

const navbar = (state = initialSate, action) => {
    switch (action.type) {
        case types.TOGGLE_DISPLAY:
            return {
                ...state,
                show: !state.display
            }
        default:
            return state;
    }
};

export default home;
