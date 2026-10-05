<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cursos',
        href: '/courses',
    },
];

defineProps<{
    courses: Array<{
        id: number;
        name: string;
    }>;
}>();
</script>

<template>
    <Head title="Cursos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1 class="text-2xl font-bold">
                Cursos
            </h1>

            <div
                v-for="course in courses"
                :key="course.id"
                class="rounded-xl border p-4"
            >
                {{ course.name }}
            </div>
        </div>
    </AppLayout>
</template>