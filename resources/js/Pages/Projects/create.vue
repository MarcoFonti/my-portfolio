<!-- JS -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<!-- HTML -->
<template>
    <!-- TITOLO -->
<Head title="Crea Projects" />

<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crea Projects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-star m-2 p-2">
                    <Link :href="route('projects.index')" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-800 text-white rounded-md"> Torna Indietro</Link>
                </div>
                <div>
                FORM
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>