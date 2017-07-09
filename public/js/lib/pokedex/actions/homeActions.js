import * as types from "./homeTypes";

export const toggleView = () => {
    return {
        type: types.TOGGLE_CAROUSEL
    }
}

export const getTableView = () => {
    return {
        type: types.GET_TABLE_VIEW
    }
}
