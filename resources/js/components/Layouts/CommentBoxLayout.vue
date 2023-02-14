<template>
    <div
        class="fixed bottom-0 top-0 left-0 right-0 bg-black bg-opacity-40 z-30 flex justify-center items-center"
        @click.self="closeCommentSection"
    >
        <div
            class="w-full rounded md:max-w-[750px] min-h-[550px] bg-white flex flex-col z-40"
        >
            <div
                class="w-full h-16 flex items-center justify-center border-b-2 border-b-gray-300 font-semibold text-lg relative"
            >
                Comments
                <button
                    type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-800 hover:text-white"
                    @click="closeCommentSection"
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
            </div>
            <!-- <div class="w-full h-[450px] overflow-auto flex py-2">
                <div class="antialiased mx-auto max-w-screen-sm">
                    <div class="space-y-4">
                        <div class="flex">
                            <div class="flex-shrink-0 mr-3">
                                <img
                                    class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10"
                                    src="https://images.unsplash.com/photo-1604426633861-11b2faead63c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                                    alt=""
                                />
                            </div>
                            <div
                                class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed"
                            >
                                <strong>Sarah</strong>
                                <span class="text-xs text-gray-400"
                                    >3:34 PM</span
                                >
                                <p class="text-sm">
                                    Lorem ipsum dolor sit amet, consetetur
                                    sadipscing elitr, sed diam nonumy eirmod
                                    tempor invidunt ut labore et dolore magna
                                    aliquyam erat, sed diam voluptua.
                                </p>
                                <div class="mt-4 flex items-center">
                                    <div class="flex -space-x-2 mr-2">
                                        <img
                                            class="rounded-full w-6 h-6 border border-white"
                                            src="https://images.unsplash.com/photo-1554151228-14d9def656e4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80"
                                            alt=""
                                        />
                                        <img
                                            class="rounded-full w-6 h-6 border border-white"
                                            src="https://images.unsplash.com/photo-1513956589380-bad6acb9b9d4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80"
                                            alt=""
                                        />
                                    </div>
                                    <div
                                        class="text-sm text-gray-500 font-semibold"
                                    >
                                        5 Replies
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0 mr-3">
                                <img
                                    class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10"
                                    src="https://images.unsplash.com/photo-1604426633861-11b2faead63c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                                    alt=""
                                />
                            </div>
                            <div
                                class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed"
                            >
                                <strong>Sarah</strong>
                                <span class="text-xs text-gray-400"
                                    >3:34 PM</span
                                >
                                <p class="text-sm">
                                    Lorem ipsum dolor sit amet, consetetur
                                    sadipscing elitr, sed diam nonumy eirmod
                                    tempor invidunt ut labore et dolore magna
                                    aliquyam erat, sed diam voluptua.
                                </p>

                                <h4
                                    class="my-5 uppercase tracking-wide text-gray-400 font-bold text-xs"
                                >
                                    Replies
                                </h4>

                                <div class="space-y-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0 mr-3">
                                            <img
                                                class="mt-3 rounded-full w-6 h-6 sm:w-8 sm:h-8"
                                                src="https://images.unsplash.com/photo-1604426633861-11b2faead63c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                                                alt=""
                                            />
                                        </div>
                                        <div
                                            class="flex-1 bg-gray-100 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed"
                                        >
                                            <strong>Sarah</strong>
                                            <span class="text-xs text-gray-400"
                                                >3:34 PM</span
                                            >
                                            <p class="text-xs sm:text-sm">
                                                Lorem ipsum dolor sit amet,
                                                consetetur sadipscing elitr, sed
                                                diam nonumy eirmod tempor
                                                invidunt ut labore et dolore
                                                magna aliquyam erat, sed diam
                                                voluptua.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex-shrink-0 mr-3">
                                            <img
                                                class="mt-3 rounded-full w-6 h-6 sm:w-8 sm:h-8"
                                                src="https://images.unsplash.com/photo-1604426633861-11b2faead63c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                                                alt=""
                                            />
                                        </div>
                                        <div
                                            class="flex-1 bg-gray-100 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed"
                                        >
                                            <strong>Sarah</strong>
                                            <span class="text-xs text-gray-400"
                                                >3:34 PM</span
                                            >
                                            <p class="text-xs sm:text-sm">
                                                Lorem ipsum dolor sit amet,
                                                consetetur sadipscing elitr, sed
                                                diam nonumy eirmod tempor
                                                invidunt ut labore et dolore
                                                magna aliquyam erat, sed diam
                                                voluptua.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <CommentSkeleton v-if="showCommentSkeleton" :class="'mb-3'" />
        </div>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import CommentSkeleton from "../skeletons/CommentSkeleton.vue";
const emit = defineEmits(["hideComment"]);
const showCommentSkeleton = ref(true);
function closeCommentSection() {
    emit("hideComment");
}
</script>

<style></style>
