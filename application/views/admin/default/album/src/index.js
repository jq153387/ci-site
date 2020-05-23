import React, { useState, useCallback, useEffect } from "react";
import ReactDOM from "react-dom";

import Gallery from "react-photo-gallery";
import Carousel, { Modal, ModalGateway } from "react-images";

import { Header } from "./components/Header";
import { Head } from "./components/Head";
import { colors } from "./components/theme";
import { smallDevice, largeDevice } from "./components/theme";
import LoadComponent from "./components/Loading";
import "@babel/polyfill/noConflict";

const navButtonStyles = (base) => ({
    ...base,
    backgroundColor: "white",
    boxShadow: "0 1px 6px rgba(0, 0, 0, 0.18)",
    color: colors.N60,

    "&:hover, &:active": {
        backgroundColor: "white",
        color: colors.N100,
        opacity: 1,
    },
    "&:active": {
        boxShadow: "0 1px 3px rgba(0, 0, 0, 0.14)",
        transform: "scale(0.96)",
    },
});
function App() {
    const [currentImage, setCurrentImage] = useState(0);
    const [viewerIsOpen, setViewerIsOpen] = useState(false);
    const [photoData, setPhotoData] = useState([]);
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
    const setLoadPhotoData = (props) => {
        // const photos = props.map((item) => {
        //     return { src: `/assets/uploads/${item.url}` };
        // });
        setPhotoData(props);
    };

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
                        <div style={{ flexGrow: "0" }}>
                            <a className="btn btn-default" href="#">
                                新增照片
                            </a>
                        </div>
                    </div>
                    <Gallery photos={photoData} onClick={openLightbox} />
                    <ModalGateway>
                        {viewerIsOpen ? (
                            <Modal
                                allowFullscreen={false}
                                closeOnBackdropClick={false}
                                index={currentImage}
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
                                    views={photoData.map((x) => ({
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

//render(<App />, document.getElementById("app"));
ReactDOM.render(<App />, document.getElementById("app"));
