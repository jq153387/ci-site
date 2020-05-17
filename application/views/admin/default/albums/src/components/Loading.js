//import { StageSpinner } from "react-spinners-kit";
import React, { Component } from "react";
import PropagateLoader from "react-spinners/PropagateLoader";

import "./Loading.css";
const LoadComponent = () => (
    <div className="loader-item">
        <PropagateLoader
            sizeUnit={"px"}
            size={10}
            color={"#e5e5e5"}
            loading={true}
        />
        {/* <StageSpinner size={40} color="#686769" /> */}
    </div>
);

export default LoadComponent;
