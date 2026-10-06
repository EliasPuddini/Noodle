<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cursos',
        href: '/courses',
    },
];

defineProps<{
    courses: Array<{
        code: String;
        id: number;
        name: string;
    }>;
}>();

const deleteCourse = (id: number) => {
    if (confirm('¿Estás seguro de que querés eliminar este curso?')) {
        router.delete(route('courses.destroy', id));
    }
};
</script>

<template>
    <Head title="Courses" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">


            <table class="w-full table-fixed">
                <thead>
                    <tr>
                        <th class="w-1/3 text-left">Code</th>
                        <th class="w-1/3 text-left">Name</th>
                        <th class="w-1/3 text-left">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border">
                    <tr v-for="course in courses" :key="course.id">
                        <td class="py-2">{{ course.code }}</td>
                        <td class="py-2">{{ course.name }}</td>
                        <td class="py-2">
                            <Link
                                :href="route('courses.edit', course.id)"
                                class="mr-2 rounded bg-blue-500 px-2 py-1 text-white"
                            >
                                Edit
                            </Link>

                            <button
                                @click="deleteCourse(course.id)"
                                class="rounded bg-red-500 px-2 py-1 text-white"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        
        </div>

        <Link
            :href="route('courses.create')"
            class="fixed bottom-6 right-6 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-3xl font-light text-white shadow-lg transition hover:bg-green-600 hover:shadow-xl"
        >
            +
        </Link>


    </AppLayout>
</template>