<template>
    <nav
        v-if="screenWidth < 639 && showSearchNav"
        class="w-full h-16 bg-prussianBlue px-3 flex"
    >
        <div class="h-full w-full flex items-center gap-2 text-lightGray">
            <div class="relative flex w-full">
                <svg
                    class="absolute top-2 left-3 h-6 w-6"
                    version="1.1"
                    id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px"
                    y="0px"
                    viewBox="0 0 24 24"
                    xml:space="preserve"
                    fill="gray"
                >
                    <path
                        class="st0"
                        d="M19.6,21l-6.3-6.3c-0.5,0.4-1.1,0.7-1.7,0.9c-0.6,0.2-1.3,0.4-2.1,0.4c-1.8,0-3.4-0.6-4.6-1.9
	C3.6,12.9,3,11.3,3,9.5s0.6-3.4,1.9-4.6C6.1,3.6,7.7,3,9.5,3s3.4,0.6,4.6,1.9C15.4,6.1,16,7.7,16,9.5c0,0.7-0.1,1.4-0.4,2.1
	c-0.2,0.6-0.6,1.2-0.9,1.7l6.3,6.3L19.6,21z M9.5,14c1.2,0,2.3-0.4,3.2-1.3c0.9-0.9,1.3-1.9,1.3-3.2s-0.4-2.3-1.3-3.2
	C11.8,5.4,10.8,5,9.5,5S7.2,5.4,6.3,6.3C5.4,7.2,5,8.2,5,9.5s0.4,2.3,1.3,3.2C7.2,13.6,8.2,14,9.5,14z"
                    />
                </svg>

                <input
                    type="text"
                    class="w-full rounded-3xl pl-10 px-4 focus:outline-none focus:ring-0 border-none text-gray-600 bg-lightGray"
                    placeholder="Search"
                />
            </div>
            <button
                @click="(showSearchNav = false), (showUserDropDown = false)"
                class="h-full items-center justify-center w-10 hover:bg-utOrange flex sm:hidden sm:w-12"
            >
                <svg
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
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
    </nav>
    <nav
        v-else
        class="w-full h-16 bg-prussianBlue px-2 min-[390px]:px-8 flex items-center text-lightGray"
    >
        <router-link to="/">
            <img
                :src="'../storage/icons/logo.svg'"
                class="w-10 min-[450px]:w-12"
                alt=""
            />
        </router-link>
        <div
            class="ml-auto relative mr-4 hidden sm:flex sm:w-[375px] md:w-[450px] lg:w-[550px]"
        >
            <svg
                class="absolute top-2 left-3 h-6 w-6"
                version="1.1"
                id="Layer_1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                viewBox="0 0 24 24"
                xml:space="preserve"
                fill="gray"
            >
                <path
                    class="st0"
                    d="M19.6,21l-6.3-6.3c-0.5,0.4-1.1,0.7-1.7,0.9c-0.6,0.2-1.3,0.4-2.1,0.4c-1.8,0-3.4-0.6-4.6-1.9
C3.6,12.9,3,11.3,3,9.5s0.6-3.4,1.9-4.6C6.1,3.6,7.7,3,9.5,3s3.4,0.6,4.6,1.9C15.4,6.1,16,7.7,16,9.5c0,0.7-0.1,1.4-0.4,2.1
c-0.2,0.6-0.6,1.2-0.9,1.7l6.3,6.3L19.6,21z M9.5,14c1.2,0,2.3-0.4,3.2-1.3c0.9-0.9,1.3-1.9,1.3-3.2s-0.4-2.3-1.3-3.2
C11.8,5.4,10.8,5,9.5,5S7.2,5.4,6.3,6.3C5.4,7.2,5,8.2,5,9.5s0.4,2.3,1.3,3.2C7.2,13.6,8.2,14,9.5,14z"
                />
            </svg>

            <input
                type="text"
                class="w-full rounded-full pl-10 px-4 focus:outline-none focus:ring-0 border-none text-gray-600 bg-lightGray"
                placeholder="Search"
            />
        </div>
        <button
            @click="showSearchNav = true"
            class="h-full items-center justify-center w-10 hover:bg-utOrange flex sm:hidden sm:w-12 ml-auto"
        >
            <svg
                class="h-6 w-6"
                version="1.1"
                id="Layer_1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                viewBox="0 0 24 24"
                xml:space="preserve"
                fill="#EDEAE9"
            >
                <path
                    class="st0"
                    d="M19.6,21l-6.3-6.3c-0.5,0.4-1.1,0.7-1.7,0.9c-0.6,0.2-1.3,0.4-2.1,0.4c-1.8,0-3.4-0.6-4.6-1.9
C3.6,12.9,3,11.3,3,9.5s0.6-3.4,1.9-4.6C6.1,3.6,7.7,3,9.5,3s3.4,0.6,4.6,1.9C15.4,6.1,16,7.7,16,9.5c0,0.7-0.1,1.4-0.4,2.1
c-0.2,0.6-0.6,1.2-0.9,1.7l6.3,6.3L19.6,21z M9.5,14c1.2,0,2.3-0.4,3.2-1.3c0.9-0.9,1.3-1.9,1.3-3.2s-0.4-2.3-1.3-3.2
C11.8,5.4,10.8,5,9.5,5S7.2,5.4,6.3,6.3C5.4,7.2,5,8.2,5,9.5s0.4,2.3,1.3,3.2C7.2,13.6,8.2,14,9.5,14z"
                />
            </svg>
        </button>
        <div class="h-full flex items-center gap-2" v-if="loggedIn">
            <router-link
                to="/"
                class="h-full flex items-center justify-center w-10 hover:bg-utOrange sm:w-12"
            >
                <i class="fa-solid fa-bell text-xl"></i>
            </router-link>
            <div
                class="flex items-center gap-1 cursor-pointer h-full relative"
                @click="showUserDropDown = !showUserDropDown"
            >
                <img
                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt=""
                    class="h-9 w-9 rounded-full"
                />
                <i
                    class="fa-solid fa-angle-down mt-1 duration-150"
                    :class="showUserDropDown ? 'rotate-180' : ''"
                ></i>
            </div>
            <div
                v-show="showUserDropDown"
                class="absolute top-16 right-2 min-[390px]:right-8 w-52 bg-prussianBlue min-h-20 z-50"
            >
                <ul class="w-full h-full">
                    <li class="w-full">
                        <router-link
                            to="/"
                            class="flex items-center w-full py-3 px-4 gap-3 hover:bg-utOrange"
                            ><i class="fa-solid fa-user"></i> Settings
                        </router-link>
                    </li>
                    <li class="w-full">
                        <router-link
                            to="/"
                            class="flex items-center w-full py-3 px-4 Profile gap-3 hover:bg-utOrange"
                            ><i class="fa-solid fa-gear"></i> Settings
                        </router-link>
                    </li>
                    <li class="w-full">
                        <button
                            type="button"
                            class="flex items-center w-full py-3 px-4 Profile gap-3 border-t border-t-lightGray hover:bg-utOrange"
                        >
                            <i
                                class="fa-sharp fa-solid fa-right-from-bracket"
                            ></i>
                            Sign out
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <button
            v-else
            class="px-4 py-2 rounded-md bg-utOrange cursor-pointer hover:opacity-90"
            type="button"
        >
            Login / Sign up
        </button>
    </nav>
    <div class="p-4 sm:ml-64">
        <div class="px-2 py-4 sm:px-4 rounded-lg mt-14 dark:text-white">
            <div
                class="w-full md:w-[800px] m-auto rounded md:max-w-[95%] flex flex-col gap-10"
            >
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, onMounted, watch } from "vue";
import store from "../../store";
import AuthLayout from "../auth/AuthLayout.vue";

const screenWidth = ref(null);
const showUserDropDown = ref(false);
const showSearchNav = ref(false);
const showAuthModel = ref(false);
const user = ref(null);
window.addEventListener(
    "resize",
    () => (screenWidth.value = document.documentElement.clientWidth)
);
onMounted(() => {
    if (store.state.user.token ? true : false) {
        store.dispatch("InfoWithToken");
    }
});

const loggedIn = computed(() => {
    user.value = store.state.user.info;
    return store.state.user.token ? true : false;
});

function logout() {
    showAuthModel.value = false;
    showDropDownUser.value = false;
    store.dispatch("logout");
}
</script>

<style></style>
