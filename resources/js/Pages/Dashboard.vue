<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import moment from 'moment-timezone';


const props = defineProps({
    messages: Object,
    projects: Object,
    skills: Object
});

const formatDate = (date) => {
    return moment.tz(date, "Europe/Rome").format('HH:mm:ss');
};


</script>

<template>
    <!-- Titolo della pagina -->

    <Head title="Dashboard" />

    <!-- Layout autenticato -->
    <AuthenticatedLayout>
        <!-- Intestazione -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <!-- Contenuto -->
        <div class="py-12">
            <!-- Presentazione del database -->
            <div class="mb-6 text-center">
                <h2 class="text-xl font-semibold text-gray-900">Panoramica del Database</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Questo database contiene informazioni sui messaggi ricevuti, i progetti completati e le abilità
                    acquisite.
                </p>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Messaggi -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900">Messaggi</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                Totale Messaggi: <strong class="text-lg"> {{ messages.length }} </strong>
                            </p>
                        </div>
                    </div>
                    <!-- Abilità -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 ">Abilità</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                Totale Abilità: <strong class="text-lg"> {{ skills.length }} </strong>
                            </p>
                        </div>
                    </div>
                    <!-- Progetti -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900">Progetti</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                Totale Progetti: <strong class="text-lg"> {{ projects.length }} </strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5">
                        <!-- Tabella dei messaggi -->
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ID</th>
                                    <th scope="col" class="px-6 py-3">Nome</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Messaggio</th>
                                    <th scope="col" class="px-6 py-3">Arrivato</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="message in messages" :key="message.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ message.id }}
                                    </td>
                                    <td class="px-6 py-4">{{ message.name }}</td>
                                    <td class="px-6 py-4">{{ message.email }}</td>
                                    <td class="px-6 py-4">{{ message.body }}</td>
                                    <td class="px-6 py-4"> {{ formatDate(message.created_at) }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
