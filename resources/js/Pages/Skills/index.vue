<!-- JS -->
<script setup>
/* IMPORTAZIONI */
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';


/* PROPS */
const props = defineProps({
    skills: Object,
})

/* VARIABILE DI STATO PER LA RICERCA */
const searchQuery = ref('');

// COMPUTED PROPERTY PER FILTRARE LE SKILL IN BASE AL NOME
const filteredSkills = computed(() => {

    // Se la barra di ricerca è vuota, restituisci tutte le skills
    if (!searchQuery.value) {
        return props.skills.data;
    }

     // Filtra le skills in base al valore della barra di ricerca
    return props.skills.data.filter(skill =>
        skill.name.toLowerCase().includes(searchQuery.value.toLowerCase()) // Confronta il nome della skill convertito in minuscolo con il valore della barra di ricerca anch'esso convertito in minuscolo
    );
});
</script>

<!-- HTML -->
<template>

    <!-- TITOLO PAGINA -->

    <Head title="Abiltà" />

    <!-- AUTENTICAZIONE -->
    <AuthenticatedLayout>

        <!-- SEZIONE HEADER -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Abilità</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5">


                        <div class="flex justify-end mb-4">


                            <!-- BOTTONE CREA SKILL -->
                            <Link :href="route('skills.create')"
                                class="mr-2 px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-md">
                            Crea
                            Abilità
                            </Link>

                            <!-- BOTTONE CESTINO ELEMENTO -->
                            <Link :href="route('skills.trash')"
                                class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded-md">
                            Vedi Cestino</Link>

                        </div>

                        <!-- CAMPO DI RICERCA -->
                        <div class="mb-4">
                            <input type="text" v-model="searchQuery" placeholder="Cerca Abilità..."
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-600">
                        </div>

                        <!-- TABELLA -->
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            NOME
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            PROGETTI CORRELATI
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-end">
                                            AZIONI
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- CICLO PER RECUPERARE I VALORI DELLE SKILLS -->
                                    <tr v-for="skill in filteredSkills" :key="skill.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ skill.id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ skill.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- Controllo se ci sono progetti associati alla skill -->
                                            <span v-if="skill.projects.length > 0">
                                                <!-- Itero sui progetti associati alla skill e separo i nomi con le virgole escludendo l'ultimo elemento -->
                                                <span v-for="(project, index) in skill.projects" :key="project.id">
                                                    {{ project.name }}
                                                    <span v-if="index !== skill.projects.length - 1">, </span>
                                                </span>
                                            </span>
                                            <!-- Se non ci sono progetti, mostro "Nessuno" -->
                                            <span v-else>
                                                -
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right flex flex-col">

                                            <!-- BOTTONE MODIFICA ELEMENTO -->
                                            <Link :href="route('skills.edit', skill.id)"
                                                class="font-medium text-blue-500 hover:text-blue-700 mb-2">Modifica
                                            </Link>

                                            <!-- BOTTONE CESTINA ELEMENTO -->
                                            <Link :href="route('skills.destroy', skill.id)" method="delete" as="button"
                                                type="button" class="font-medium text-red-500 hover:text-red-700">
                                            Cestina
                                            </Link>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
