import { SETPHOTODATA, SETSELECTPHOTO } from "./action";
const initState = {
    photo: [],
};

export default (state = initState, action) => {
    switch (action.type) {
        case SETPHOTODATA: {
            return {
                ...state,
                photo: action.data,
            };
        }
        case SETSELECTPHOTO: {
            return {
                ...state,
                photo: [
                    ...state.photo.slice(0, action.index),
                    {
                        ...state.photo[action.index],
                        selected: !state.photo[action.index].selected,
                    },
                    ...state.photo.slice(action.index + 1),
                ],
            };
        }
        default:
            return state;
    }
};
