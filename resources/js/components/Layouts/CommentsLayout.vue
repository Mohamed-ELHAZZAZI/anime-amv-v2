<template>
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
        <span class="text-base font-bold">{{
            comment.user.firstName + " " + comment.user.lastName
        }}</span>
        <span class="ml-2 text-xs text-gray-400">{{ comment.created_at }}</span>
        <p class="text-sm">
            {{ comment.body }}
        </p>

        <button
            @click="showReplies = !showReplies"
            class="my-5 uppercase tracking-wide text-gray-400 font-bold text-xs"
        >
            <span v-if="!showReplies"
                >({{ comment.replies.length }}) Replies</span
            >
            <span v-else>Hide replies</span>
        </button>

        <div class="space-y-4" v-if="showReplies">
            <div class="flex" v-for="reply in comment.replies" :key="reply.id">
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
                    <span class="text-base font-bold">{{
                        reply.user.firstName + " " + reply.user.lastName
                    }}</span>
                    <span class="ml-2 text-xs text-gray-400">{{
                        reply.created_at
                    }}</span>
                    <p class="text-xs sm:text-sm">
                        {{ reply.body }}
                    </p>
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
