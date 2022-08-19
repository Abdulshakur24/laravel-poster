<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationLogo from "@/Components/ApplicationLogo.vue";
import JetBanner from "@/Components/Banner.vue";
import JetDropdown from "@/Components/Dropdown.vue";
import JetDropdownLink from "@/Components/DropdownLink.vue";
import JetNavLink from "@/Components/NavLink.vue";
import ThemeProvider from "./ThemeProvider.vue";
import { storeToRefs } from "pinia";
import { useThemeStore } from "../stores/theme";
import JetSidebar from "@/Components/Sidebar.vue";

defineProps({
    title: String,
});

const { currentTheme, isOnOSTheme } = storeToRefs(useThemeStore());
const { toggleTheme, setOSTheme } = useThemeStore();

const showingNavigationDropdown = ref(false);

const logout = () => {
    Inertia.post(route("logout"));
};

const isSidebarOpen = ref(false);
const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const excludeRoute = (array, name) => {
    return array.filter((item) => !name.includes(item.name));
};

const routes = [
    {
        path: "home",
        name: "Home",
    },
    {
        path: "home.create",
        name: "Create a post",
    },
    {
        path: "mangage",
        name: "Manage posts",
    },
    {
        path: "profile.show",
        name: "Profile",
    },
];
</script>

<template>
    <ThemeProvider>
        <div>
            <Head :title="title" />
            <JetBanner />
            <div class="min-h-screen bg-gray-100 dark:bg-slate-800">
                <nav class="border-b border-gray-100 dark:border-gray-700">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between items-center h-16">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center">
                                    <Link :href="route('home')">
                                        <JetApplicationLogo
                                            class="block h-9 w-auto"
                                        />
                                    </Link>
                                </div>
                            </div>

                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <!-- Navigation Links -->
                                <div
                                    class="hidden space-x-8 sm:-my-px sm:mr-10 sm:flex"
                                >
                                    <JetNavLink
                                        v-for="item in excludeRoute(routes, [
                                            'Profile',
                                        ])"
                                        :href="route(item.path)"
                                        :active="route().current(item.path)"
                                    >
                                        {{ item.name }}
                                    </JetNavLink>
                                </div>

                                <!-- Settings Dropdown -->
                                <div class="ml-3 relative">
                                    <JetDropdown align="right" width="48">
                                        <template #trigger>
                                            <button
                                                v-if="
                                                    $page.props.jetstream
                                                        .managesProfilePhotos &&
                                                    $page.props.user
                                                "
                                                class="flex text-sm border-1 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                            >
                                                <img
                                                    class="w-10 rounded-full focus:ring-2 ring-slate-400 object-cover"
                                                    :src="
                                                        $page.props.user
                                                            .profile_photo_url
                                                    "
                                                    :alt="$page.props.user.name"
                                                />
                                            </button>

                                            <span
                                                v-else-if="$page.props.user"
                                                class="inline-flex"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium text-gray-500 bg-white dark:bg-slate-900 hover:text-gray-700 dark:text-gray-200 focus:outline-none transition"
                                                >
                                                    {{ $page.props.user.name }}
                                                    <svg
                                                        class="ml-2 -mr-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>

                                            <span v-else>
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium text-gray-500 bg-white dark:bg-slate-900 hover:text-gray-700 dark:text-gray-200 focus:outline-none transition"
                                                >
                                                    Guest
                                                    <svg
                                                        class="ml-2 -mr-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div
                                                v-if="$page.props.user"
                                                class="block underline px-4 py-2 text-xs text-gray-400 dark:text-gray-100"
                                            >
                                                Manage Account
                                            </div>
                                            <div
                                                v-else
                                                class="block underline px-4 py-2 text-xs text-gray-400 dark:text-gray-100"
                                            >
                                                Sign in/Register
                                            </div>

                                            <JetDropdownLink
                                                v-if="$page.props.user"
                                                :is-active="
                                                    route().current(
                                                        'profile.show'
                                                    )
                                                "
                                                :href="route('profile.show')"
                                            >
                                                Profile
                                            </JetDropdownLink>

                                            <div v-else>
                                                <JetDropdownLink
                                                    :is-active="
                                                        route().current('login')
                                                    "
                                                    :href="route('login')"
                                                >
                                                    Login
                                                </JetDropdownLink>
                                                <JetDropdownLink
                                                    :is-active="
                                                        route().current(
                                                            'register'
                                                        )
                                                    "
                                                    :href="route('register')"
                                                >
                                                    Register
                                                </JetDropdownLink>
                                            </div>

                                            <!-- Authentication -->
                                            <form
                                                v-if="$page.props.user"
                                                @submit.prevent="logout"
                                            >
                                                <JetDropdownLink
                                                    as="submit"
                                                    class=""
                                                >
                                                    Log Out
                                                </JetDropdownLink>
                                            </form>

                                            <!-- Theme -->
                                            <div
                                                class="block underline px-4 py-2 text-xs text-gray-400 dark:text-gray-100"
                                            >
                                                Theme
                                            </div>

                                            <button
                                                :class="`px-4 py-2 text-xs w-full text-left text-slate-900 dark:text-slate-100 ${
                                                    !isOnOSTheme
                                                        ? 'border-l-4 border-slate-900 dark:border-gray-50 bg-gray-400 dark:bg-slate-900'
                                                        : 'hover:bg-gray-100 dark:hover:bg-slate-900'
                                                }`"
                                                @click="toggleTheme"
                                            >
                                                {{
                                                    currentTheme === "light"
                                                        ? "Dark"
                                                        : "Light"
                                                }}
                                            </button>
                                            <button
                                                :class="`px-4 py-2 text-xs w-full text-left text-slate-900 dark:text-slate-100 ${
                                                    isOnOSTheme
                                                        ? 'border-l-4 border-slate-900 dark:border-gray-50 bg-gray-400 dark:bg-slate-900'
                                                        : 'hover:bg-gray-100 dark:hover:bg-slate-900'
                                                }`"
                                                @click="setOSTheme"
                                            >
                                                {{
                                                    isOnOSTheme
                                                        ? "System preferred"
                                                        : "Set on System"
                                                }}
                                            </button>
                                        </template>
                                    </JetDropdown>
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <div
                                class="flex items-center justify-center sm:hidden w-8 h-8"
                            >
                                <ul
                                    @click="toggleSidebar"
                                    class="cursor-pointer"
                                >
                                    <li
                                        :class="`w-[35px] h-[3px]  bg-slate-800 dark:bg-white transition-all ease-in-out duration-150   ${
                                            isSidebarOpen
                                                ? '-rotate-45 mb-[-3px]'
                                                : 'mb-[8px]'
                                        } `"
                                    ></li>
                                    <li
                                        :class="`w-[35px] h-[3px]  bg-slate-800 dark:bg-white transition-all ease-in-out duration-150 ${
                                            isSidebarOpen
                                                ? 'opacity-0 mb-[-3px]'
                                                : 'mb-[8px]'
                                        } `"
                                    ></li>
                                    <li
                                        :class="`w-[35px] h-[3px]  bg-slate-800 dark:bg-white transition-all ease-in-out duration-150   ${
                                            isSidebarOpen ? 'rotate-45 ' : ''
                                        }`"
                                    ></li>
                                </ul>
                            </div>
                            <transition
                                enter-active-class="duration-150 ease-out"
                                enter-from-class="transform opacity-0"
                                enter-to-class="opacity-100"
                                leave-active-class="duration-150 ease-in"
                                leave-from-class="opacity-100"
                                leave-to-class="transform opacity-0"
                                class="sm:hidden"
                            >
                                <JetSidebar
                                    :routes="routes"
                                    :toggle-sidebar="toggleSidebar"
                                    @click="toggleSidebar"
                                    v-show="isSidebarOpen"
                                />
                            </transition>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                <header v-if="$slots.header" class="bg-white dark:bg-slate-900">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </ThemeProvider>
</template>
