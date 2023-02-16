<template>
    <div
        class="flex w-full border gap-2 sm:gap-3 rounded-lg px-2 sm:px-4 py-2 leading-relaxed pt-2 relative"
    >
        <div class="flex-shrink-0">
            <img
                class="rounded-full w-8 h-8 sm:w-10 sm:h-10"
                src="https://images.unsplash.com/photo-1604426633861-11b2faead63c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                alt=""
            />
        </div>
        <div class="w-full">
            <div
                class="w-full min-h-8 sm:min-h-10 flex items-center relative gap-1 pr-4"
            >
                <span
                    class="text-base font-bold"
                    style="overflow-wrap: anywhere"
                >
                    {{ comment.user.firstName + " " + comment.user.lastName }}
                    <span
                        v-if="comment.updated"
                        class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded bg-gray-300 text-black"
                        >M<span class="hidden sm:inline-block">odified</span> {{
                    }}</span>
                    <span
                        class="text-xs text-gray-400 hidden min-[430px]:inline"
                    >
                        {{ comment.created_at }}
                    </span>
                </span>

                <button
                    @click.stop="showBox = !showBox"
                    v-if="user.id === comment.user.id"
                    :disabled="deleteTriger"
                    class="absolute right-0 top-2"
                    @click="showCommentBox = !showCommentBox"
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
                    v-if="showCommentBox"
                    ref="commentBox"
                    class="w-36 bg-white absolute border-2 z-20 rounded border-gray-300 top-7 right-0"
                >
                    <ul class="w-full flex flex-col gap-[2px]">
                        <li class="w-full h-8 min-[420px]:h-10">
                            <button
                                @click="
                                    showModifyField = true;
                                    showCommentBox = false;
                                "
                                :disabled="deleteTriger"
                                :class="
                                    deleteTriger ? 'cursor-not-allowed' : ''
                                "
                                class="w-full h-full flex items-center px-3 gap-2 text-prussianBlue hover:bg-lightGray"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-4 h-4 min-[420px]:w-5 min-[420px]:h-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                    ></path>
                                </svg>
                                Modify
                            </button>
                        </li>
                        <li class="w-full h-8 min-[420px]:h-10">
                            <button
                                :disabled="deleteTriger"
                                @click="deleteComment"
                                :class="
                                    deleteTriger ? 'cursor-not-allowed' : ''
                                "
                                class="w-full h-full flex items-center px-3 gap-2 text-red-600 hover:bg-lightGray"
                            >
                                <svg
                                    v-if="!deleteTriger"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-4 h-4 min-[420px]:w-5 min-[420px]:h-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                    />
                                </svg>
                                <span v-if="!deleteTriger"> Delete</span>

                                <div
                                    v-else
                                    role="status"
                                    class="flex items-center justify-center w-full h-full"
                                >
                                    <svg
                                        aria-hidden="true"
                                        class="inline w-7 h-7 mr-2 animate-spin text-red-600 fill-gray-300"
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
                        </li>
                    </ul>
                </div>
            </div>
            <p
                class="text-sm"
                style="overflow-wrap: anywhere"
                v-if="!showModifyField"
            >
                {{ comment.body }}
            </p>
            <div class="w-full mt-2" v-else>
                <form class="w-full" @submit.prevent="ModiyComment">
                    <formError v-if="modifyError" :error="modifyError" />
                    <label
                        for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only"
                        >Comment</label
                    >
                    <div
                        class="relative flex flex-col items-center gap-1 sm:gap-4"
                    >
                        <textarea
                            ref="textArea"
                            :disabled="submitModifyComment"
                            @input="textAreaResizer"
                            v-model="newComment"
                            placeholder="Write your reply here..."
                            class="block resize-none w-full h-14 max-h-[100px] overflow-auto p-2 smp-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-utOrange focus:border-utOrange"
                        ></textarea>
                        <div
                            class="grid w-full gap-2 sm:gap-3 grid-cols-2"
                            :class="submitModifyComment ? 'grid-cols-1' : ''"
                        >
                            <button
                                :disabled="submitModifyComment"
                                :class="
                                    submitModifyComment
                                        ? 'cursor-not-allowed'
                                        : ''
                                "
                                type="submit"
                                class="sm:h-10 h-8 w-full bg-utOrange rounded border-none p-4 text-white flex items-center justify-center gap-2"
                            >
                                <span v-if="!submitModifyComment"> Save</span>
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
                            <button
                                v-if="!submitModifyComment"
                                @click="showModifyField = false"
                                type="button"
                                class="sm:h-10 h-8 w-full bg-white border-2 border-gray-300 rounded p-4 text-prussianBlue flex items-center justify-center gap-2"
                            >
                                cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>

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
                    <div
                        class="relative flex items-center min-[400px]:gap-4 gap-1"
                    >
                        <textarea
                            ref="textArea"
                            :disabled="submiteReply"
                            @input="textAreaResizer"
                            v-model="replyText"
                            placeholder="Write your reply here..."
                            class="block resize-none w-full h-14 max-h-[100px] overflow-auto p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-utOrange focus:border-utOrange"
                        ></textarea>
                        <button
                            :disabled="submiteReply"
                            :class="submiteReply ? 'cursor-not-allowed' : ''"
                            type="submit"
                            class="h-10 bg-utOrange rounded border-none p-4 text-white flex items-center justify-center gap-2"
                        >
                            <svg
                                v-if="!submiteReply"
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

                            <span
                                v-if="!submiteReply"
                                class="hidden min-[400px]:inline"
                                >Reply</span
                            >
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
                <div
                    class="flex w-full"
                    v-for="reply in comment.replies"
                    :key="reply.id"
                >
                    <PostRepliesLayout
                        :reply="reply"
                        :user="user"
                        @deleteReply="deleteReply"
                    />
                </div>
            </div>
        </div>
        <div
            class="absolute rounded-lg top-0 bottom-0 right-0 left-0 bg-black bg-opacity-20"
            v-if="deleteTriger"
        ></div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import store from "../../store";
import formError from "../auth/formError.vue";
import PostRepliesLayout from "./PostRepliesLayout.vue";
const commentBox = ref(null);
const props = defineProps(["comment", "user"]);
const emit = defineEmits(["deleteComment"]);
const replyError = ref("");
const showReplies = ref(false);
const replyText = ref("");
const textArea = ref();
const deleteTriger = ref(false);
const showCommentBox = ref(false);
const showModifyField = ref(false);
const modifyError = ref("");
const newComment = ref(props.comment.body);
const submiteReply = ref(false);
const submitModifyComment = ref(false);
function submitReply() {
    if (!replyText.value) {
        return (replyError.value = "The text field is required.");
    }
    let data = new FormData();
    data.append("text", replyText.value);
    data.append("post_id", props.comment.amv_id);
    data.append("parent_id", props.comment.id);
    replyError.value = "";
    submiteReply.value = true;
    store.dispatch("submitComment", data).then((res) => {
        replyText.value = "";
        submiteReply.value = false;
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

function deleteComment() {
    deleteTriger.value = true;
    store.dispatch("deleteComment", props.comment.id).then((res) => {
        deleteTriger.value = false;
        if (res.error) {
            alert("Error try agin later");
        } else {
            emit("deleteComment", res.comment);
        }
    });
}

function deleteReply(reply) {
    props.comment.replies = props.comment.replies.filter(
        (rpl) => rpl.id != reply.id
    );
}

function ModiyComment() {
    if (!newComment.value) {
        return (modifyError.value = "The text field is required.");
    } else if (newComment.value === props.comment.body) {
        return (showModifyField.value = false);
    }
    let data = new FormData();
    data.append("comment_id", props.comment.id);
    data.append("text", newComment.value);
    modifyError.value = "";
    submitModifyComment.value = true;
    store.dispatch("updateComment", data).then((res) => {
        submitModifyComment.value = false;

        if (res.data.error) {
            if (res.data.msg) {
                modifyError.value = res.data.msg.text[0];
            } else {
                modifyError.value = res.data.text;
            }
        } else {
            props.comment.body = res.data.comment.body;
            props.comment.updated = 1;
            showModifyField.value = false;
        }
    });
}

const onClickOutside = (event) => {
    if (
        commentBox.value &&
        !commentBox.value.contains(event.target) &&
        event.target !== commentBox.value.previousSibling
    ) {
        showCommentBox.value = false;
    }
};

onMounted(() => {
    window.addEventListener("click", onClickOutside);
});

onBeforeUnmount(() => {
    window.removeEventListener("click", onClickOutside);
});
</script>

<style></style>
