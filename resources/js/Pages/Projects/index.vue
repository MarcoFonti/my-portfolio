<!-- JS -->
<script setup>
/* IMPORTAZIONI */
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

/* PROPS */
defineProps({
    projects: Object,
})
</script>

<!-- HTML -->
<template>

    <!-- TITOLO PAGINA -->
    <Head title="Projects" />

    <!-- AUTENTICAZIONE -->
    <AuthenticatedLayout>

        <!-- SEZIONE HEADER -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Projects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- BOTTONE CREA PROGETTO -->
                <div class="flex justify-end m-2 p-2">
                    <Link :href="route('projects.create')"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md"> Crea Projects</Link>
                </div>

                <!-- TABELLA -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NOME
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    URL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SKILLS COLLEGATE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- CICLO PER RECUPERARE I VALORI DEI PROJECTS -->
                            <tr v-for="project in projects.data" :key="project.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ project.id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ project.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ project.project_url }}
                                </td>
                                <td class="px-6 py-4">
                                    <!-- ITERO SUI PROGETTI ASSOCIATI ALLA SKILL E SEPARO I NOMI CON LE VIRGOLE ESCLUDENTO L'ULTIMO ELEMENTO -->
                                    <span v-for="(skill, index) in project.skills" :key="skill.id">{{ skill.name }} <span v-if="index !== project.skills.length - 1">, </span></span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <Link :href="route('projects.edit', project.id)" class="font-medium text-blue-500 hover:text-blue-700 mr-2">Edit</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>