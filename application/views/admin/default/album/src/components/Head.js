import React, { useState, useCallback, useEffect } from "react";
import axios from "axios";
import qs from "qs";
export const Head = (props) => {
    // 相似於 componentDidMount 和 componentDidUpdate:
    useEffect(() => {
        const data = { id: 3454, csrf_tsj: getCookie("csrf_cookie_tsj") };
        axios
            .post("album/album_photo", qs.stringify(data))
            .then((response) => {
                console.log(response.data);

                props.setLoadPhotoData(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    }, []);

    return (
        <div style={{ marginBottom: "10px" }}>
            <a className="btn btn-default" href="#">
                新增
            </a>
        </div>
    );
};

function getCookie(name) {
    var arr = document.cookie.match(
        new RegExp("(^| )" + name + "=([^;]*)(;|$)")
    );
    if (arr != null) return unescape(arr[2]);
    return null;
}
// export default LoadComponent;
