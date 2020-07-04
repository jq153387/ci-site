// import React, { useState, useCallback, useEffect } from "react";
import axios from "axios";
export const SETPHOTODATA = "SETPHOTODATA";
export const SETSELECTPHOTO = "SETSELECTPHOTO";
export const SETPAGINATION = "SETPAGINATION";

export const setPhotoDatas = (data) => ({
    type: SETPHOTODATA,
    data,
});

export const setPagination = (data) => ({
    type: SETPAGINATION,
    data,
});
export const setSelectPhotoData = (id) => ({
    type: SETSELECTPHOTO,
    id,
});
