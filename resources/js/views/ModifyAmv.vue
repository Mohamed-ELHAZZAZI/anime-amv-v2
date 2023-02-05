<template>
    <div
        class="px-5 py-4 bg-white dark:bg-[var(--primary-dark-color)] shadow rounded-lg"
    >
        <!-- Start Error -->
        <div
            v-if="errorMsg"
            id="alert-2"
            class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-[#0e1827] dark:text-red-400"
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
                class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-[#0e1827] dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-2"
                aria-label="Close"
                @click="clearError"
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

        <form class="flex flex-col gap-6" @submit.prevent="submitAmv">
            <div>
                <label
                    for="message"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Your message</label
                >
                <textarea
                    :disabled="disabled"
                    id="message"
                    rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:border-[var(--tertiary-light-color)] focus:ring-0 dark:bg-[#dddddd1c] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-[var(--tertiary-dark-color)]"
                    placeholder="Write your thoughts here..."
                    v-model="text"
                ></textarea>
            </div>

            <div class="flex flex-col w-full">
                <p
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Upload your video here
                </p>
                <div
                    v-show="showVideo"
                    @mouseover="showRemoveVideo = true"
                    @mouseleave="showRemoveVideo = false"
                    class="w-full flex items-center justify-center relative"
                >
                    <button
                        v-if="showRemoveVideo && !disabled"
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
                    <video
                        id="video-preview"
                        class="w-full"
                        controls
                        :src="'../../storage/' + videoSrc"
                    />
                </div>
                <label
                    v-if="!showVideo"
                    for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-[#dddddd1c] hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
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
                        <p
                            class="mb-2 text-sm text-gray-500 dark:text-gray-400"
                        >
                            <span class="font-semibold">Click to upload</span>
                            or drag and drop
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            MP4, WebM or Ogg (MAX. 100 Mo)
                        </p>
                    </div>
                    <input
                        id="dropzone-file"
                        type="file"
                        class="hidden"
                        @change="selectedFile"
                        ref="file"
                        name="amvVideo"
                    />
                </label>
            </div>
            <div>
                <label
                    for="tags"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Add tags</label
                >
                <div class="flex">
                    <input
                        type="text"
                        id="tags"
                        class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg rounded-r-none bg-gray-50 focus:ring-0 focus:border-[var(--tertiary-light-color)] dark:bg-[#dddddd1c] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-[var(--tertiary-dark-color)]"
                        placeholder="Tags"
                        v-model="tagInput"
                        v-on:keydown.enter.prevent="pushTag"
                        :disabled="disabled"
                    />
                    <button
                        type="button"
                        :disabled="disabled"
                        @click="pushTag"
                        class="text-white capitalize bg-[var(--tertiary-light-color)] hover:bg-[var(--tertiary-hover-light-color)] focus:outline-none font-medium rounded-lg rounded-l-none text-sm px-4 py-2 dark:bg-[var(--tertiary-dark-color)] dark:text-black dark:hover:bg-[var(--tertiary-hover-dark-color)]"
                    >
                        add
                    </button>
                </div>
                <div class="py-2">
                    <span
                        v-for="tag in tags"
                        :key="tag"
                        class="inline-flex items-center px-4 py-2 pr-1 mr-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-[var(--secondary-dark-color)] dark:text-white"
                    >
                        {{ tag }}
                        <button
                            type="button"
                            class="inline-flex items-center p-0.5 ml-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 dark:hover:bg-opacity-20 dark:hover:text-white"
                            @click="removeTag(tag)"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-3.5 h-3.5 dark:text-white"
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
                            <span class="sr-only">Remove tag</span>
                        </button>
                    </span>
                </div>
            </div>
            <button
                :disabled="disabled"
                type="submit"
                class="text-white bg-[var(--secondary-light-color)] capitalize hover:bg-[var(--secondary-hover-light-color)] font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-[var(--secondary-dark-color)] dark:hover:bg-[var(--secondary-hover-dark-color)] max-w-max ml-auto"
            >
                <span v-if="!disabled"> Save</span>
                <span v-else>{{ per + "%" }}</span>
            </button>
            <div
                class="w-full mt-2 bottom-[2px] right-0 dark:bg-[#dddddd1c] mb-[1px] ml-[2px]"
            >
                <div
                    v-if="disabled"
                    class="bg-blue-600 text-[13px] font-medium text-blue-100 text-center h-[5px] leading-none dark:bg-[var(--secondary-dark-color)]"
                    :style="{ width: per + '%' }"
                ></div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, computed, onBeforeMount } from "vue";
import store from "../store";
import { useRouter } from "vue-router";

const props = defineProps(["id"]);
const router = useRouter();
//fomr fileds data
const text = ref(""); //message field
const tags = ref([]); //tags array
const tagInput = ref(""); //tags input
const file = ref(true); //file input
const disabled = ref(false);
let myFile = null;

const errorMsg = ref(""); //error message
const showVideo = ref(true);
const showRemoveVideo = ref(true);
const videoSrc = ref("");
onBeforeMount(async () => {
    await store.dispatch("getSingleAmv", props.id).then((response) => {
        if (response.data.post) {
            text.value = response.data.post.text;
            tags.value = response.data.post.tags;
            videoSrc.value = response.data.post.video;
        } else router.push({ name: "Home" });
    });
});
const per = computed(() => {
    return store.state.uploads.percentage;
});

//clear error value
function clearError() {
    errorMsg.value = "";
}

//push tags from input to tags array
function pushTag() {
    var duplicated = false;

    if (tagInput.value) {
        if (tags.value.length >= 5) {
            return (errorMsg.value =
                "The maximum number of tags permissible is five.");
        }
        tags.value.forEach((element) => {
            if (element.toLowerCase() === tagInput.value.toLowerCase()) {
                tagInput.value = "";
                return (duplicated = true);
            }
        });
        if (!duplicated) tags.value.push(tagInput.value);
    }

    tagInput.value = "";
}

//remove tag form tags array
function removeTag(rtg) {
    return (tags.value = tags.value.filter((tag) => tag !== rtg));
}

//uploaded file verification
function selectedFile() {
    myFile = file.value.files[0];
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

//remove video section and display file input label
function removeVideo() {
    let videoTag = document.getElementById("video-preview");
    file.value = null;
    showVideo.value = false;
    videoTag.src = "";
    myFile = null;
}

//submit sata
function submitAmv() {
    // if (!myFile) {
    //     return (errorMsg.value = "Choosing the appropriate file is crucial.");
    // }
    const data = new FormData();
    data.append("text", text.value);
    data.append("file", myFile);
    tags.value.forEach((tag) => {
        data.append("tags[]", tag);
    });
    disabled.value = true;
    // store.dispatch("postAmv", data).then((res) => {
    //     if (Object.hasOwnProperty(res, "response")) {
    //         disabled.value = false;
    //         for (const e in res.response.data.errors) {
    //             if (Object.hasOwnProperty.call(res.response.data.errors, e)) {
    //                 return (errorMsg.value = res.response.data.errors[e][0]);
    //             }
    //         }
    //     } else {
    //         router.push("/");
    //     }
    // });
}
</script>

<style></style>
