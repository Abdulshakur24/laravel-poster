<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-gray-800 font-semibold text-xs text-white uppercase active:bg-gray-900 disabled:opacity-25 transition"
    >
        <slot />
    </button>
</template>
