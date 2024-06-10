<!-- JS -->
<script setup>
/* IMPORTAZIONI */
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

/* PROPS */
defineProps({
    skills: Object,
});

</script>

<!-- HTML -->
<template>

    <!-- TITOLO PAGINA -->

    <Head title="Cestino Skills" />

    <!-- AUTENTICAZIONE -->
    <AuthenticatedLayout>

        <!-- SEZIONE HEADER -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> Cestino Skills</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- BOTTONE TORNA ALL'INDEX -->
                <div class="flex justify-star m-2 p-2">
                    <Link :href="route('skills.index')"
                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-800 text-white rounded-md">
                    Torna Indietro</Link>
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
                                    IMMAGINE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    PROGETTI COLLEGATI
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- CICLO PER RECUPERARE I VALORI DELLE SKILLS -->
                            <tr v-for="skill in skills" :key="skill.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ skill.id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ skill.name }}
                                </td>
                                <td class="px-6 py-4">
                                    <img :src="skill.image" :alt="skill.name">
                                </td>
                                <td class="px-6 py-4">
                                    <!-- ITERO SUI PROGETTI ASSOCIATI ALLA SKILL E SEPARO I NOMI CON LE VIRGOLE ESCLUDENTO L'ULTIMO ELEMENTO -->
                                    <span v-for="(project, index) in skill.projects" :key="project.id">{{ project.name
                                        }} <span v-if="index !== skill.projects.length - 1">, </span></span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                <!-- BOTTONE RIPRISTA ELEMENTO -->
                                    <Link :href="route('skills.restore', skill.id)" method="patch" as="button" type="button" class="mr-2 font-medium text-blue-500 hover:text-blue-700">Ripristina</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>

</template>