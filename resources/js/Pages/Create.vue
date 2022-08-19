<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/components/ValidationErrors.vue";
import JetLabel from "@/components/Label.vue";
import JetInput from "@/components/Input.vue";
import JetButton from "@/components/Button.vue";

const { email } = usePage().props.value.user;

const form = useForm({
    company: "",
    title: "",
    location: "",
    email,
    website: "",
    tags: "",
    description: "",
});

const handleSubmit = () => {
    form.post(route("home.create.a.post"));
};
</script>

<template>
    <AppLayout>
        <div class="w-full max-w-3xl mx-auto px-4">
            <div class="my-4 bg-gray-200 p-4 dark:bg-slate-900">
                <JetValidationErrors />
                <form @submit.prevent="handleSubmit">
                    <div
                        class="flex flex-col sm:flex-row sm:gap-4 sm:items-start"
                    >
                        <div class="sm:w-full">
                            <div>
                                <JetLabel for="name" value="Company Name" />
                                <JetInput
                                    id="name"
                                    v-model="form.company"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                />
                            </div>
                            <div class="mt-4">
                                <JetLabel for="title" value="Title" />
                                <JetInput
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                            </div>
                            <div class="mt-4">
                                <JetLabel for="location" value="Job Location" />
                                <JetInput
                                    id="location"
                                    v-model="form.location"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                            </div>
                            <div class="mt-4">
                                <JetLabel for="email" value="Contact Email" />
                                <JetInput
                                    id="email"
                                    v-model="form.email"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                            </div>
                        </div>
                        <div class="sm:w-full">
                            <div class="mt-4 sm:mt-0">
                                <JetLabel
                                    for="url"
                                    value="Website/Application URL"
                                />
                                <JetInput
                                    id="url"
                                    v-model="form.website"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                            </div>
                            <div class="mt-4">
                                <JetLabel
                                    for="tags"
                                    value="Tags (Comma Separated)"
                                />
                                <JetInput
                                    id="tags"
                                    v-model="form.tags"
                                    placeholder="Example: Laravel, Backend, Postgres, etc"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                            </div>
                            <div class="mt-4">
                                <JetLabel
                                    for="description"
                                    value="Description"
                                />
                                <JetInput
                                    id="description"
                                    v-model="form.description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                    <JetButton class="mt-4">CREATE</JetButton>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
