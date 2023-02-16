<template>
    <div
        class="w-full border border-gray-300 rounded-md bg-white py-2 sm:px-5 px-2 pb-2 flex flex-col gap-2 relative overflow-hidden"
    >
        <div class="w-full min-h-16">
            <div
                class="w-full h-full flex items-center gap-2 min-[400px]:gap-5 relative"
            >
                <img
                    :src="'../storage/icons/page.jpg'"
                    class="rounded-full w-12 min-[400px]:w-14"
                    alt=""
                />
                <span class="flex flex-col">
                    <div class="flex items-center">
                        <span
                            class="font-semibold min-[400px]:text-lg min-[400px]:w-auto w-32 text-base whitespace-nowrap overflow-hidden text-ellipsis inline-block"
                        >
                            {{ post.user.firstName + " " + post.user.lastName }}
                        </span>
                        <span
                            v-if="post.updated === '1'"
                            class="ml-2 text-xs font-medium mr-2 px-2.5 py-0.5 rounded bg-gray-300 text-black"
                            ><span>M</span
                            ><span class="hidden min-[400px]:inline"
                                >odified</span
                            ></span
                        >
                    </div>
                    <span class="min-[400px]:text-sm text-xs text-gray-500">{{
                        post.created_at
                    }}</span>
                </span>
                <router-link
                    to="/"
                    class="ml-auto mr-2 min-[400px]:text-lg text-sm"
                >
                    <i
                        class="fa-solid fa-arrow-up-right-from-square text-gray-600"
                    ></i>
                </router-link>
                <button
                    v-if="user.id === post.user_id"
                    @click.stop="postBox = !postBox"
                    class="text-lg text-gray-600 hover:text-utOrange mr-1 min-[400px]:mr-0"
                    @click="showPostBox = !showPostBox"
                >
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div
                    v-if="showPostBox && user?.id === post.user_id"
                    ref="postBox"
                    class="absolute right-0 top-12 w-40 py-1 z-20 bg-white rounded border-gray-300 border"
                >
                    <ul class="w-full flex flex-col gap-[2px]">
                        <li
                            class="w-full min-[400px]:h-12 h-10 text-sm min-[400px]:text-base"
                        >
                            <button
                                @click="showModifyModel"
                                class="w-full h-full flex items-center px-3 gap-2 text-prussianBlue hover:bg-lightGray"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="min-[400px]:w-5 min-[400px]:h-5 h-4 w-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                    />
                                </svg>

                                Modify post
                            </button>
                        </li>
                        <li
                            class="w-full min-[400px]:h-12 h-10 text-sm min-[400px]:text-base"
                        >
                            <button
                                @click="showDeleteModel"
                                class="w-full h-full flex items-center px-3 gap-2 text-red-600 hover:bg-lightGray"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="min-[400px]:w-5 min-[400px]:h-5 h-4 w-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                    />
                                </svg>
                                Delete post
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-full flex">
            <p v-html="text"></p>
        </div>
        <video :src="'../storage/' + post.video" controls></video>
        <div
            class="w-full h-12 flex justify-between border-t border-gray-300 mt-3 relative"
        >
            <button
                @click="showComment"
                class="flex items-center gap-1 hover:bg-lightGray mt-2 px-2 hover:fill-red-600 rounded"
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
                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z"
                    />
                </svg>
                {{ post.comments }}
            </button>
            <button
                @click="reactToPost('like')"
                :class="post.user_reaction == 'like' ? 'fill-red-600 ' : ''"
                class="flex items-center gap-1 hover:bg-lightGray mt-2 px-2 hover:fill-red-600 rounded"
            >
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="m12 21-1.45-1.3q-2.525-2.275-4.175-3.925T3.75 12.812Q2.775 11.5 2.388 10.4 2 9.3 2 8.15 2 5.8 3.575 4.225 5.15 2.65 7.5 2.65q1.3 0 2.475.55T12 4.75q.85-1 2.025-1.55 1.175-.55 2.475-.55 2.35 0 3.925 1.575Q22 5.8 22 8.15q0 1.15-.387 2.25-.388 1.1-1.363 2.412-.975 1.313-2.625 2.963-1.65 1.65-4.175 3.925Zm0-2.7q2.4-2.15 3.95-3.688 1.55-1.537 2.45-2.674.9-1.138 1.25-2.026.35-.887.35-1.762 0-1.5-1-2.5t-2.5-1q-1.175 0-2.175.662-1 .663-1.375 1.688h-1.9q-.375-1.025-1.375-1.688-1-.662-2.175-.662-1.5 0-2.5 1t-1 2.5q0 .875.35 1.762.35.888 1.25 2.026.9 1.137 2.45 2.674Q9.6 16.15 12 18.3Zm0-6.825Z"
                    />
                </svg>
                {{ post.likes }}
            </button>
            <button
                @click="reactToPost('dislike')"
                :class="post.user_reaction == 'dislike' ? 'fill-red-600 ' : ''"
                class="flex items-center gap-1 hover:bg-lightGray mt-2 px-2 hover:fill-red-600 rounded"
            >
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="M12.025 21.925q-3.35-3.375-5.337-5.45Q4.7 14.4 3.663 13.025q-1.038-1.375-1.351-2.35Q2 9.7 2 8.5q0-2.3 1.6-3.9T7.5 3q1.125 0 2.175.412 1.05.413 1.875 1.188L10 10h3l-.85 8.375L15 9h-3l1.775-5.3q.625-.35 1.313-.525Q15.775 3 16.5 3q2.3 0 3.9 1.6T22 8.5q0 1.2-.325 2.2-.325 1-1.375 2.387-1.05 1.388-3.025 3.451-1.975 2.062-5.25 5.387Zm-1.775-4.65L10.775 12H7.35l1.875-6.575q-.4-.2-.837-.313Q7.95 5 7.5 5 6.05 5 5.025 6.025 4 7.05 4 8.5q0 .775.287 1.55.288.775 1 1.762.713.988 1.926 2.3 1.212 1.313 3.037 3.163Zm4.7-1.2q2.775-2.825 3.913-4.5Q20 9.9 20 8.5q0-1.45-1.025-2.475Q17.95 5 16.5 5q-.275 0-.55.037-.275.038-.55.138L14.8 7h2.9ZM17.7 7ZM7.35 12Z"
                    />
                </svg>
                {{ post.dislikes }}
            </button>
            <button
                @click="showShareBox = !showShareBox"
                @click.stop="shareBox = !shareBox"
                class="flex items-center gap-1 hover:bg-lightGray mt-2 px-2 rounded pr-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="M18 22q-1.25 0-2.125-.875T15 19q0-.175.025-.363.025-.187.075-.337l-7.05-4.1q-.425.375-.95.587Q6.575 15 6 15q-1.25 0-2.125-.875T3 12q0-1.25.875-2.125T6 9q.575 0 1.1.212.525.213.95.588l7.05-4.1q-.05-.15-.075-.337Q15 5.175 15 5q0-1.25.875-2.125T18 2q1.25 0 2.125.875T21 5q0 1.25-.875 2.125T18 8q-.575 0-1.1-.213-.525-.212-.95-.587L8.9 11.3q.05.15.075.337Q9 11.825 9 12t-.025.362q-.025.188-.075.338l7.05 4.1q.425-.375.95-.588Q17.425 16 18 16q1.25 0 2.125.875T21 19q0 1.25-.875 2.125T18 22Zm0-16q.425 0 .712-.287Q19 5.425 19 5t-.288-.713Q18.425 4 18 4t-.712.287Q17 4.575 17 5t.288.713Q17.575 6 18 6ZM6 13q.425 0 .713-.288Q7 12.425 7 12t-.287-.713Q6.425 11 6 11t-.713.287Q5 11.575 5 12t.287.712Q5.575 13 6 13Zm12 7q.425 0 .712-.288Q19 19.425 19 19t-.288-.712Q18.425 18 18 18t-.712.288Q17 18.575 17 19t.288.712Q17.575 20 18 20Zm0-15ZM6 12Zm12 7Z"
                    />
                </svg>
            </button>
            <div
                v-show="showShareBox"
                ref="shareBox"
                class="z-40 absolute right-0 -top-[155px] w-40 py-1 bg-white rounded border-gray-300 border"
            >
                <ul class="w-full flex flex-col gap-[2px]">
                    <li class="w-full h-12">
                        <button
                            class="w-full h-full flex items-center px-3 gap-2 text-prussianBlue hover:bg-lightGray"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 48 48"
                                width="35px"
                                height="35px"
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                            >
                                <path
                                    fill="#fff"
                                    d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"
                                />
                                <path
                                    fill="#fff"
                                    d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"
                                />
                                <path
                                    fill="#cfd8dc"
                                    d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"
                                />
                                <path
                                    fill="#40c351"
                                    d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"
                                />
                                <path
                                    fill="#fff"
                                    fill-rule="evenodd"
                                    d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z"
                                    clip-rule="evenodd"
                                />
                            </svg>

                            Whatssapp
                        </button>
                    </li>
                    <li class="w-full h-12">
                        <button
                            class="w-full h-full flex items-center px-3 gap-2 text-prussianBlue hover:bg-lightGray"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 48 48"
                                width="30px"
                                height="30px"
                            >
                                <path
                                    fill="#039be5"
                                    d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"
                                />
                                <path
                                    fill="#fff"
                                    d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z"
                                />
                            </svg>
                            Facebook
                        </button>
                    </li>
                    <li class="w-full h-12">
                        <button
                            @click="copyShareLink"
                            class="w-full h-full flex items-center px-3 gap-2 text-prussianBlue hover:bg-lightGray"
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
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
                                />
                            </svg>

                            <span v-if="!showCopied">Copy link</span>
                            <span v-else>Copied!</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <ConfirmationModalLayout
            ref="deleteModel"
            message="Are you sure you want to delete this post?"
            @delete="deletePost"
        />
    </div>
</template>

<script setup>
import { computed, onMounted, ref, onBeforeUnmount } from "vue";
import { useRoute } from "vue-router";
import store from "../../store";
import ConfirmationModalLayout from "./ConfirmationModalLayout.vue";
const props = defineProps(["post"]);
const showPostBox = ref(false);
const text = ref(null);
const showShareBox = ref(false);
const deleteModel = ref();
const emit = defineEmits(["deletePost", "modifyPost", "showComment"]);
const showCopied = ref(false);
const shareLink = ref(window.location.href + "/p/" + props.post.id);
const user = computed(() => {
    return store.state.user.info;
});
onMounted(() => {
    let str = props.post.text;
    if (str) {
        str = str.replace(/(?:\s|^)#([^0-9\W\s][a-zA-z0-9]*)/g, (value) => {
            return `<a href='/tags/${value}' class='text-utOrange cursor-pointer hover:underline' "> ${value}</a>`;
        });
    }
    text.value = str;
});

function showDeleteModel() {
    showPostBox.value = false;
    deleteModel.value.showDeleteModel();
}

function deletePost() {
    emit("deletePost", props.post);
}

function showModifyModel() {
    showPostBox.value = false;
    emit("modifyPost", props.post);
}

function copyShareLink() {
    navigator.clipboard.writeText(shareLink.value);
    showCopied.value = true;
    showShareBox.value = false;
    setInterval(() => {
        showCopied.value = false;
    }, 2000);
}

function reactToPost(type) {
    let action;
    if (props.post.user_reaction == type) {
        action = "remove";
        props.post[props.post.user_reaction + "s"]--;
        props.post.user_reaction = null;
    } else if (props.post.user_reaction != type) {
        if (props.post.user_reaction != null) {
            action = "change";
            props.post[props.post.user_reaction + "s"]--;
        } else {
            action = "add";
        }
        props.post[type + "s"]++;
        props.post.user_reaction = type;
    }
    let info = new FormData();
    info.append("type", type);
    info.append("action", action);
    info.append("post_id", props.post.id);

    store.dispatch("reactToAmv", info);
}
function showComment() {
    emit("showComment", props.post.id);
}

const postBox = ref(null);
const shareBox = ref(null);
const onClickOutside = (event) => {
    if (
        postBox.value &&
        !postBox.value.contains(event.target) &&
        event.target !== postBox.value.previousSibling
    ) {
        showPostBox.value = false;
    }
    if (
        shareBox.value &&
        !shareBox.value.contains(event.target) &&
        event.target !== shareBox.value.previousSibling
    ) {
        showShareBox.value = false;
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
