<template>
    <div
        v-if="isLoggedIN"
        class="min-[400px]:h-14 h-12 w-full relative border-b border-gray-300 flex items-center justify-center font-medium text-lg sm:text-xl"
    >
        Create Post
        <button
            v-if="showHideButton"
            class="absolute cursor-pointer right-3 min-[400px]:top-3 p-1 hover:bg-prussianBlue hover:text-white rounded-md"
            @click="hideCreateModel"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5 min-[400px]:h-6 min-[400px]:w-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>
    </div>
    <form
        v-if="isLoggedIN"
        class="w-full flex flex-col justify-between px-4 p-4"
        @submit.prevent="createFun"
    >
        <!-- Start Error -->
        <div
            v-if="errorMsg"
            id="alert-2"
            class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50"
            role="alert"
        >
            <svg
                aria-hidden="true"
                class="flex-shrink-0 w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"
                ></path>
            </svg>
            <span class="sr-only">Alert</span>
            <div class="ml-3 text-sm font-medium">
                {{ errorMsg }}
            </div>
            <button
                type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8"
                data-dismiss-target="#alert-2"
                aria-label="Close"
                @click="errorMsg = ''"
            >
                <span class="sr-only">Close</span>
                <svg
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
            </button>
        </div>
        <!-- End Error -->
        <div class="w-full h-full flex items-center gap-3 mb-4">
            <img
                :src="'../storage/icons/page.jpg'"
                class="rounded-full w-12 min-[400px]:w-14"
                alt=""
            />
            <span class="flex flex-col">
                <span class="font-bold min-[400px]:text-lg text-base"
                    >Autako live</span
                >
                <span class="min-[400px]:text-sm text-xs text-gray-500"
                    >Now</span
                >
            </span>
        </div>
        <div class="max-h-96 overflow-y-auto formScroll">
            <textarea
                @focusout="showTextArea = false"
                v-model="text"
                @input="textFilterTag"
                id="textArea"
                :class="!showTextArea ? 'absolute -z-50 invisible' : ''"
                class="w-full p-0 overflow-hidden border-none focus:ring-0 outline-none resize-none min-h-[72px] placeholder:text-lg text-lg"
                placeholder="What's up, Med?"
            ></textarea>
            <div
                @click="displayTextArea"
                v-show="!showTextArea"
                class="whitespace-pre-wrap break-words w-full p-0 overflow-hidden cursor-text border-none focus:ring-0 outline-none resize-none min-h-[72px] placeholder:text-lg text-lg"
                placeholder="What's up, Med?"
                id="input"
            ></div>
            <div class="flex flex-col w-full">
                <div
                    v-show="showVideo"
                    @mouseover="showRemoveVideo = true"
                    @mouseleave="showRemoveVideo = false"
                    class="w-full flex items-center justify-center relative"
                >
                    <button
                        type="button"
                        v-if="showRemoveVideo && !disabled"
                        @click="removeVideo"
                        class="absolute right-2 top-2 p-1 rounded-full text-white bg-black bg-opacity-40 cursor-pointer z-10"
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
                    <video id="video-preview" class="w-full" controls />
                </div>
                <label
                    v-if="!showVideo"
                    for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100"
                >
                    <div
                        class="flex flex-col items-center justify-center pt-5 pb-6"
                    >
                        <svg
                            aria-hidden="true"
                            class="w-10 h-10 mb-3 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                            ></path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500">
                            MP4, WebM or Ogg (MAX. 100 Mo)
                        </p>
                    </div>
                    <input
                        id="dropzone-file"
                        type="file"
                        class="hidden"
                        @change="selectedFile"
                        accept="video/mp4,video/ogg,video/webm"
                        name="amvVideo"
                    />
                </label>
            </div>
        </div>
        <button class="w-full mt-8 bg-utOrange rounded-md text-white h-10">
            <span v-if="!disabled && !updatePost">Publish</span>
            <span v-else-if="!disabled && updatePost">Update</span>
            <span v-else>{{ percentage + "%" }}</span>
        </button>
    </form>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useRouter } from "vue-router";
import store from "../../store";
const props = defineProps(["toModifyPost"]);
const emit = defineEmits(["hideCreateModel"]);
const router = useRouter();
const updatePost = ref(props.toModifyPost ? true : false);
const showVideo = ref(updatePost.value ? true : false);
const showTextArea = ref(updatePost.value ? false : true);
const showRemoveVideo = ref(updatePost.value ? true : false);
const showHideButton = ref(true);
const text = ref(updatePost.value ? props.toModifyPost?.text : "");
const errorMsg = ref(null);
let myFile = updatePost.value ? 1 : false;
const disabled = ref(false);

onMounted(() => {
    if (props.toModifyPost?.video) {
        let videoTag = document.getElementById("video-preview");
        videoTag.src = "../storage/" + props.toModifyPost.video;
        textFilterTag();
    }
});

const isLoggedIN = computed(() => {
    return store.state.user.token ? true : false;
});
const percentage = computed(() => {
    return store.state.uploads.percentage;
});

function hideCreateModel() {
    emit("hideCreateModel");
}
function selectedFile(e) {
    myFile = e.target.files[0];
    if (!myFile) {
        return (errorMsg.value = "Choosing the appropriate file is crucial.");
    }

    if (
        myFile.type !== "video/mp4" &&
        myFile.type !== "video/ogg" &&
        myFile.type !== "video/webm"
    )
        return (errorMsg.value =
            "The file format is not recognized or supported by the system.");
    if (myFile.size > 104857600)
        return (errorMsg.value =
            "The maximum allowable file size is 100 megabytes.");
    showVideo.value = true; //show video section
    let videoTag = document.getElementById("video-preview");
    let reader = new FileReader();
    reader.readAsDataURL(myFile);
    reader.addEventListener("load", function () {
        videoTag.src = reader.result; //set video src
    });
}
function removeVideo() {
    let videoTag = document.getElementById("video-preview");
    showVideo.value = false;
    videoTag.src = "";
    myFile = null;
}

function textFilterTag() {
    let d = document.getElementById("textArea");
    d.style.height = "auto";
    d.style.height = `${d.scrollHeight}px`;
    let str = text.value;
    if (str) {
        str = str.replace(/(<.+?>)/gi, "");
        str = str.replace(/(?:\r\n|\n\r|\r|\n)/g, "<br /> ");
        str = str.replace(/(?:\s|^)#([^0-9\W\s][a-zA-z0-9]*)/g, (value) => {
            return `<span class='text-utOrange'>${value}</span>`;
        });
    }
    $("#input").html(str);
}
function displayTextArea() {
    if (!disabled.value) {
        showTextArea.value = true;
        setTimeout(() => {
            $("#textArea").focus();
        }, 100);
    }
}
function createFun() {
    if (myFile === 1 && text.value === props.toModifyPost?.text) {
        return emit("hideCreateModel");
    }
    if (!myFile) {
        return (errorMsg.value = "Choosing the appropriate file is crucial.");
    }
    var re = /(?:^|[ ])#([a-zA-Z0-9]+)/gm;
    var str = text.value;
    var m;
    var tags = [];
    while ((m = re.exec(str)) != null) {
        if (m.index === re.lastIndex) {
            re.lastIndex++;
        }
        tags.push(m[0].replace("#", ""));
    }
    const data = new FormData();
    data.append("post_id", updatePost.value ? props.toModifyPost.id : 0);
    data.append("text", text.value);
    data.append("file", myFile);
    tags.forEach((tag) => {
        data.append("tags[]", tag);
    });
    disabled.value = true;
    showHideButton.value = false;
    let to = updatePost.value ? "modifyAmv" : "postAmv";
    store.dispatch(to, data).then((res) => {
        disabled.value = false;
        showHideButton.value = true;
        if (Object.hasOwn(res, "response")) {
            for (const e in res.response.data.errors) {
                if (Object.hasOwnProperty.call(res.response.data.errors, e)) {
                    return (errorMsg.value = res.response.data.errors[e][0]);
                }
            }
        } else {
            emit("hideCreateModel");
            router.push("/p/" + res.data.post.id);
        }
    });
}
</script>

<style>
.formScroll::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

.formScroll::-webkit-scrollbar-track {
    border-radius: 100vh;
    background: #f7f4ed;
}

.formScroll::-webkit-scrollbar-thumb {
    background: rgba(128, 128, 128, 0.315);
    border-radius: 100vh;
    border: 3px solid #f6f7ed;
}

.formScroll::-webkit-scrollbar-thumb:hover {
    background: rgba(128, 128, 128, 0.644);
}
</style>
