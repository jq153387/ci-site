import React from "react";
import ReactDOM from "react-dom";
import { Provider } from "react-redux";
import "@babel/polyfill/noConflict";
import configureStore from "./store.js";
const { store, persistor } = configureStore();
import App from "./App";

ReactDOM.render(
    <Provider store={store}>
        <App />
    </Provider>,
    document.getElementById("app")
);
