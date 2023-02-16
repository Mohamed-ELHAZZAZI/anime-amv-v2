<template>
    <div
        class="fixed bottom-0 top-0 left-0 overflow-auto right-0 bg-black bg-opacity-40 z-30 flex justify-center items-center"
        @click.self="closeCommentSection"
    >
        <div
            class="w-full rounded md:max-w-[750px] mt-24 mb-10 mx-3 md:m-0 min-h-[550px] bg-white grid grid-rows-[50px_400px_auto] mg:grid-rows-[64px_450px_auto] z-40"
        >
            <div
                class="w-full flex items-center justify-center border-b-2 border-b-gray-300 font-semibold sm:text-lg relative"
            >
                Comments
                <button
                    type="button"
                    class="absolute sm:top-2 md:top-3 right-2.5 text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-800 hover:text-white"
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
            <div
                class="w-full overflow-auto px-2 min-[400px]:px-4 sm:px-12 flex flex-col gap-2 py-2"
            >
                <CommentSkeleton v-if="showCommentSkeleton" />
                <div
                    class="flex"
                    v-else-if="comments.length"
                    v-for="comment in comments"
                    :key="comment.id"
                >
                    <PostCommentsLayout
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
                    <div
                        class="relative flex items-center gap-2 min-[400px]:gap-4"
                    >
                        <textarea
                            :disabled="submited"
                            @input="textAreaResizer"
                            v-model="commentText"
                            id="textArea"
                            placeholder="Write your comment here..."
                            class="block resize-none w-full h-16 max-h-[100px] overflow-auto p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-utOrange focus:border-utOrange"
                        ></textarea>
                        <button
                            :disabled="submited"
                            :class="submited ? 'cursor-not-allowed' : ''"
                            type="submit"
                            class="h-10 bg-utOrange rounded border-none p-4 text-white flex items-center justify-center gap-2"
                        >
                            <svg
                                v-if="!submited"
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

                            <span v-if="!submited"> Send</span>
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
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { computed, onMounted } from "@vue/runtime-core";
import store from "../../store";
import CommentSkeleton from "../skeletons/CommentSkeleton.vue";
import PostCommentsLayout from "./PostCommentsLayout.vue";
import formError from "../auth/formError.vue";
const emit = defineEmits(["hideComment"]);
const props = defineProps(["post_id"]);
const showCommentSkeleton = ref(false);
const comments = ref([]);
const commentText = ref("");
const commentError = ref("");
const submited = ref(false);
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
    submited.value = true;
    store.dispatch("submitComment", data).then((res) => {
        commentText.value = "";
        submited.value = false;
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
