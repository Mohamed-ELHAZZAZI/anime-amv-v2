import { createStore } from "vuex";
import axiosClient from "../axios";
import axios from "axios";
const store = createStore({
    state: {
        uploads: {
            percentage: 0,
        },
    },
    getters: {},
    actions: {
        postAmv: ({ state, commit }, data) => {
            return axiosClient
                .post("/save-amv", data)
                .then((response) => {
                    state.uploads.percentage = 0;
                    return response;
                })
                .catch((error) => {
                    state.uploads.percentage = 0;
                    return error;
                });
        },
        getAmv: ({ state, commit }) => {
            return axiosClient.get("/get-amv").then((response) => {
                return response;
            });
        },
    },
    mutations: {
        setProgress: (state, per) => {
            state.uploads.percentage = per;
        },
    },
    modules: {},
});

export default store;
