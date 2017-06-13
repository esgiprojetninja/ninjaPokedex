import React from "react";
import thunk from "redux-thunk";
import { createStore, applyMiddleware } from "redux";
import { render } from "react-dom";
import { BrowserRouter, Route } from 'react-router-dom';
import { Provider } from "react-redux";

import MainReducer from "./reducers/main";
import App from "./container/App";

import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import muiThemeable from 'material-ui/styles/muiThemeable';

import spacing from 'material-ui/styles/spacing';
import {fade} from 'material-ui/utils/colorManipulator';
import {
    indigo400,
    cyan700,
    grey400,
    pinkA200,
    grey100,
    grey500,
    darkBlack,
    white,
    grey300,
    fullBlack
} from 'material-ui/styles/colors';

import injectTapEventPlugin from 'react-tap-event-plugin';

injectTapEventPlugin();

// const mainColor = indigo400;

const muiTheme = getMuiTheme({
    spacing: spacing,
    fontFamily: 'Roboto, sans-serif',
    palette: {
        // primary1Color: mainColor,
        // primary2Color: cyan700,
        // primary3Color: grey400,
        // accent1Color: pinkA200,
        // accent2Color: grey100,
        // accent3Color: grey500,
        textColor: white,
        alternateTextColor: white,
        // canvasColor: white,
        // borderColor: grey300,
        // disabledColor: fade(darkBlack, 0.3),
        // pickerHeaderColor: mainColor,
        // clockCircleColor: fade(darkBlack, 0.07),
        // shadowColor: fullBlack,
    },
    appBar: {
        // color: mainColor
    },
    button: {
        // backgroundColor: white,
        // textColor: mainColor
    },
    icon: {
        // backgroundColor: white,
        // textColor: mainColor
    }
});

const recruitmentApp = {
    startApp() {
        const store = createStore(
            MainReducer,
            applyMiddleware(thunk)
        );
        store.subscribe(() => {
            console.group();
            console.debug(store.getState());
            console.groupEnd();
        });

        render(
          <MuiThemeProvider muiTheme={muiTheme}>
              <Provider store={store}>
              <BrowserRouter>
                  <Route path="/" component={App}/>
              </BrowserRouter>
              </Provider>
          </MuiThemeProvider>,
            document.getElementById("pokedexApp")
        );
    }
};

export default recruitmentApp;
