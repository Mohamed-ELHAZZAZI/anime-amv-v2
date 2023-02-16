<template>
    <span class="text-sm text-[#df4545] mt-1 flex items-center gap-1">
        <svg version="1.1" viewBox="0 0 12 12" class="w-3 h-3 inline">
            <path
                fill="#df4545"
                stroke="none"
                pid="0"
                d="M6 0a6 6 0 110 12A6 6 0 016 0zm0 1a5 5 0 100 10A5 5 0 006 1zm1 7v2H5V8h2zm0-6v5H5V2h2z"
                _fill="#E02020"
                fill-rule="evenodd"
            ></path>
        </svg>
        {{ error }}
    </span>
</template>

<script setup>
const props = defineProps(["error"]);
const error = props.error;
</script>

<style></style>
