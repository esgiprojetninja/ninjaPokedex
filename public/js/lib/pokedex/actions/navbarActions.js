import * as types from "./navbarTypes";

export const toggleNavbar = () => {
    return {
        type: types.TOGGLE_DISPLAY
    }
}

export const toggleSearch = () => {
    return {
        type: types.TOGGLE_SEARCH
    }
}

export const closeSearch = () => {
    return {
        type: types.CLOSE_SEARCH
    }
}
