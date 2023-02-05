<template>
    <div
        class="px-5 py-4 bg-[var(--primary-light-color)] dark:bg-[var(--primary-dark-color)] shadow rounded-lg relative"
    >
        <div class="flex mb-4 relative">
            <img
                class="w-12 h-12 rounded-full"
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            />
            <div class="ml-2 mt-0.5">
                <span
                    class="block font-medium text-base leading-snug text-black dark:text-gray-100"
                    >{{ post.user.firstName + " " + post.user.lastName }}</span
                >
                <span
                    class="block text-sm text-gray-400 font-light leading-snug"
                    >{{ post.created_at }}
                </span>
            </div>
            <button
                v-if="user_id === post.user.id"
                @click="showMenu = !showMenu"
                class="ml-auto h-6 w-6 rounded-full hover:bg-gray-700 flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                    />
                </svg>
            </button>
            <div
                v-if="showMenu && user_id === post.user.id"
                class="absolute z-20 right-0 top-7 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
            >
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                    <li>
                        <router-link
                            :to="{ name: 'ModifyAmv', params: { id: post.id } }"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >Modify post</router-link
                        >
                    </li>
                    <li>
                        <button
                            @click="showDeleteModel"
                            class="text-red-600 w-full flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600"
                        >
                            Delete post
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <p
            class="text-gray-800 dark:text-gray-100 leading-snug md:leading-normal"
        >
            {{ post.text }}
        </p>

        <div class="w-full mt-2">
            <video
                class="mx-auto relative ElementMedia w-full"
                controls
                muted
                loop
                id="video"
            >
                <source :src="'storage/' + post.video" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="py-2">
            <router-link
                to="/"
                v-for="tag in post.tags"
                :key="tag"
                class="inline-flex items-center px-4 py-2 mt-4 mr-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-[var(--secondary-dark-color)] dark:text-white"
            >
                {{ tag }}
            </router-link>
        </div>
        <div class="flex justify-between items-center mt-5">
            <div class="flex">
                <svg
                    class="p-0.5 h-6 w-6 rounded-full z-20 bg-[var(--primary-light-color)] dark:bg-[var(--primary-dark-color)]"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 16 16"
                >
                    <defs>
                        <linearGradient
                            id="a1"
                            x1="50%"
                            x2="50%"
                            y1="0%"
                            y2="100%"
                        >
                            <stop offset="0%" stop-color="#18AFFF" />
                            <stop offset="100%" stop-color="#0062DF" />
                        </linearGradient>
                        <filter
                            id="c1"
                            width="118.8%"
                            height="118.8%"
                            x="-9.4%"
                            y="-9.4%"
                            filterUnits="objectBoundingBox"
                        >
                            <feGaussianBlur
                                in="SourceAlpha"
                                result="shadowBlurInner1"
                                stdDeviation="1"
                            />
                            <feOffset
                                dy="-1"
                                in="shadowBlurInner1"
                                result="shadowOffsetInner1"
                            />
                            <feComposite
                                in="shadowOffsetInner1"
                                in2="SourceAlpha"
                                k2="-1"
                                k3="1"
                                operator="arithmetic"
                                result="shadowInnerInner1"
                            />
                            <feColorMatrix
                                in="shadowInnerInner1"
                                values="0 0 0 0 0 0 0 0 0 0.299356041 0 0 0 0 0.681187726 0 0 0 0.3495684 0"
                            />
                        </filter>
                        <path
                            id="b1"
                            d="M8 0a8 8 0 00-8 8 8 8 0 1016 0 8 8 0 00-8-8z"
                        />
                    </defs>
                    <g fill="none">
                        <use fill="url(#a1)" xlink:href="#b1" />
                        <use fill="black" filter="url(#c1)" xlink:href="#b1" />
                        <path
                            fill="white"
                            d="M12.162 7.338c.176.123.338.245.338.674 0 .43-.229.604-.474.725a.73.73 0 01.089.546c-.077.344-.392.611-.672.69.121.194.159.385.015.62-.185.295-.346.407-1.058.407H7.5c-.988 0-1.5-.546-1.5-1V7.665c0-1.23 1.467-2.275 1.467-3.13L7.361 3.47c-.005-.065.008-.224.058-.27.08-.079.301-.2.635-.2.218 0 .363.041.534.123.581.277.732.978.732 1.542 0 .271-.414 1.083-.47 1.364 0 0 .867-.192 1.879-.199 1.061-.006 1.749.19 1.749.842 0 .261-.219.523-.316.666zM3.6 7h.8a.6.6 0 01.6.6v3.8a.6.6 0 01-.6.6h-.8a.6.6 0 01-.6-.6V7.6a.6.6 0 01.6-.6z"
                        />
                    </g>
                </svg>
                <span
                    class="ml-1 text-gray-500 dark:text-[var(--tertiary-dark-color)] font-light"
                    >{{ post.likes }}</span
                >
            </div>
            <div
                class="ml-1 text-gray-500 dark:text-[var(--tertiary-dark-color)] font-light"
            >
                {{ post.comments }} comments
            </div>
        </div>
    </div>
    <ConfirmationModalLayout
        ref="DeleteModel"
        @deletePosts="deletePosts"
        message="Are you sure you want to delete this product?"
    />
</template>

<script setup>
import { computed, ref } from "vue";
import store from "../../store";
import ConfirmationModalLayout from "../Layouts/ConfirmationModalLayout.vue";

const emit = defineEmits(["deletePost"]);

const user_id = computed(() => {
    return store.state.user.info?.id;
});
const props = defineProps(["post"]);
const showMenu = ref(false);
const postDelete = ref(true);

const DeleteModel = ref(null);

function showDeleteModel() {
    showMenu.value = false;
    DeleteModel.value.showDeleteModel();
}
function deletePosts() {
    DeleteModel.value.HideDeleteModel();
    emit("deletePost", props.post);
}
</script>

<style></style>
