<script setup>
import Post from "./Post.vue";
import { Link } from "@inertiajs/inertia-vue3";
defineProps({
    posts: Array,
});
</script>

<template>
    <div class="m-4 bg-white dark:bg-slate-900 p-4">
        <div v-if="posts.length" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <Post v-for="post in posts" :post="post" />
        </div>
        <div v-else class="w-full flex flex-col items-center justify-center">
            <p>No post found in our records</p>
            <div class="flex items-center gap-1">
                <Link href="/posts/create" class="hover:underline hover"
                    >Click here
                </Link>
                <p>to create a post.</p>
            </div>
        </div>
    </div>
</template>
