// @flow

export const smallDevice = "@media (max-width: 769px)";
export const largeDevice = "@media (min-width: 770px)";
export const colors = {
    primary: "#00D7FF",
    red: "#BF2600",
    navy: "#0747A6",
    powderBlue: "#DEEBFF",

    // Neutrals
    N05: "#F4F5F7",
    N10: "#EBECF0",
    N20: "#C1C7D0",
    N40: "#97A0AF",
    N60: "#6B778C",
    N70: "#42526E",
    N80: "#253858",
    N90: "#172B4D",
    N100: "#091E42",
};
export const navButtonStyles = (base) => ({
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
