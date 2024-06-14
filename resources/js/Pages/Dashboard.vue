<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


const props = defineProps({
    messages: Object
});


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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ message.id }}</td>
                                    <td class="px-6 py-4">{{ message.name }}</td>
                                    <td class="px-6 py-4">{{ message.email }}</td>
                                    <td class="px-6 py-4">{{ message.body }}</td>
                                    <td class="px-6 py-4">{{ message.created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

