<template>
    <h1>anime</h1>
</template>

<script setup>
import { onBeforeMount } from "vue";
import store from "../../store";

onBeforeMount(() => {
    store.dispatch("getTopAnimes").then((res) => {
        console.log(res.data);
    });
});
</script>

<style></style>
