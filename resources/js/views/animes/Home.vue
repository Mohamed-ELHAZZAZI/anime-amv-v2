<template>
    <div class="sliding-container" ref="container" @mousemove="handleMouseMove">
        <div
            class="sliding-div flex flex-wrap gap-0"
            :style="{ transform: `translate3d(${x}px, ${y}px, 0)` }"
        >
            <div
                class="w-auto h-96 p-2 border border-gray-400"
                v-for="anime in animes"
                :key="anime.id"
            >
                <img
                    :src="
                        '../storage/anime/images/anime_' + anime.unqID + '.webp'
                    "
                    alt=""
                    class="h-full w-auto"
                />
                <!-- {{ anime.name }} -->
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { onBeforeMount } from "vue";
import store from "../../store";
const animes = ref();
onBeforeMount(() => {
    store.dispatch("getTopAnimes").then((res) => {
        animes.value = res.data.rr;
        console.log(animes.value);
    });
});

const x = ref(0);
const y = ref(0);
const containerWidth = ref(0);
const containerHeight = ref(0);
const container = ref(null);

const handleMouseMove = (event) => {
    const offsetX = event.clientX - containerWidth.value / 2;
    const offsetY = event.clientY - containerHeight.value / 2;
    const maxTranslateX = containerWidth.value;
    const maxTranslateY = containerHeight.value;
    const translateX = Math.min(
        maxTranslateX / 2,
        Math.max(-maxTranslateX / 2, -offsetX * 0.1)
    );
    const translateY = Math.min(
        maxTranslateY / 2,
        Math.max(-maxTranslateY / 2, -offsetY * 0.1)
    );
    x.value = translateX;
    y.value = translateY;
};

const updateScroll = () => {
    const offsetX = -x.value / 0.1; // flip the sign
    const offsetY = -y.value / 0.1; // flip the sign
    const scrollX = container.value.scrollLeft + offsetX * 0.01;
    const scrollY = container.value.scrollTop + offsetY * 0.01;
    container.value.scrollLeft = scrollX;
    container.value.scrollTop = scrollY;
    requestAnimationFrame(updateScroll);
};

onBeforeMount(() => {
    // Call the updateScroll function once to start the continuous scroll
    requestAnimationFrame(updateScroll);
});

const setContainerSize = () => {
    containerWidth.value = container.value.offsetWidth;
    containerHeight.value = container.value.offsetHeight;
};

setInterval(setContainerSize, 100);
</script>

<style scoped>
.sliding-container {
    overflow: hidden;
    width: 100vw;
    height: 100vh;
}

.sliding-div {
    /* background-color: gray; */
    min-width: 270vw;
    min-height: 200vh;
    will-change: transform;
    transition: transform 3s ease-out;
    width: auto;
}
</style>
