import * as types from "./typeTypes";

import TypeApi from "../api/type";

const typeApi = new TypeApi();

const requestDispatched = () => {
    return {
        type: types.REQUESTING
    }
};

const requestFailed = error => {
    return {
        type: types.REQUEST_FAIL,
        error
    }
}

const receivedAllTypes = typesApi => {
    return {
        type: types.RECEIVED_ALL_TYPES,
        typesApi
    }
}

export const getAllTypes = () => {
    return dispatch => {
        dispatch(requestDispatched());
        typeApi.getAllTypes()
            .then( response => {
                if(response.error)
                    dispatch(requestFailed());
                else
                    dispatch(receivedAllTypes(response.data));
            })
            .catch( error => {dispatch(requestFailed(error))});
    };
}
