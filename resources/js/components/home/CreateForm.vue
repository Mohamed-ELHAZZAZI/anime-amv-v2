<template>
    <form class="w-full flex flex-col justify-between px-4 p-4">
        <div class="w-full h-full flex items-center gap-3 mb-4">
            <img
                :src="'../storage/icons/page.jpg'"
                class="rounded-full w-14"
                alt=""
            />
            <span class="flex flex-col">
                <span class="font-bold text-lg">Autako live</span>
                <span class="text-sm text-gray-500">Now</span>
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
                        v-if="showRemoveVideo"
                        @click="removeVideo"
                        class="absolute right-2 top-2 p-1 rounded-full bg-black bg-opacity-40 cursor-pointer z-10"
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
            Publish
        </button>
    </form>
</template>

<script setup>
import { ref } from "vue";

const showVideo = ref(false);
const showTextArea = ref(true);
const showRemoveVideo = ref(false);
const text = ref("");
let myFile = null;

function selectedFile(e) {
    myFile = e.target.files[0];
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
    file.value = null;
    showVideo.value = false;
    videoTag.src = "";
    myFile = null;
}

function textFilterTag() {
    let d = document.getElementById("textArea");
    d.style.height = "auto";
    d.style.height = `${d.scrollHeight}px`;
    let str = text.value;
    str = str.replace(/(<.+?>)/gi, "");
    str = str.replace(/(?:\r\n|\n\r|\r|\n)/g, "<br /> ");
    str = str.replace(
        /(?:\s|^)#([^0-9\W\s][a-zA-z0-9]*)/g,
        " <span class='text-utOrange'>#$1</span>"
    );
    $("#input").html(str);
}
function displayTextArea() {
    showTextArea.value = true;
    setTimeout(() => {
        $("#textArea").focus();
    }, 100);
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
