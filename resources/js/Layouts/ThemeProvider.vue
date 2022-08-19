<script setup lang="ts">
import { watch, watchEffect } from "vue";
import { useThemeStore } from "../stores/theme";
import { storeToRefs } from "pinia";

const { currentTheme, isOnOSTheme } = storeToRefs(useThemeStore());
const { determineTheme, setOSTheme, toggleTheme } = useThemeStore();

determineTheme();
watchEffect(() => {
    const OSTheme = window.matchMedia("(prefers-color-scheme: dark)");
    OSTheme.addEventListener("change", () => {
        toggleTheme();
        setOSTheme();
        determineTheme();
    });
});

watch([currentTheme, isOnOSTheme], () => determineTheme());
</script>

<template>
    <slot />
</template>
