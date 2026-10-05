<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Crear curso',
        href: '/courses/create',
    },
];

const form = useForm({
    code: '',
    name: '',
});

const submit = () => {
    form.post(route('courses.store'));
};
</script>

<template>
    <Head title="Crear curso" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <form
                @submit.prevent="submit"
                class="flex flex-col gap-4 rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border"
            >
                <div class="flex flex-col gap-2">
                    <label
                        for="code"
                        class="text-sm font-medium text-neutral-700 dark:text-neutral-300"
                    >
                        Code
                    </label>

                    <input
                        v-model="form.code"
                        type="text"
                        id="code"
                        class="rounded border border-sidebar-border/70 bg-transparent px-3 py-2 text-sm text-neutral-900 dark:border-sidebar-border dark:text-neutral-100"
                        required
                    />

                    <label
                        for="name"
                        class="text-sm font-medium text-neutral-700 dark:text-neutral-300"
                    >
                        Name
                    </label>

                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="rounded border border-sidebar-border/70 bg-transparent px-3 py-2 text-sm text-neutral-900 dark:border-sidebar-border dark:text-neutral-100"
                        required
                    />
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="self-start rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 disabled:opacity-50"
                >
                    Create Course
                </button>
            </form>

        </div>
    </AppLayout>
</template>