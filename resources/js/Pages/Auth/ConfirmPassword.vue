<script setup>
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetApplicationLogo from "@/Components/ApplicationLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetLabel from "@/Components/Label.vue";
import JetValidationErrors from "@/Components/ValidationErrors.vue";

const form = useForm({
    password: "",
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Head title="Secure Area" />

    <div class="mx-auto max-w-lg">
        <JetAuthenticationCard class="mx-4">
            <template #logo>
                <JetApplicationLogo class="w-[64px]" />
            </template>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-200">
                This is a secure area of the application. Please confirm your
                password before continuing.
            </div>

            <JetValidationErrors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <JetLabel for="password" value="Password" />
                    <JetInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                        autofocus
                    />
                </div>

                <div class="flex justify-end mt-4">
                    <JetButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Confirm
                    </JetButton>
                </div>
            </form>
        </JetAuthenticationCard>
    </div>
</template>
