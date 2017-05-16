import React from "react";
import thunk from "redux-thunk";
import { createStore, applyMiddleware } from "redux";
import { render } from "react-dom";
import { BrowserRouter, Route } from 'react-router-dom';
import { Provider } from "react-redux";

import MainReducer from "./reducers/main";
import App from "./container/App";

import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

import injectTapEventPlugin from 'react-tap-event-plugin';

injectTapEventPlugin();

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
          <MuiThemeProvider>
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
