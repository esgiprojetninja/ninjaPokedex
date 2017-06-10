import * as types from "../actions/cardsTypes";

const initialSate = {
    show: true
};

const cards = (state = initialSate, action) => {
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

export default cards;
