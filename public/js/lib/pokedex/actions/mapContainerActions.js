import * as types from "./mapContainerTypes";

export const setNoticedAddingPokeLocationMsgTrue = () => {
    return {
        type: types.NOTICED_ADDING_SIGNAL_MSG_TRUE
    }
};
export const setNoticedAddingPokeLocationMsgFalse = () => {
    return {
        type: types.NOTICED_ADDING_SIGNAL_MSG_FALSE
    }
};

export const setNoticedAddEDPokeLocationMsgTrue = () => {
    return {
        type: types.NOTICED_ADDED_SIGNAL_MSG_TRUE
    }
};
export const setNoticedAddEDPokeLocationMsgFalse = () => {
    return {
        type: types.NOTICED_ADDED_SIGNAL_MSG_FALSE
    }
};

export const setNoticedFailedAddEDPokeLocationMsgTrue = () => {
    return {
        type: types.NOTICED_FAIL_ADDED_SIGNAL_MSG_TRUE
    }
};
export const setNoticedFailedAddEDPokeLocationMsgFalse = () => {
    return {
        type: types.NOTICED_FAIL_ADDED_SIGNAL_MSG_FALSE
    }
};
