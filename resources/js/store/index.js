import { createStore } from "vuex";
import axiosClient from "../axios";
import axios from "axios";
const store = createStore({
    strict: true,
    state: {
        user: {
            info: {},
            token: sessionStorage.getItem("TOKEN"),
        },
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
        register: ({ state, commit }, user) => {
            return axiosClient.post("/register", user).then(({ response }) => {
                if (response.success) {
                    commit("setUserInfo", response);
                }
                return response;
            });
        },
        logout({ commit }) {
            return axiosClient.post("/logout").then((response) => {
                commit("logout");
                return response;
            });
        },
        login({ commit }, user) {
            return axiosClient.post("/login", user).then(({ data }) => {
                if (data.status) {
                    commit("setUserInfo", data);
                }
                return data;
            });
        },
    },
    mutations: {
        setProgress: (state, per) => {
            state.uploads.percentage = per;
        },
        setUserInfo(state, data) {
            state.user.token = data.token;
            sessionStorage.setItem("TOKEN", data.token);
            state.user.info = data.user;
        },
        logout: (state) => {
            state.user.info = {};
            state.user.token = null;
            sessionStorage.removeItem("TOKEN");
        },
    },
    modules: {},
});

export default store;
