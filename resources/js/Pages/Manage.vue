<script>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        Link,
        AppLayout,
        Inertia,
    },

    props: {
        websites: Object,
    },

    methods: {
        deletePost(id) {
            this.$inertia.delete(`/posts/${id}`);
        },
    },
};
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-center">
                <div
                    class="w-full max-w-xl m-4 justify-center px-6 bg-white dark:bg-slate-900 shadow-md overflow-hidden"
                >
                    <div
                        v-if="$page.props.posts?.length"
                        v-for="post in $page.props.posts"
                        class="flex py-4 justify-between border-b-2 last:border-none border-slate-600 overflow-y-auto"
                    >
                        <div
                            class="text-slate-900 dark:text-slate-50 border-slate-800 text-lg"
                        >
                            <Link
                                class="text-ellipsis"
                                :href="`/posts/${post.id}`"
                            >
                                {{ post.title }}
                            </Link>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="text-slate-900 dark:text-slate-50 border-slate-800 text-lg"
                            >
                                <Link
                                    :href="`/posts/${post.id}/edit`"
                                    class="text-blue-400 rounded-xl flex items-center gap-2"
                                >
                                    Edit</Link
                                >
                            </div>
                            <div class="border-slate-800 text-lg">
                                <form
                                    @click.prevent
                                    @click="deletePost(post.id)"
                                >
                                    <button
                                        type="submit"
                                        class="text-red-500 flex items-center gap-2"
                                    >
                                        DELETE
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div
                        v-else
                        class="flex items-center justify-center text-slate-900 dark:text-slate-200"
                    >
                        <div class="flex flex-col justify-center">
                            <p class="text-center">You don't have any post.</p>
                            <div>
                                <Link
                                    href="/posts/create"
                                    class="hover:underline hover"
                                    >Click here
                                </Link>
                                to create your post!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
