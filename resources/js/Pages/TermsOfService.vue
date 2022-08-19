<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import JetApplicationLogo from "@/Components/ApplicationLogo.vue";
import ThemeProvider from "@/Layouts/ThemeProvider.vue";

defineProps({
    terms: String,
});
</script>

<template>
    <ThemeProvider>
        <Head title="Privacy Policy" />

        <div class="font-sans text-gray-900 antialiased">
            <div class="pt-4 bg-gray-100 dark:bg-slate-800">
                <div
                    class="min-h-screen flex flex-col items-center pt-6 sm:pt-0"
                >
                    <div>
                        <JetApplicationLogo class="max-w-[64px]" />
                    </div>

                    <div
                        class="w-full sm:max-w-2xl mt-6 p-6 bg-white dark:bg-slate-900 shadow-md overflow-hidden prose"
                        v-html="terms"
                    />
                </div>
            </div>
        </div>
    </ThemeProvider>
</template>
