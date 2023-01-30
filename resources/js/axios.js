import axios from "axios";
import store from "./store";

const axiosClient = axios.create({
    baseURL: "http://localhost:8000/api",
    onUploadProgress: function (progressEvent) {
        const percentage = Math.round(
            (progressEvent.loaded / progressEvent.total) * 100
        );
        store.commit("setProgress", percentage);
    },
});

axiosClient.interceptors.request.use((config) => {
    // config.headers.Authorization = `Bearer ${store.state.user.token}`;
    return config;
});

export default axiosClient;
