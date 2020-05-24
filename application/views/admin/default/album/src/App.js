import React, { useState, useCallback, useEffect } from "react";
import { useSelector } from "react-redux";
import Gallery from "react-photo-gallery";
import Carousel, { Modal, ModalGateway } from "react-images";
import SelectedImage from "./components/SelectedImage";
import { Header } from "./components/Header";
import { Head } from "./components/Head";
import { colors } from "./components/theme";
import { smallDevice, largeDevice, navButtonStyles } from "./components/theme";
import LoadComponent from "./components/Loading";
import "@babel/polyfill/noConflict";

export default function App() {
    const [currentImage, setCurrentImage] = useState(0);
    const [viewerIsOpen, setViewerIsOpen] = useState(false);
    const [editIsOpen, setEditIsOpen] = useState(false);
    const [photoData, setPhotoData] = useState([]);
    // 使用 useSelector 取出 Store 保管的 state
    const photo = useSelector((state) => state.photo);
    const [selectAll, setSelectAll] = useState(false);
    const openLightbox = useCallback((event, { photo, index }) => {
        setCurrentImage(index);
        setViewerIsOpen(true);
    }, []);
    const [loading, setLoading] = useState(true);
    const closeLightbox = () => {
        setCurrentImage(0);
        setViewerIsOpen(false);
    };
    const updateInfo = () => {};
    const setLoadPhotoData = (data) => {
        // const photos = props.map((item) => {
        //     return { src: `/assets/uploads/${item.url}` };
        // });
        setPhotoData(data);
    };
    const toggleSelectAll = () => {
        setSelectAll(!selectAll);
    };
    const imageRenderer = useCallback(
        ({ index, left, top, key, photo }) => {
            // console.log(photo);

            //setSelectPhotoID()
            return (
                <SelectedImage
                    selected={selectAll ? true : false}
                    key={key}
                    margin={"2px"}
                    index={index}
                    photo={photo}
                    left={left}
                    top={top}
                />
            );
        },
        [selectAll]
    );
    // const CustomHeader = ({ innerProps, isModal }) =>
    //     isModal ? <div {...innerProps}>your component internals</div> : null;
    return (
        <div>
            <Head setLoadPhotoData={setLoadPhotoData} setLoading={setLoading} />
            {!loading ? (
                <div>
                    <div className="box-header" style={{ display: "flex" }}>
                        {/* <h3 className="box-title" style={{ flexGrow: "2" }}>
                    新人謝卡{" "}
                </h3> */}
                        <div style={{ flexGrow: "2" }}>
                            <button className="btn btn-success" href="#">
                                新增
                            </button>{" "}
                            {!editIsOpen ? (
                                <button
                                    className="btn btn-primary"
                                    href="#"
                                    onClick={() => setEditIsOpen(true)}
                                >
                                    編輯
                                </button>
                            ) : (
                                <button
                                    className="btn btn-default"
                                    onClick={() => setEditIsOpen(false)}
                                >
                                    取消編輯
                                </button>
                            )}
                        </div>
                        {editIsOpen ? (
                            <div style={{ flexGrow: "0" }}>
                                <button
                                    className="btn btn-default"
                                    onClick={toggleSelectAll}
                                >
                                    全選
                                </button>
                                &nbsp;
                                <button
                                    className="btn btn-danger"
                                    onClick={toggleSelectAll}
                                >
                                    刪除
                                </button>
                            </div>
                        ) : (
                            ""
                        )}
                    </div>
                    <Gallery
                        photos={photo}
                        onClick={openLightbox}
                        renderImage={editIsOpen ? imageRenderer : undefined}
                    />
                    <ModalGateway>
                        {viewerIsOpen ? (
                            <Modal
                                allowFullscreen={false}
                                closeOnBackdropClick={false}
                                onClose={closeLightbox}
                                updateInfo={updateInfo}
                                styles={{
                                    blanket: (base) => ({
                                        ...base,
                                        backgroundColor: colors.N05,
                                    }),
                                    positioner: (base) => ({
                                        ...base,
                                        display: "block",
                                    }),
                                }}
                            >
                                <Carousel
                                    components={{ Footer: null, Header }}
                                    currentIndex={currentImage}
                                    views={photo.map((x) => ({
                                        ...x,
                                        srcset: x.srcSet,
                                        caption: x.title,
                                    }))}
                                    styles={{
                                        container: (base) => ({
                                            ...base,
                                            height: "100vh",
                                        }),
                                        view: (base) => ({
                                            ...base,
                                            alignItems: "center",
                                            display: "flex ",
                                            height: "calc(100vh - 54px)",
                                            justifyContent: "center",
                                            [largeDevice]: {
                                                padding: 20,
                                            },
                                            "& > img": {
                                                maxHeight: "calc(100vh - 94px)",
                                            },
                                        }),
                                        navigationPrev: navButtonStyles,
                                        navigationNext: navButtonStyles,
                                    }}
                                />
                            </Modal>
                        ) : null}
                    </ModalGateway>
                </div>
            ) : (
                <LoadComponent />
            )}
        </div>
    );
}
