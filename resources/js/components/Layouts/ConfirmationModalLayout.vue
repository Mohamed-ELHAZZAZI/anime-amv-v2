<template>
    <div
        v-show="showModel"
        class="absolute h-full top-0 left-0 right-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto md:inset-0 bg-[#0000004b]"
    >
        <div class="relative w-full max-w-md">
            <div class="relative rounded-lg shadow bg-gray-700">
                <button
                    :disabled="!showDLTBtn"
                    type="button"
                    :class="
                        !showDLTBtn
                            ? 'cursor-not-allowed'
                            : 'hover:bg-gray-800 hover:text-white'
                    "
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-800 hover:text-white"
                    @click="HideDeleteModel"
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
                <div class="p-6 text-center">
                    <svg
                        aria-hidden="true"
                        class="mx-auto mb-4 w-14 h-14 text-gray-200"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        ></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-400">
                        {{ message }}
                    </h3>
                    <button
                        :disabled="!showDLTBtn"
                        type="button"
                        @click="deletePost"
                        class="text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 min-w-[120px] justify-center"
                    >
                        <span v-if="showDLTBtn">Yes, I'm sure</span>
                        <div v-else>
                            <svg
                                aria-hidden="true"
                                class="inline w-6 h-6 animate-spin text-gray-600 fill-gray-300"
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
                        @click="HideDeleteModel"
                        type="button"
                        :disabled="!showDLTBtn"
                        :class="
                            !showDLTBtn
                                ? 'cursor-not-allowed'
                                : 'hover:text-white hover:bg-gray-600 focus:ring-gray-600'
                        "
                        class="focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500"
                    >
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

defineExpose({ showDeleteModel, HideDeleteModel });

const props = defineProps(["message"]);
const emit = defineEmits(["delete"]);
const showModel = ref(false);
const showDLTBtn = ref(true);

function showDeleteModel() {
    showModel.value = true;
}

function HideDeleteModel() {
    showModel.value = false;
}

function deletePost() {
    emit("delete");
    showDLTBtn.value = false;
}
</script>

<style></style>
