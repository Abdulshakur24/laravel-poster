<script setup>
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Posts from "@/Components/Posts.vue";

defineProps({
    id: Number,
});
</script>

<template>
    <AppLayout>
        <Head title="Home" />
        <div class="text-slate-900 dark:text-gray-200 mx-auto max-w-7xl">
            <Posts :posts="$page.props.posts.data" />
        </div>
    </AppLayout>
</template>
