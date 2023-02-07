<template>
    <div
        class="w-full bg-white text-prussianBlue rounded-md overflow-hidden border border-gray-300"
    >
        <ul class="w-full">
            <li class="w-full h-16 px-5">
                <span
                    class="h-full w-full flex items-center justify-between text-xl capitalize font-semibold"
                >
                    most trending
                </span>
            </li>
            <li
                v-for="x in [
                    'one_piece',
                    'hunterXhunter',
                    'naruto',
                    'tokyoGhoul',
                    'funny',
                    'drama',
                ]"
                :key="x"
                class="w-full h-16 border-t border-t-gray-300"
            >
                <router-link
                    to="/"
                    class="w-full h-full flex items-center px-5"
                >
                    #{{ x }}
                </router-link>
            </li>
            <li class="w-full h-14 border-t border-t-gray-300">
                <button
                    class="h-full w-full flex items-center justify-between text-utOrange px-5 font-medium"
                >
                    Show more
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup></script>

<style></style>
