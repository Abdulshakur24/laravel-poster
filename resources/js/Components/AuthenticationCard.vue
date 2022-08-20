<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-slate-800"
    >
        <div>
            <slot name="logo" />
        </div>

        <div
            class="w-full mt-6 px-6 py-4 mx-4 bg-white dark:bg-slate-900 shadow-md overflow-hidden"
        >
            <slot />
        </div>
    </div>
</template>
