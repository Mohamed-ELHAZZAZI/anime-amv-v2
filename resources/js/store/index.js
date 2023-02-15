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
                    commit("setPercentage", 0);
                    return response;
                })
                .catch((error) => {
                    commit("setPercentage", 0);
                    return error;
                });
        },
        getAmv: ({ state, commit }, info) => {
            return axiosClient
                .get("/get-amv?start=" + info.start + "&&end=" + info.end)
                .then((response) => {
                    return response;
                });
        },
        register: ({ state, commit }, user) => {
            return axiosClient.post("/register", user).then((response) => {
                if (response.data.success) {
                    commit("setUserInfo", response.data);
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
                if (data.success) {
                    commit("setUserInfo", data);
                }
                return data;
            });
        },
        InfoWithToken({ commit }) {
            return axiosClient
                .get("/user")
                .then((res) => {
                    commit("setUserData", res.data);
                    return res.data;
                })
                .catch((err) => {
                    commit("logout");
                    return null;
                });
        },
        deletePost: ({ commit, state }, postId) => {
            return axiosClient
                .post("/delete-amv", { id: postId })
                .then((response) => {
                    return response;
                })
                .catch((err) => console.log(err));
        },
        getSingleAmv: ({ commit }, postId) => {
            return axiosClient.get("/get-single-amv/" + postId).then((res) => {
                return res;
            });
        },
        modifyAmv: ({ state, commit }, data) => {
            return axiosClient
                .post("/modify-amv", data)
                .then((response) => {
                    commit("setPercentage", 0);
                    return response;
                })
                .catch((error) => {
                    commit("setPercentage", 0);
                    return error;
                });
        },
        reactToAmv: ({ state, commit }, data) => {
            return axiosClient.post("/react-to-amv", data);
        },
        getComments: ({ state, commit }, post_id) => {
            return axiosClient
                .get("/getComment/" + post_id)
                .then((response) => {
                    return response;
                });
        },
        submitComment: ({ state, commit }, data) => {
            return axiosClient.post("/comment", data).then((response) => {
                return response;
            });
        },
    },
    mutations: {
        setProgress: (state, per) => {
            state.uploads.percentage = per;
        },
        setUserInfo: (state, data) => {
            state.user.token = data.token;
            sessionStorage.setItem("TOKEN", data.token);
            state.user.info = data.user;
        },
        setUserData: (state, data) => {
            state.user.info = data;
        },
        logout: (state) => {
            state.user.info = {};
            state.user.token = null;
            sessionStorage.removeItem("TOKEN");
        },
        setPercentage: (state, value) => {
            state.uploads.percentage = value;
        },
    },
    modules: {},
});

export default store;
