<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetApplicationLogo from "@/Components/ApplicationLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";
import JetValidationErrors from "@/Components/ValidationErrors.vue";
import ThemeProvider from "@/Layouts/ThemeProvider.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <ThemeProvider>
        <Head title="Log in" />
        <div class="mx-auto max-w-lg">
            <JetAuthenticationCard class="mx-4">
                <template #logo>
                    <JetApplicationLogo class="w-[64px]" />
                </template>

                <JetValidationErrors class="mb-4" />

                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <JetLabel for="email" value="Email" />
                        <JetInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autofocus
                        />
                    </div>

                    <div class="mt-4">
                        <JetLabel for="password" value="Password" />
                        <JetInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <JetCheckbox
                                v-model:checked="form.remember"
                                name="remember"
                            />
                            <span
                                class="ml-2 text-sm text-gray-600 dark:text-gray-300"
                                >Remember me</span
                            >
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100"
                        >
                            Forgot your password?
                        </Link>

                        <Link
                            :href="route('register')"
                            class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100"
                        >
                            Don't have an account?
                        </Link>

                        <JetButton
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </JetButton>
                    </div>
                </form>
            </JetAuthenticationCard>
        </div>
    </ThemeProvider>
</template>
