<template>
    <div class="w-full h-full flex my-10">
        <form class="w-full" @submit.prevent="submitRegister">
            <div class="grid md:grid-cols-2 md:gap-4">
                <div class="relative z-0 w-full mb-6 group">
                    <input
                        :disabled="dataSent"
                        type="text"
                        name="first_name"
                        v-model="user.first_name"
                        id="floating_first_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-[var(--secondary-dark-color)] focus:outline-none focus:ring-0 focus:border-[var(--secondary-dark-color)] peer"
                        placeholder=" "
                        required
                    />
                    <formError
                        v-if="error.first_name"
                        :error="error.first_name"
                    />
                    <label
                        for="floating_first_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >First name</label
                    >
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input
                        :disabled="dataSent"
                        type="text"
                        name="last_name"
                        v-model="user.last_name"
                        id="floating_last_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-[var(--secondary-dark-color)] focus:outline-none focus:ring-0 focus:border-[var(--secondary-dark-color)] peer"
                        placeholder=" "
                        required
                    />
                    <formError
                        v-if="error.last_name"
                        :error="error.last_name"
                    />
                    <label
                        for="floating_last_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >Last name</label
                    >
                </div>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input
                    :disabled="dataSent"
                    type="email"
                    name="email"
                    v-model="user.email_address"
                    id="floating_email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-[var(--secondary-dark-color)] focus:outline-none focus:ring-0 focus:border-[var(--secondary-dark-color)] peer"
                    placeholder=" "
                    required
                />
                <formError
                    v-if="error.email_address"
                    :error="error.email_address"
                />
                <label
                    for="floating_email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >Email address</label
                >
            </div>
            <div class="relative z-0 w-full mb-2 group">
                <input
                    :disabled="dataSent"
                    :type="showPass ? 'text' : 'password'"
                    name="password"
                    v-model="user.password"
                    id="floating_password"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-[var(--secondary-dark-color)] focus:outline-none focus:ring-0 focus:border-[var(--secondary-dark-color)] peer"
                    placeholder=" "
                    autocomplete="current-password"
                    required
                />
                <formError v-if="error.password" :error="error.password" />
                <button
                    class="absolute z-50 text-gray-500 top-2 right-1"
                    type="button"
                    @click="showPass = !showPass"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                        v-if="showPass"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                    <svg
                        v-else
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"
                        />
                    </svg>
                </button>
                <label
                    for="floating_password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >Password</label
                >
            </div>
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input
                        :disabled="dataSent"
                        type="checkbox"
                        name="agree"
                        value=""
                        v-model="user.agree"
                        class="w-4 h-4 focus:ring-0 focus:outline-none focus:shadow-none border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600"
                        required
                    />
                </div>
                <label
                    for="terms"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >I agree with the
                    <a
                        href="#"
                        class="text-[var(--secondary-dark-color)]hover:underline dark:text-[var(--secondary-dark-color)]"
                        >terms and conditions</a
                    ></label
                >
            </div>
            <formError v-if="error.agree" :error="error.agree" />
            <button
                :disabled="dataSent"
                class="h-10 mt-10 bg-[var(--secondary-dark-color)] rounded-md w-full text-white capitalize"
            >
                <span v-if="!dataSent">register</span>
                <div v-else role="status">
                    <svg
                        aria-hidden="true"
                        class="inline w-7 h-7 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300"
                        viewBox="0 0 100 101"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor"
                        />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill"
                        />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import store from "../../store";
import formError from "./formError.vue";

const showPass = ref(false);
const dataSent = ref(false);
const user = {
    first_name: "",
    last_name: "",
    email_address: "",
    agree: "",
    password: "",
};

const error = ref({
    first_name: "",
    last_name: "",
    email_address: "",
    agree: "",
    password: "",
});

function submitRegister() {
    let proceed = true;
    for (const key in user) {
        if (Object.hasOwnProperty.call(user, key)) {
            const element = user[key];
            if (key != "agree") {
                if (element === "") {
                    error.value[key] =
                        "The " + key.replace("_", " ") + " is required";
                    proceed = false;
                }
            } else {
                if (!element) {
                    error.value.agree =
                        "Agree with the terms and conditions to proceed";
                    proceed = false;
                }
            }
        }
    }
    if (proceed) {
        dataSent.value = true;
        store.dispatch("register", user).catch((res) => {
            dataSent.value = false;
            let err = res.response.data.error;
            for (const key in error.value) {
                if (Object.hasOwnProperty.call(err, key)) {
                    error.value[key] = err[key][0];
                }
            }
        });
    }
}
</script>

<style></style>
