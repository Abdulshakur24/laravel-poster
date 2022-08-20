<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { useThemeStore } from "@/stores/theme";
import { storeToRefs } from "pinia";
import ApplicationLogo from "../Components/ApplicationLogo.vue";
import { Inertia } from "@inertiajs/inertia";

const { currentTheme, isOnOSTheme } = storeToRefs(useThemeStore());
const { toggleTheme, setOSTheme } = useThemeStore();

Inertia.on("start", (event) => {
    console.log(`The route changed to ${event.detail.visit.url}`);
});

const logout = () => {
    Inertia.post(route("logout"));
};

const activeLink =
    "border-l-4 border-slate-900 dark:border-gray-50 bg-gray-400 dark:bg-slate-900 ";
const normalLink =
    "hover:bg-slate-600 hover:text-gray-200 dark:hover:text-white ";

defineProps({
    toggleSidebar: Function,
    routes: Array,
});
</script>

<template>
    <div class="fixed inset-0 z-10 bg-black/40">
        <div
            @click.stop
            class="absolute overflow-auto right-0 top-0 bottom-0 w-full max-w-[320px] bg-gray-200 dark:bg-slate-800 transition-all duration-150 ease-in-out"
        >
            <div>
                <header
                    class="py-[0.75rem] mx-4 flex items-center justify-between"
                >
                    <ApplicationLogo class="w-10" />

                    <!-- Hamburger -->
                    <div
                        class="flex items-center justify-center sm:hidden w-8 h-8"
                    >
                        <ul @click="toggleSidebar" class="cursor-pointer">
                            <li
                                :class="`w-[35px] h-[3px]  bg-slate-800 dark:bg-white transition-all ease-in-out duration-150   -rotate-45 mb-[-3px]`"
                            ></li>
                            <li
                                :class="`w-[35px] h-[3px]  bg-slate-800 dark:bg-white transition-all ease-in-out duration-150 opacity-0 mb-[-3px]`"
                            ></li>
                            <li
                                :class="`w-[35px] h-[3px]  bg-slate-800 dark:bg-white transition-all ease-in-out duration-150 rotate-45`"
                            ></li>
                        </ul>
                    </div>
                </header>
                <main class="pb-4">
                    <hr class="bg-slate-900 dark:bg-white w-full h-[1px]" />
                    <div
                        v-if="$page.props.user"
                        class="flex flex-col items-start"
                    >
                        <Link
                            @click="toggleSidebar"
                            v-for="currentRoute in routes"
                            :href="route(currentRoute.path)"
                            :class="` ${
                                route().current(currentRoute.path)
                                    ? activeLink
                                    : normalLink
                            } transition-all duration-150 p-4 w-full ease-in-out text-slate-800 dark:text-white dark:hover:bg-slate`"
                        >
                            {{ currentRoute.name }}
                        </Link>
                        <form class="w-full" @submit.prevent="logout">
                            <button
                                :class="`text-start transition-all duration-150 p-4 w-full ease-in-out text-slate-800 dark:text-white dark:hover:bg-slate hover:bg-slate-600 hover:text-gray-200 dark:hover:text-white`"
                            >
                                Logout
                            </button>
                        </form>
                    </div>
                    <div v-else class="flex flex-col items-start">
                        <Link
                            @click="toggleSidebar"
                            href="/login"
                            :class="`transition-all duration-150 p-4 w-full ease-in-out text-slate-800 dark:text-white dark:hover:bg-slate hover:bg-slate-600 hover:text-gray-200 dark:hover:text-white `"
                        >
                            Login
                        </Link>
                        <Link
                            href="/register"
                            @click="toggleSidebar"
                            :class="`transition-all duration-150 p-4 w-full ease-in-out text-slate-800 dark:text-white dark:hover:bg-slate hover:bg-slate-600 hover:text-gray-200 dark:hover:text-white `"
                        >
                            Register
                        </Link>
                    </div>
                    <hr class="bg-slate-900 dark:bg-white w-full h-[1px]" />
                    <div class="flex flex-col items-start justify-center">
                        <h2
                            class="underline p-4 text-slate-900 dark:text-slate-100"
                        >
                            Theme
                        </h2>
                        <button
                            :class="`py-4 px-4 w-full text-left text-slate-900 dark:text-slate-100 ${
                                !isOnOSTheme
                                    ? 'border-l-4 border-slate-900 dark:border-gray-50 bg-gray-400 dark:bg-slate-900'
                                    : ''
                            }`"
                            @click="toggleTheme"
                        >
                            {{ currentTheme === "light" ? "Dark" : "Light" }}
                        </button>
                        <button
                            :class="`py-4 px-2 w-full text-left text-slate-900 dark:text-slate-100 ${
                                isOnOSTheme
                                    ? 'border-l-4 border-slate-900 dark:border-gray-50 bg-gray-400 dark:bg-slate-900'
                                    : ''
                            }`"
                            @click="setOSTheme"
                        >
                            {{
                                isOnOSTheme
                                    ? "System preferred"
                                    : "Set on System"
                            }}
                        </button>
                    </div>
                    <!-- <div class="min-h-screen w-full" /> -->
                </main>
            </div>
        </div>
    </div>
</template>
