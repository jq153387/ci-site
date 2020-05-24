import React, { useState, useCallback, useEffect } from "react";
import { useDispatch } from "react-redux";
import axios from "axios";
import qs from "qs";
import { setPhotoDatas } from "../action";
import { TablePagination } from "@trendmicro/react-paginations";
// Be sure to include styles at some point, probably during your bootstraping
import "@trendmicro/react-paginations/dist/react-paginations.css";
export const Head = (props) => {
    const initPagination = {
        page: 1,
        pageLength: 20,
        totalRecords: 0,
    };
    const [pagination, setPagination] = useState(initPagination);
    const [photoData, setPhotoData] = useState({
        product: [],
        product_class: [],
        photo: [],
    });
    const [productClassID, setProductClassID] = useState(0);
    const [productID, setProductID] = useState(0);
    const dispatch = useDispatch();
    // 相似於 componentDidMount 和 componentDidUpdate:
    useEffect(() => {
        const data = { csrf_tsj: getCookie("csrf_cookie_tsj") };
        axios
            .post("album/album_photo_class", qs.stringify(data))
            .then((response) => {
                const photo = response.data.photo;
                const product = response.data.product;
                const product_class = response.data.product_class;
                console.log(response.data);
                setProductClassID(response.data.setProductClassID);
                setProductID(response.data.setProductID);
                setPhotoData({
                    ...photoData,
                    photo,
                    product,
                    product_class,
                });
                setPagination({
                    ...pagination,
                    totalRecords: response.data.photo.length,
                });
                const pagestart =
                    (initPagination.page - 1) * initPagination.pageLength; //1-1*20
                const pageend =
                    pagestart > 0
                        ? pagestart + initPagination.pageLength
                        : initPagination.pageLength;
                const photos = photo.slice(pagestart, pageend);
                dispatch(setPhotoDatas(photos));
                props.setLoadPhotoData(photos);
                props.setLoading(false);
            });
    }, [dispatch]);
    const loadPhoto = (id) => {
        const data = { id: id, csrf_tsj: getCookie("csrf_cookie_tsj") };
        axios
            .post("album/album_photo", qs.stringify(data))
            .then((response) => {
                console.log(response.data);
                setPagination({
                    page: 1,
                    pageLength: 20,
                    totalRecords: response.data.photo.length,
                });
                //資料數
                const pagestart =
                    (initPagination.page - 1) * initPagination.pageLength; //1-1*20
                const pageend =
                    pagestart > 0
                        ? pagestart + initPagination.pageLength
                        : initPagination.pageLength;

                setPhotoData({ ...photoData, photo: response.data.photo });

                setProductID(id);
                const photo = response.data.photo.filter((item) => {
                    return id == item.product_id;
                });
                const photos = photo.slice(pagestart, pageend);
                dispatch(setPhotoDatas(photos));
                props.setLoadPhotoData(photos);
                props.setLoading(false);
            })
            .catch((error) => {
                console.log(error);
            });
    };
    const productOption = () => {
        const selectProduct = photoData.product.filter(
            (item) => productClassID == item.sub_class_id
        );

        return selectProduct.map((item) => (
            <option key={item.id} value={item.id}>
                {item.name}
            </option>
        ));
    };
    const productClassOption = () => {
        return photoData.product_class.map((item) => (
            <option key={item.id} value={item.id}>
                {item.name}
            </option>
        ));
    };
    const setProductSubID = (value) => {
        setProductClassID(value);
        const filtered = photoData.product.filter((item) => {
            return value == item.sub_class_id;
        });
        setProductID(filtered[0].id);
        props.setLoading(true);
        loadPhoto(filtered[0].id);
    };
    const setPhotosData = (value) => {
        const photo = photoData.photo.filter((item) => {
            return value == item.product_id;
        });
        setProductID(value);
        props.setLoading(true);
        loadPhoto(value);
    };
    return (
        <div style={{ marginBottom: "10px" }}>
            <div style={{ display: "flex" }}>
                <div
                    className="form-inline"
                    style={{ flexGrow: "2", paddingTop: "8px" }}
                >
                    <div className="form-group">
                        <select
                            className="form-control"
                            style={{ minWidth: "120px" }}
                            onChange={() => setProductSubID(event.target.value)}
                            value={productClassID}
                        >
                            {productClassOption()}
                        </select>
                    </div>{" "}
                    {productClassID > 0 ? (
                        <div className="form-group">
                            <select
                                className="form-control"
                                style={{ minWidth: "120px" }}
                                onChange={() =>
                                    setPhotosData(event.target.value)
                                }
                                value={productID}
                            >
                                {productOption()}
                            </select>
                        </div>
                    ) : (
                        ""
                    )}
                </div>
                <TablePagination
                    type="reduced"
                    page={pagination.page}
                    pageLength={pagination.pageLength}
                    totalRecords={pagination.totalRecords}
                    onPageChange={({ page, pageLength }) => {
                        setPagination({
                            ...pagination,
                            page,
                            pageLength,
                        });
                        const pagestart = (page - 1) * pageLength; //1-1*20
                        const pageend =
                            pagestart > 0 ? pagestart + pageLength : pageLength;
                        const photos = photoData.photo.slice(
                            pagestart,
                            pageend
                        );
                        dispatch(setPhotoDatas(photos));
                        props.setLoadPhotoData(photos);
                    }}
                    prevPageRenderer={() => <i className="fa fa-angle-left" />}
                    nextPageRenderer={() => <i className="fa fa-angle-right" />}
                />
            </div>
            <hr />
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
