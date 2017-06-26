import * as types from "../actions/pokesearchTypes";

const initialSate = {

};

const pokesearch = (state = initialSate, action) => {
    switch (action.type) {
        case types.TOGGLE_SEARCH:
            return {
                ...state
            }
        default:
            return state;
    }
};

export default pokesearch;
