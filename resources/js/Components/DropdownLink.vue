<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    href: String,
    as: String,
    isActive: Boolean,
});
</script>

<template>
    <div>
        <button
            v-if="as == 'submit'"
            type="submit"
            :class="`block w-full px-4 py-2 text-xs text-gray-700 dark:text-gray-300 text-left hover:bg-gray-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-gray-100 transition`"
        >
            <slot />
        </button>

        <a
            v-else-if="as == 'a'"
            :href="href"
            :class="`block px-4 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-gray-100 transition`"
        >
            <slot />
        </a>

        <Link
            v-else
            :href="href"
            :class="` ${
                isActive
                    ? 'bg-gray-400 dark:bg-slate-900'
                    : 'hover:bg-gray-100 dark:hover:bg-slate-900'
            } block px-4 py-2 text-xs text-gray-700 dark:text-gray-300  focus:outline-none focus:bg-gray-100 transition`"
        >
            <slot />
        </Link>
    </div>
</template>
