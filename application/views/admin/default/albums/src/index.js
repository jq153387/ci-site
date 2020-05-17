import React, { useState, useCallback } from "react";
import ReactDOM from "react-dom";
import Gallery from "react-photo-gallery";
import Carousel, { Modal, ModalGateway } from "react-images";
import { photos } from "./components/photos";
import { Header } from "./components/Header";
import { Head } from "./components/Head";
import { colors } from "./components/theme";
import { smallDevice, largeDevice } from "./components/theme";
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

    const openLightbox = useCallback((event, { photo, index }) => {
        setCurrentImage(index);
        setViewerIsOpen(true);
    }, []);

    const closeLightbox = () => {
        setCurrentImage(0);
        setViewerIsOpen(false);
    };

    // const CustomHeader = ({ innerProps, isModal }) =>
    //     isModal ? <div {...innerProps}>your component internals</div> : null;
    return (
        <div>
            <Head />
            <Gallery photos={photos} onClick={openLightbox} />
            <ModalGateway>
                {viewerIsOpen ? (
                    <Modal
                        allowFullscreen={false}
                        closeOnBackdropClick={false}
                        onClose={closeLightbox}
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
                            views={photos.map((x) => ({
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
    );
}

//render(<App />, document.getElementById("app"));
ReactDOM.render(<App />, document.getElementById("app"));
