import * as types from "../actions/subHomeTypes";

const initialSate = {
    show: true
};

const subhome = (state = initialSate, action) => {
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

export default subhome;
