import * as types from "./themeTypes";

export const initTheme = theme => {
    return {
        type: types.INIT_THEME,
        theme
    }
}
