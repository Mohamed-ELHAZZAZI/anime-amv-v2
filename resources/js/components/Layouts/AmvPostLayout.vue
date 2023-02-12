<template>
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
                    <span class="font-semibold text-lg">
                        {{ post.user.firstName + " " + post.user.lastName }}
                    </span>
                    <span class="text-sm text-gray-500"
                        >@autakoLive - {{ post.created_at }}</span
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
            <p v-html="text"></p>
            <!-- This AMV is very -->
            <!-- <router-link to="/" class="text-utOrange ml-1 hover:underline"
                >{{ " " }}#excited</router-link
            > -->
        </div>
        <video :src="'../storage/' + post.video" controls></video>
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
                {{ post.comments }}
            </button>
            <button class="h-full flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="m12 21-1.45-1.3q-2.525-2.275-4.175-3.925T3.75 12.812Q2.775 11.5 2.388 10.4 2 9.3 2 8.15 2 5.8 3.575 4.225 5.15 2.65 7.5 2.65q1.3 0 2.475.55T12 4.75q.85-1 2.025-1.55 1.175-.55 2.475-.55 2.35 0 3.925 1.575Q22 5.8 22 8.15q0 1.15-.387 2.25-.388 1.1-1.363 2.412-.975 1.313-2.625 2.963-1.65 1.65-4.175 3.925Zm0-2.7q2.4-2.15 3.95-3.688 1.55-1.537 2.45-2.674.9-1.138 1.25-2.026.35-.887.35-1.762 0-1.5-1-2.5t-2.5-1q-1.175 0-2.175.662-1 .663-1.375 1.688h-1.9q-.375-1.025-1.375-1.688-1-.662-2.175-.662-1.5 0-2.5 1t-1 2.5q0 .875.35 1.762.35.888 1.25 2.026.9 1.137 2.45 2.674Q9.6 16.15 12 18.3Zm0-6.825Z"
                    />
                </svg>
                {{ post.likes }}
            </button>
            <button class="h-full flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="M12.025 21.925q-3.35-3.375-5.337-5.45Q4.7 14.4 3.663 13.025q-1.038-1.375-1.351-2.35Q2 9.7 2 8.5q0-2.3 1.6-3.9T7.5 3q1.125 0 2.175.412 1.05.413 1.875 1.188L10 10h3l-.85 8.375L15 9h-3l1.775-5.3q.625-.35 1.313-.525Q15.775 3 16.5 3q2.3 0 3.9 1.6T22 8.5q0 1.2-.325 2.2-.325 1-1.375 2.387-1.05 1.388-3.025 3.451-1.975 2.062-5.25 5.387Zm-1.775-4.65L10.775 12H7.35l1.875-6.575q-.4-.2-.837-.313Q7.95 5 7.5 5 6.05 5 5.025 6.025 4 7.05 4 8.5q0 .775.287 1.55.288.775 1 1.762.713.988 1.926 2.3 1.212 1.313 3.037 3.163Zm4.7-1.2q2.775-2.825 3.913-4.5Q20 9.9 20 8.5q0-1.45-1.025-2.475Q17.95 5 16.5 5q-.275 0-.55.037-.275.038-.55.138L14.8 7h2.9ZM17.7 7ZM7.35 12Z"
                    />
                </svg>
                {{ post.dislikes }}
            </button>
            <button class="h-full flex items-center gap-1 pr-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path
                        d="M18 22q-1.25 0-2.125-.875T15 19q0-.175.025-.363.025-.187.075-.337l-7.05-4.1q-.425.375-.95.587Q6.575 15 6 15q-1.25 0-2.125-.875T3 12q0-1.25.875-2.125T6 9q.575 0 1.1.212.525.213.95.588l7.05-4.1q-.05-.15-.075-.337Q15 5.175 15 5q0-1.25.875-2.125T18 2q1.25 0 2.125.875T21 5q0 1.25-.875 2.125T18 8q-.575 0-1.1-.213-.525-.212-.95-.587L8.9 11.3q.05.15.075.337Q9 11.825 9 12t-.025.362q-.025.188-.075.338l7.05 4.1q.425-.375.95-.588Q17.425 16 18 16q1.25 0 2.125.875T21 19q0 1.25-.875 2.125T18 22Zm0-16q.425 0 .712-.287Q19 5.425 19 5t-.288-.713Q18.425 4 18 4t-.712.287Q17 4.575 17 5t.288.713Q17.575 6 18 6ZM6 13q.425 0 .713-.288Q7 12.425 7 12t-.287-.713Q6.425 11 6 11t-.713.287Q5 11.575 5 12t.287.712Q5.575 13 6 13Zm12 7q.425 0 .712-.288Q19 19.425 19 19t-.288-.712Q18.425 18 18 18t-.712.288Q17 18.575 17 19t.288.712Q17.575 20 18 20Zm0-15ZM6 12Zm12 7Z"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

const props = defineProps(["post"]);
const text = ref(null);
onMounted(() => {
    let str = props.post.text;
    str = str.replace(/(<.+?>)/gi, "");
    str = str.replace(/(?:\r\n|\n\r|\r|\n)/g, "<br /> ");
    str = str.replace(/(?:\s|^)#([^0-9\W\s][a-zA-z0-9]*)/g, (value) => {
        var res = Vue.compile("<div><span>{{ value }}</span></div>");
        return `<span class='text-utOrange cursor-pointer hover:underline' ">${value}</span>`;
    });
    text.value = str;
});
</script>

<style></style>
