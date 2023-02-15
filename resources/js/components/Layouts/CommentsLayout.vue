<template>
    <div
        class="flex w-full border gap-3 rounded-lg px-4 py-2 leading-relaxed pt-2"
    >
        <div class="flex-shrink-0">
            <img
                class="rounded-full w-10 h-10"
                src="https://images.unsplash.com/photo-1604426633861-11b2faead63c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                alt=""
            />
        </div>
        <div class="w-full">
            <div class="w-full h-10 flex items-center">
                <span class="text-base font-bold">
                    {{ comment.user.firstName + " " + comment.user.lastName }}
                </span>
                <span class="ml-2 text-xs text-gray-400">
                    {{ comment.created_at }}
                </span>
            </div>
            <p class="text-sm">
                {{ comment.body }}
            </p>

            <button
                @click="showReplies = !showReplies"
                class="my-4 uppercase tracking-wide text-gray-400 font-bold text-xs"
            >
                <span v-if="!showReplies"
                    >({{ comment.replies.length }}) Replies</span
                >
                <span v-else>Hide replies</span>
            </button>

            <div class="space-y-4" v-if="showReplies">
                <div
                    class="flex w-full"
                    v-for="reply in comment.replies"
                    :key="reply.id"
                >
                    <div
                        class="flex w-full bg-gray-100 rounded-lg px-4 py-3 gap-2 leading-relaxed"
                    >
                        <div class="">
                            <img
                                class="rounded-full w-8 h-8"
                                src="https://images.unsplash.com/photo-1604426633861-11b2faead63c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                                alt=""
                            />
                        </div>
                        <div>
                            <div class="h-8 flex items-center gap-2">
                                <span class="text-base font-bold">{{
                                    reply.user.firstName +
                                    " " +
                                    reply.user.lastName
                                }}</span>
                                <span class="ml-2 text-xs text-gray-400">{{
                                    reply.created_at
                                }}</span>
                            </div>
                            <p class="text-xs sm:text-sm">
                                {{ reply.body }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
const props = defineProps(["comment"]);

const showReplies = ref(false);
</script>

<style></style>
