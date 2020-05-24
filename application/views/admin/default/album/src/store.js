// configureStore.js
import { createStore, compose, applyMiddleware } from "redux";

import reducers from "./reducers.js";
import thunk from "redux-thunk";
const composeEnhancer = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

export default () => {
    let store = createStore(reducers, composeEnhancer(applyMiddleware(thunk)));
    return { store };
};
