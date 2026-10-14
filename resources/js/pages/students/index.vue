<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Students',
        href: '/students',
    },
];

defineProps<{
    students: Array<{
        email: String;
        id: number;
        name: string;
        code: String;
    }>;
}>();

const deleteStudent = (id: number) => {
    if (confirm('¿Estás seguro de que querés eliminar este estudiante?')) {
        router.delete(route('students.destroy', id));
    }
};
</script>

<template>
    <Head title="Students" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">


            <table class="w-full table-fixed">
                <thead>
                    <tr>
                        <th class="w-1/3 text-left">Code</th>
                        <th class="w-1/3 text-left">Name</th>
                        <th class="w-1/3 text-left">Email</th>
                        <th class="w-1/3 text-left">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border">
                    <tr v-for="student in students" :key="student.id">
                        <td class="py-2">{{ student.code }}</td>
                        <td class="py-2">{{ student.name }}</td>
                        <td class="py-2">{{ student.email }}</td>
                        <td class="py-2">
                            <Link
                                :href="route('students.edit', student.id)"
                                class="mr-2 rounded bg-blue-500 px-2 py-1 text-white"
                            >
                                Edit
                            </Link>

                            <button
                                @click="deleteStudent(student.id)"
                                class="rounded bg-red-500 px-2 py-1 text-white"
                            >
                                Delete
                            </button>
                            <Link
                                :href="route('students.show', student.id)"
                                class="ml-2 rounded bg-gray-500 px-2 py-1 text-white"
                            >
                                Info
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        
        </div>

        <Link
            :href="route('students.create')"
            class="fixed bottom-6 right-6 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-3xl font-light text-white shadow-lg transition hover:bg-green-600 hover:shadow-xl"
        >
            +
        </Link>


    </AppLayout>
</template>