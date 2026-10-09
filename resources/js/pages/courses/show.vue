<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const modalAbierto = ref(false);

const props = defineProps<{
    course: {
        id: number;
        code: string;
        name: string;
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: `${props.course.name} ${props.course.code}`,
        href: `/courses/${props.course.id}/edit`,
    },
];

const form = useForm({
    code: props.course.code,
    name: props.course.name,
});

</script>

<template>
    <Head title="{{ props.course.name }} {{ props.course.code }}" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <H1>Students</H1>

            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td>{{ student.code }}</td>
                        <td>{{ student.name }}</td>
                    </tr>
                </tbody>


            </table>

            <Button
                type="button"
                @click="modalAbierto = true"
                class="fixed bottom-6 right-6 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-3xl font-light text-white shadow-lg transition hover:bg-green-600 hover:shadow-xl"
                >
                +
            </Button>

            <!--Modal para añadir alumnos-->

            <div
                v-if="modalAbierto"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                @click.self="modalAbierto = false"
            >
                <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl dark:bg-neutral-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-xl font-semibold">Añadir Alumnos</h3>

                        <button
                            type="button"
                            @click="modalAbierto = false"
                            class="rounded px-3 py-1 text-neutral-500 hover:bg-neutral-100 dark:hover:bg-neutral-800"
                        >
                            Cerrar
                        </button>
                    </div>

                    <form
                        @submit.prevent="form.post(route('courses.addStudent', props.course.id), {
                            onSuccess: () => {
                                modalAbierto = false;
                                form.reset();
                            }
                        })"
                        class="flex flex-col gap-4"
                    >
                        <div class="flex flex-col gap-2">
                            <label for="code">Código del alumno</label>

                            <input
                                id="code"
                                v-model="form.code"
                                type="text"
                                name="code"
                                required
                                class="rounded border border-neutral-300 bg-transparent px-3 py-2 dark:border-neutral-700"
                            />
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="self-start rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 disabled:opacity-50"
                        >
                            {{ form.processing ? 'Agregando...' : 'Agregar alumno' }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </AppLayout>
</template>