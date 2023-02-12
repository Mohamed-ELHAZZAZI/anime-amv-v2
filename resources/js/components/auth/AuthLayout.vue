<template>
    <div
        class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-60 z-10 flex items-center justify-center"
    >
        <div class="w-full max-w-[550px] overflow-hidden rounded-md">
            <div class="h-full bg-prussianBlue px-10 py-4 relative">
                <button
                    class="absolute top-3 right-3 text-white"
                    @click="closeAuthModel"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-7 h-7"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
                <div class="mb-4 border-b border-gray-700">
                    <ul
                        class="flex flex-wrap -mb-px text-sm font-medium text-center text-white"
                    >
                        <li
                            :class="[
                                active === 'login'
                                    ? 'text-utOrange border-utOrange'
                                    : 'hover:text-gray-400 border-transparent',
                            ]"
                            class="border-b-2 w-1/2"
                        >
                            <button
                                class="inline-block p-4 h-full w-full"
                                @click="active = 'login'"
                                type="button"
                            >
                                Login
                            </button>
                        </li>
                        <li
                            :class="[
                                active === 'register'
                                    ? 'text-utOrange border-utOrange'
                                    : 'hover:text-gray-400 border-transparent',
                            ]"
                            class="border-b-2 w-1/2 cursor-pointer"
                        >
                            <button
                                class="inline-block p-4 h-full w-full"
                                @click="active = 'register'"
                                type="button"
                            >
                                Register
                            </button>
                        </li>
                    </ul>
                </div>
                <LoginForm v-if="active === 'login'" />
                <RegisterForm v-else-if="active === 'register'" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import LoginForm from "./LoginForm.vue";
import RegisterForm from "./RegisterForm.vue";
const emit = defineEmits(["closeAuthModel"]);
function closeAuthModel() {
    emit("closeAuthModel");
}

const active = ref("login");
</script>

<style></style>
