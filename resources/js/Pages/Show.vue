<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage, Link } from "@inertiajs/inertia-vue3";
import PostTags from "@/Components/PostTags.vue";

const post = usePage().props.value.post;
</script>

<template>
    <AppLayout>
        <div class="text-slate-900 dark:text-slate-50">
            <div class="max-w-xl mx-auto my-4">
                <Link
                    href="/"
                    class="inline-block text-slate-900 dark:text-slate-50 ml-4 mb-4"
                    >Back</Link
                >

                <div class="mx-4">
                    <div
                        class="bg-gray-50 dark:bg-slate-900 border-2 border-gray-200 dark:border-slate-700 p-10 rounded"
                    >
                        <div
                            class="flex flex-col items-center justify-center text-center"
                        >
                            <h3 class="text-2xl mb-2">{{ post.title }}</h3>
                            <div class="text-xl font-bold mb-4">
                                {{ post.company }}
                            </div>
                            <PostTags :tagsCsv="post.tags" />

                            <div class="text-lg my-4">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ post.location }}
                            </div>
                            <div
                                class="border border-gray-200 dark:border-slate-700 w-full mb-6"
                            />
                            <div>
                                <h3 class="text-3xl font-bold mb-4">
                                    Job Description
                                </h3>
                                <div class="text-lg space-y-6">
                                    <p>{{ post.description }}</p>

                                    <a
                                        href="mailto:{{ post.email }}"
                                        class="block bg-primary text-slate-900 dark:text-slate-100 p-2 rounded-xl hover:opacity-80"
                                    >
                                        {{ post.email }}
                                    </a>

                                    <a
                                        :href="`https://${post.website}`"
                                        target="_blank"
                                        class="block bg-gray-200 dark:bg-slate-800 text-slate-900 dark:text-slate-100 py-2 hover:opacity-80"
                                    >
                                        <i class="fa-solid fa-globe mr-2"></i
                                        >Visit Website
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
