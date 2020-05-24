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
            //尋找key
            const index = state.photo.findIndex((i) => {
                return i.id === action.id;
            });
            return {
                ...state,
                photo: [
                    ...state.photo.slice(0, index),
                    {
                        ...state.photo[index],
                        selected: !state.photo[index].selected,
                    },
                    ...state.photo.slice(index + 1),
                ],
            };
        }
        default:
            return state;
    }
};
