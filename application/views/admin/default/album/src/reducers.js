import { SETPHOTODATA, SETSELECTPHOTO, SETPAGINATION } from "./action";
const initState = {
    product_class: "",
    product: "",
    photo: [],
    pagination: { page: 1, pageLength: 20, totalRecords: 0 },
};

export default (state = initState, action) => {
    switch (action.type) {
        case SETPHOTODATA: {
            return {
                ...state,
                photo: action.data.photo,
                product_class: action.data.product_class,
                product: action.data.product,
                pagination: action.data.pagination,
            };
        }
        case SETPAGINATION: {
            return {
                ...state,
                pagination: action.data,
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
