<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import PostTags from "@/components/PostTags.vue";
defineProps({
    post: Object,
});
</script>

<template>
    <div class="border-[1px] p-2 border-slate-900 dark:border-slate-500">
        <div class="flex items-center gap-2">
            <div v-if="post.logo" class="hidden sm:block">
                <img :src="post.logo" />
            </div>
            <div>
                <h3 class="text-2xl">
                    <Link :href="`/posts/${post.id}`">{{ post.title }}</Link>
                </h3>
                <div class="text-xl font-bold mb-4">{{ post.company }}</div>
                <PostTags :tagsCsv="post.tags" />
                <div class="text-lg mt-4 flex items-center justify-start gap-2">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>{{ post.location }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
