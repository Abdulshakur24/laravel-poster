<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    tagsCsv: String,
});

const explodeTags = (string) => {
    return string.split(", ");
};
</script>

<template>
    <ul class="flex flex-wrap gap-2">
        <li
            v-for="tag in explodeTags(tagsCsv)"
            class="flex items-center justify-center bg-slate-700 dark:bg-slate-800 text-white rounded-full py-1 px-3 text-xs"
        >
            <Link :href="`/?tag=${tag}`">{{ tag }}</Link>
        </li>
    </ul>
</template>
