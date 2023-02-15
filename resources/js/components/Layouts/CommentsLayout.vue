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
                <form class="w-full" @submit.prevent="submitReply">
                    <formError v-if="replyError" :error="replyError" />
                    <label
                        for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only"
                        >Comment</label
                    >
                    <div class="relative flex items-center gap-4">
                        <textarea
                            ref="textArea"
                            @input="textAreaResizer"
                            v-model="replyText"
                            placeholder="Write your reply here..."
                            class="block resize-none w-full h-14 max-h-[100px] overflow-auto p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-utOrange focus:border-utOrange"
                        ></textarea>
                        <button
                            type="submit"
                            class="h-10 bg-utOrange rounded border-none p-4 text-white flex items-center justify-center gap-2"
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
                                    d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"
                                />
                            </svg>

                            Reply
                        </button>
                    </div>
                </form>
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
import store from "../../store";
import formError from "../auth/formError.vue";
const props = defineProps(["comment"]);
const replyError = ref("");
const showReplies = ref(false);
const replyText = ref("");
const textArea = ref();
function submitReply() {
    if (!replyText.value) {
        return (replyError.value = "The text field is required.");
    }
    let data = new FormData();
    data.append("text", replyText.value);
    data.append("post_id", props.comment.amv_id);
    data.append("parent_id", props.comment.id);
    replyError.value = "";
    store.dispatch("submitComment", data).then((res) => {
        replyText.value = "";
        if (res.data.error) {
            replyError.value = res.data.data.text[0];
        } else {
            props.comment.replies.unshift(res.data.comment);
            res.data.comment.user = res.data.user;
        }
    });
}

function textAreaResizer(e) {
    let d = textArea.value;
    d.style.height = "auto";
    d.style.height = `${d.scrollHeight}px`;
}
</script>

<style></style>
