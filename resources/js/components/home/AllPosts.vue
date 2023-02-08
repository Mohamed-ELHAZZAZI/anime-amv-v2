<template>
    <div
        class="w-full bg-white border px-2 py-2 sm:px-4 sm:py-3 border-gray-300 flex flex-col justify-between gap-3 rounded-md cursor-pointer"
        @click="showCreate = true"
    >
        <div class="w-full flex items-center text-gray-400 gap-3">
            <img
                :src="'../storage/icons/page.jpg'"
                class="rounded-full w-12 outline-none focus:ring-0 shadow-none"
                alt=""
            />
            <span>Type here ...</span>
            <button
                class="bg-utOrange p-2 text-white sm:w-36 w-24 ml-auto rounded-full"
                type="button"
            >
                Post
            </button>
        </div>
    </div>
    <div
        v-if="showCreate"
        class="fixed top-0 right-0 bottom-0 left-0 bg-black bg-opacity-25 z-50 flex items-center justify-center"
    >
        <div class="w-[550px] pb-2 bg-white rounded-md">
            <div
                class="h-14 w-full relative border-b border-gray-300 flex items-center justify-center font-medium text-xl"
            >
                Create Post
                <button
                    class="absolute cursor-pointer right-3 top-3 p-1 hover:bg-prussianBlue hover:text-white rounded-md"
                    @click="showCreate = false"
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
            </div>
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
                        id="textArea"
                        @keyup="resizeTextArea"
                        class="w-full p-0 overflow-hidden border-none focus:ring-0 outline-none resize-none min-h-[72px] placeholder:text-lg text-lg"
                        placeholder="What's up, Med?"
                    ></textarea>
                    <div class="flex flex-col w-full">
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
                                ref="file"
                                name="amvVideo"
                            />
                        </label>
                    </div>
                </div>
                <button
                    class="w-full mt-8 bg-utOrange rounded-md text-white h-10"
                >
                    Publish
                </button>
            </form>
        </div>
    </div>
    <div
        class="w-full border border-gray-300 rounded-md bg-white py-2 sm:px-5 px-2 pb-5 flex flex-col gap-2"
    >
        <div class="w-full h-16">
            <div class="w-full h-full flex items-center gap-5">
                <img
                    :src="'../storage/icons/page.jpg'"
                    class="rounded-full w-14"
                    alt=""
                />
                <span class="flex flex-col">
                    <span class="font-semibold text-lg"> Autako Live </span>
                    <span class="text-sm text-gray-500"
                        >@autakoLive - 33 minutes ago</span
                    >
                </span>
                <router-link to="/" class="ml-auto text-lg">
                    <i
                        class="fa-solid fa-arrow-up-right-from-square text-gray-600"
                    ></i>
                </router-link>
                <button class="text-lg text-gray-600">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
        </div>
        <div class="w-full flex">
            This AMV is very
            <router-link to="/" class="text-utOrange ml-1 hover:underline"
                >{{ " " }}#excited</router-link
            >
        </div>
        <video :src="'../storage/video/my_amv.mp4'" controls></video>
        <div
            class="w-full h-12 flex justify-between border-t border-gray-300 mt-3"
        >
            <button class="h-full flex items-center gap-1">
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
                10
            </button>
            <button class="h-full flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="m12 21-1.45-1.3q-2.525-2.275-4.175-3.925T3.75 12.812Q2.775 11.5 2.388 10.4 2 9.3 2 8.15 2 5.8 3.575 4.225 5.15 2.65 7.5 2.65q1.3 0 2.475.55T12 4.75q.85-1 2.025-1.55 1.175-.55 2.475-.55 2.35 0 3.925 1.575Q22 5.8 22 8.15q0 1.15-.387 2.25-.388 1.1-1.363 2.412-.975 1.313-2.625 2.963-1.65 1.65-4.175 3.925Zm0-2.7q2.4-2.15 3.95-3.688 1.55-1.537 2.45-2.674.9-1.138 1.25-2.026.35-.887.35-1.762 0-1.5-1-2.5t-2.5-1q-1.175 0-2.175.662-1 .663-1.375 1.688h-1.9q-.375-1.025-1.375-1.688-1-.662-2.175-.662-1.5 0-2.5 1t-1 2.5q0 .875.35 1.762.35.888 1.25 2.026.9 1.137 2.45 2.674Q9.6 16.15 12 18.3Zm0-6.825Z"
                    />
                </svg>
                1.5k
            </button>
            <button class="h-full flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="M12.025 21.925q-3.35-3.375-5.337-5.45Q4.7 14.4 3.663 13.025q-1.038-1.375-1.351-2.35Q2 9.7 2 8.5q0-2.3 1.6-3.9T7.5 3q1.125 0 2.175.412 1.05.413 1.875 1.188L10 10h3l-.85 8.375L15 9h-3l1.775-5.3q.625-.35 1.313-.525Q15.775 3 16.5 3q2.3 0 3.9 1.6T22 8.5q0 1.2-.325 2.2-.325 1-1.375 2.387-1.05 1.388-3.025 3.451-1.975 2.062-5.25 5.387Zm-1.775-4.65L10.775 12H7.35l1.875-6.575q-.4-.2-.837-.313Q7.95 5 7.5 5 6.05 5 5.025 6.025 4 7.05 4 8.5q0 .775.287 1.55.288.775 1 1.762.713.988 1.926 2.3 1.212 1.313 3.037 3.163Zm4.7-1.2q2.775-2.825 3.913-4.5Q20 9.9 20 8.5q0-1.45-1.025-2.475Q17.95 5 16.5 5q-.275 0-.55.037-.275.038-.55.138L14.8 7h2.9ZM17.7 7ZM7.35 12Z"
                    />
                </svg>
                10
            </button>
            <button class="h-full flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="M18 22q-1.25 0-2.125-.875T15 19q0-.175.025-.363.025-.187.075-.337l-7.05-4.1q-.425.375-.95.587Q6.575 15 6 15q-1.25 0-2.125-.875T3 12q0-1.25.875-2.125T6 9q.575 0 1.1.212.525.213.95.588l7.05-4.1q-.05-.15-.075-.337Q15 5.175 15 5q0-1.25.875-2.125T18 2q1.25 0 2.125.875T21 5q0 1.25-.875 2.125T18 8q-.575 0-1.1-.213-.525-.212-.95-.587L8.9 11.3q.05.15.075.337Q9 11.825 9 12t-.025.362q-.025.188-.075.338l7.05 4.1q.425-.375.95-.588Q17.425 16 18 16q1.25 0 2.125.875T21 19q0 1.25-.875 2.125T18 22Zm0-16q.425 0 .712-.287Q19 5.425 19 5t-.288-.713Q18.425 4 18 4t-.712.287Q17 4.575 17 5t.288.713Q17.575 6 18 6ZM6 13q.425 0 .713-.288Q7 12.425 7 12t-.287-.713Q6.425 11 6 11t-.713.287Q5 11.575 5 12t.287.712Q5.575 13 6 13Zm12 7q.425 0 .712-.288Q19 19.425 19 19t-.288-.712Q18.425 18 18 18t-.712.288Q17 18.575 17 19t.288.712Q17.575 20 18 20Zm0-15ZM6 12Zm12 7Z"
                    />
                </svg>
                100
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const showCreate = ref(false);
function resizeTextArea(e) {
    let d = document.getElementById("textArea");
    d.style.height = "auto";
    d.style.height = `${d.scrollHeight}px`;
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
