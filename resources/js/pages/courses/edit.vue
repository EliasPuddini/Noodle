<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    course: {
        id: number;
        code: string;
        name: string;
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Editar curso',
        href: `/courses/${props.course.id}/edit`,
    },
];

const form = useForm({
    code: props.course.code,
    name: props.course.name,
});

const submit = () => {
    form.put(route('courses.update', props.course.id));
};
</script>

<template>
    <Head title="Editar Curso" />

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
                    Save Changes
                </button>
            </form>

        </div>
    </AppLayout>
</template>