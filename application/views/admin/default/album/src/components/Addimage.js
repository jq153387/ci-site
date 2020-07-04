import React, { useState, useCallback, useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { setPhotoDatas, setPagination } from "../action";
import axios from "axios";
import qs from "qs";
import InputFiles from "react-input-files";
function getCookie(name) {
    var arr = document.cookie.match(
        new RegExp("(^| )" + name + "=([^;]*)(;|$)")
    );
    if (arr != null) return unescape(arr[2]);
    return null;
}

export const Addimage = (props) => {
    const paginations = useSelector((state) => state.pagination);

    const dispatch = useDispatch();
    const [photoData, setPhotoData] = useState({
        product: [],
        product_class: [],
        photo: [],
    });
    //const [productClassID, setProductClassID] = useState(0);
    //const [productID, setProductID] = useState(0);
    const product = useSelector((state) => state.product);
    const product_class = useSelector((state) => state.product_class);
    const loadPhoto = (id, pclassid) => {
        const data = { id: id, csrf_tsj: getCookie("csrf_cookie_tsj") };
        axios
            .post("album/album_photo", qs.stringify(data))
            .then((response) => {
                console.log(response.data);
                const pagination = {
                    page: 1,
                    pageLength: 20,
                    totalRecords: response.data.photo.length,
                };
                //資料數
                const pagestart =
                    (paginations.page - 1) * paginations.pageLength; //1-1*20
                const pageend =
                    pagestart > 0
                        ? pagestart + paginations.pageLength
                        : paginations.pageLength;

                //setPhotoData({ ...photoData, photo: response.data.photo });

                //setProductID(id);
                const photo = response.data.photo.filter((item) => {
                    return id == item.product_id;
                });
                const photos = photo.slice(pagestart, pageend);
                dispatch(
                    setPhotoDatas({
                        photo,
                        product: id,
                        product_class: pclassid,
                        pagination,
                    })
                );
                props.setLoadPhotoData(photos);
                props.setLoading(false);
            })
            .catch((error) => {
                console.log(error);
            });
    };
    const onImportExcel = (files) => {
        // 獲取上傳的文件對象
        props.setLoading(true);
        const formData = new FormData();
        formData.append("csrf_tsj", getCookie("csrf_cookie_tsj"));
        formData.append("product_class", product_class);
        formData.append("product", product);
        //console.log(files);

        Array.from(files).forEach((image) => {
            formData.append("files[]", image);
        });
        //console.log(formData);
        axios
            .post("album/uploadImage", formData, {
                headers: { "Content-Type": "multipart/form-data" },
            })
            .then((res) => {
                console.log(res);
                loadPhoto(product, product_class);
            })
            .catch((err) => {
                console.log(err);
            });
        //fileReader.readAsBinaryString(files[0]);
    };
    return (
        <InputFiles
            accept=".jpg,.png,.jpeg,.gif"
            onChange={onImportExcel}
            multiple
        >
            <button title="按住Shift加選取多個圖檔" className="btn btn-success">
                上傳照片
            </button>
        </InputFiles>
    );
};

export const Deleteimage = (props) => {
    const photo = useSelector((state) => state.photo);
    const paginations = useSelector((state) => state.pagination);

    const dispatch = useDispatch();
    const [photoData, setPhotoData] = useState({
        product: [],
        product_class: [],
        photo: [],
    });
    const product = useSelector((state) => state.product);
    const product_class = useSelector((state) => state.product_class);
    const loadPhoto = (id, pclassid) => {
        const data = { id: id, csrf_tsj: getCookie("csrf_cookie_tsj") };
        axios
            .post("album/album_photo", qs.stringify(data))
            .then((response) => {
                console.log(response.data);
                const pagination = {
                    page: 1,
                    pageLength: 20,
                    totalRecords: response.data.photo.length,
                };
                //資料數
                const pagestart =
                    (paginations.page - 1) * paginations.pageLength; //1-1*20
                const pageend =
                    pagestart > 0
                        ? pagestart + paginations.pageLength
                        : paginations.pageLength;

                const photo = response.data.photo.filter((item) => {
                    return id == item.product_id;
                });
                const photos = photo.slice(pagestart, pageend);
                dispatch(
                    setPhotoDatas({
                        photo,
                        product: id,
                        product_class: pclassid,
                        pagination,
                    })
                );
                props.setLoadPhotoData(photos);
                props.setLoading(false);
            })
            .catch((error) => {
                console.log(error);
            });
    };
    const deleteSelect = () => {
        var msg = "您真的確定要刪除嗎？\n\n請確認！";
        if (confirm(msg) == true) {
            props.setLoading(true);
            const deletphoto = photo.filter((item) => {
                return item.selected;
            });
            const data = { deletphoto, csrf_tsj: getCookie("csrf_cookie_tsj") };
            axios
                .post("album/delete", qs.stringify(data))
                .then((response) => {
                    loadPhoto(product, product_class);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    };
    return (
        <button className="btn btn-danger" onClick={deleteSelect}>
            刪除
        </button>
    );
};
