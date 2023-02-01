<template>
    <div
        class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-30 z-10 flex items-center justify-center"
    >
        <div class="w-96 h-80 bg-red-600" @click="aa"></div>
    </div>
</template>

<script setup>
const emit = defineEmits(["closeAuthModel"]);
function aa() {
    emit("closeAuthModel");
}
</script>

<style>
body {
    overflow: hidden;
}
</style>
