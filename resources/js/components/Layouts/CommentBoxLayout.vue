<template>
    <div
        class="fixed bottom-0 top-0 left-0 right-0 bg-black bg-opacity-40 z-30 flex justify-center items-center"
        @click.self="closeCommentSection"
    >
        <div
            class="w-full rounded md:max-w-[750px] min-h-[550px] bg-white grid grid-rows-[64px_450px_auto] z-40"
        >
            <div
                class="w-full flex items-center justify-center border-b-2 border-b-gray-300 font-semibold text-lg relative"
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
            <div class="w-full overflow-auto px-12 flex flex-col gap-2 py-2">
                <CommentSkeleton v-if="showCommentSkeleton" />
                <div
                    class="flex"
                    v-else-if="comments.length"
                    v-for="comment in comments"
                    :key="comment.id"
                >
                    <CommentsReplies
                        @deleteComment="deleteComment"
                        :comment="comment"
                        :user="user"
                    />
                </div>
                <div v-else class="text-center">
                    <span>This post has no comments yet! </span>
                </div>
            </div>
            <div class="w-full flex items-center justify-center py-2 px-4">
                <form class="w-full" @submit.prevent="submitComment">
                    <label
                        for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only"
                        >Comment</label
                    >
                    <formError v-if="commentError" :error="commentError" />
                    <div class="relative flex items-center gap-4">
                        <textarea
                            @input="textAreaResizer"
                            v-model="commentText"
                            id="textArea"
                            placeholder="Write your comment here..."
                            class="block resize-none w-full h-16 max-h-[100px] overflow-auto p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-utOrange focus:border-utOrange"
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
                                class="w-5 h-5 -rotate-45"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"
                                />
                            </svg>

                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { computed, onMounted } from "@vue/runtime-core";
import store from "../../store";
import CommentSkeleton from "../skeletons/CommentSkeleton.vue";
import CommentsReplies from "../Layouts/CommentsLayout.vue";
import formError from "../auth/formError.vue";
const emit = defineEmits(["hideComment"]);
const props = defineProps(["post_id"]);
const showCommentSkeleton = ref(false);
const comments = ref([]);
const commentText = ref("");
const commentError = ref("");
onMounted(() => {
    showCommentSkeleton.value = true;
    store.dispatch("getComments", props.post_id).then((res) => {
        showCommentSkeleton.value = false;
        comments.value = res.data.comments;
    });
});

const user = computed(() => {
    return store.state.user.info;
});

function closeCommentSection() {
    emit("hideComment");
}

function textAreaResizer() {
    let d = document.getElementById("textArea");
    d.style.height = "auto";
    d.style.height = `${d.scrollHeight}px`;
}

function submitComment() {
    if (!commentText.value) {
        return (commentError.value = "The text field is required.");
    }
    let data = new FormData();
    data.append("text", commentText.value);
    data.append("post_id", props.post_id);
    commentError.value = "";
    store.dispatch("submitComment", data).then((res) => {
        commentText.value = "";
        if (res.data.error) {
            commentError.value = res.data.data.text[0];
        } else {
            res.data.comment.user = res.data.user;
            res.data.comment.replies = [];
            comments.value.unshift(res.data.comment);
        }
    });
}

function deleteComment(comment) {
    comments.value = comments.value.filter((cmt) => cmt.id != comment.id);
}
</script>

<style></style>
