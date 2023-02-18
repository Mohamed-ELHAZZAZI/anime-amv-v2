<template>
    <!-- @click.self="closeModel" -->
    <div
        class="fixed top-0 right-0 left-0 bottom-0 bg-black bg-opacity-40 z-30 flex justify-center items-center"
    >
        <div class="bg-white w-[850px] pt-14 p-7 rounded-md relative">
            <button
                :disabled="requestSent"
                type="button"
                @click="closeModel"
                class="absolute top-4 right-5 text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-800 hover:text-white"
            >
                <svg
                    aria-hidden="true"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <form class="w-full" @submit.prevent="updateInfo">
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-6">
                        <label
                            for="firstName"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >First name</label
                        >
                        <input
                            type="text"
                            id="firstName"
                            class="bg-gray-50 border focus:ring-utOrange border-gray-300 text-gray-900 text-sm rounded-lg focus:border-utOrange block w-full p-2.5"
                            placeholder="First name"
                            v-model="newInfo.first_name"
                        />
                        <formError
                            v-if="error.first_name"
                            :error="error.first_name"
                        />
                    </div>
                    <div class="mb-6">
                        <label
                            for="lastName"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Last name</label
                        >
                        <input
                            :disabled="requestSent"
                            type="text"
                            id="lastName"
                            class="bg-gray-50 border focus:ring-utOrange border-gray-300 text-gray-900 text-sm rounded-lg focus:border-utOrange block w-full p-2.5"
                            placeholder="Last name"
                            v-model="newInfo.last_name"
                        />
                        <formError
                            v-if="error.last_name"
                            :error="error.last_name"
                        />
                    </div>
                </div>
                <div class="mb-6">
                    <label
                        for="username"
                        class="block mb-2 text-sm font-medium text-gray-900"
                        >Username</label
                    >
                    <input
                        :disabled="requestSent"
                        type="text"
                        id="username"
                        @input="userCheck(newInfo.username)"
                        class="bg-gray-50 border focus:ring-utOrange border-gray-300 text-gray-900 text-sm rounded-lg focus:border-utOrange block w-full p-2.5"
                        placeholder="Username"
                        v-model="newInfo.username"
                    />
                    <formError v-if="error.username" :error="error.username" />
                </div>
                <div class="mb-6">
                    <label
                        for="email"
                        class="block mb-2 text-sm font-medium text-gray-900"
                        >Email address</label
                    >
                    <input
                        type="email"
                        id="email"
                        :disabled="requestSent"
                        class="bg-gray-50 border focus:ring-utOrange border-gray-300 text-gray-900 text-sm rounded-lg focus:border-utOrange block w-full p-2.5"
                        placeholder="email@example.com"
                        v-model="newInfo.email"
                    />
                    <formError v-if="error.email" :error="error.email" />
                </div>
                <div class="w-full flex">
                    <button
                        :disabled="disableBtn || requestSent"
                        :class="disableBtn ? 'bg-gray-400' : ''"
                        type="submit"
                        class="text-white ml-auto bg-utOrange focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                    >
                        <span v-if="!requestSent">Submit</span>
                        <div
                            v-else
                            role="status"
                            class="flex items-center justify-center w-full h-full"
                        >
                            <svg
                                aria-hidden="true"
                                class="inline w-7 h-7 mr-2 animate-spin text-gray-500 fill-gray-300"
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
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import store from "../../store";
import formError from "./formError.vue";

const router = useRouter();
const emit = defineEmits(["closeModel", "changeUserInfo"]);
const props = defineProps(["user"]);
const disableBtn = ref(false);
const requestSent = ref(false);
function closeModel() {
    newInfo.value = null;
    emit("closeModel");
}
const error = ref({
    first_name: "",
    last_name: "",
    username: "",
    email: "",
});
const newInfo = ref({
    id: props.user.id,
    first_name: props.user.firstName,
    last_name: props.user.lastName,
    username: props.user.username,
    email: props.user.email,
});

function updateInfo() {
    error.value.first_name = "";
    error.value.last_name = "";
    error.value.username = "";
    error.value.email = "";
    if (
        props.user.firstName == newInfo.value.first_name &&
        props.user.lastName == newInfo.value.last_name &&
        props.user.username == newInfo.value.username &&
        props.user.email == newInfo.value.email
    ) {
        return emit("closeModel");
    }
    let proceed = true;
    for (const key in newInfo.value) {
        if (Object.hasOwnProperty.call(newInfo.value, key)) {
            const element = newInfo.value[key];
            if (element == "") {
                error.value[key] =
                    "The " + key.replace("_", " ") + " field is required";
                proceed = false;
            } else {
                error.value[key] = "";
            }
        }
    }
    if (!userCheck(newInfo.value.username)) {
        return 0;
    }
    requestSent.value = true;
    store.dispatch("UpdateUser", newInfo.value).then((res) => {
        requestSent.value = false;
        if (!res.data.errors) {
            router.push({
                name: "UserPage",
                params: { username: res.data.user.username },
            });
            emit("changeUserInfo", res.data.user);
        } else if (res.data.errors === true) {
            emit("closeModel");
        } else {
            for (const key in res.data.errors) {
                if (Object.hasOwnProperty.call(res.data.errors, key)) {
                    const element = res.data.errors[key];
                    error.value[key] = res.data.errors[key][0];
                }
            }
        }
    });
}

function userCheck(event) {
    const regex = /^[a-zA-Z0-9.]+$/;
    const t = regex.test(event);
    if (!t) {
        disableBtn.value = true;
        error.value.username = "The username format is invalid.";
        return 0;
    } else {
        disableBtn.value = false;
        error.value.username = "";
        return 1;
    }
}
</script>

<style></style>
