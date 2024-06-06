<!-- JS -->
<script setup>
/* IMPORTAZIONI */
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>