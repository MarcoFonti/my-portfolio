<script setup>
/* IMPORTAZIONE */
import ProjectCard from './ProjectCard.vue';
import { ref, computed } from 'vue';

/* PROPS */
const props = defineProps({
    skills: Object,
    projects: Object
});

/* VARIBILE REATTIVA PER I PROGETTI */
const filteredProjects = ref(props.projects.data);

/* VARIABILE REATTIVA PER LA SELEZIONE DELLA SKILL */
const selectedSkill = ref('all');

/* VARIABILE REATTIVA PER IL CAMPO DI RICERCA */
const searchQuery = ref('');

// FUNZIONE PER FILTRARE I PROGETTI IN BASE ALL'ID DELLA SKILL
const filterProjects = (id) => {
    if (id === "all") {
        // MOSTRA TUTTI I PROGETTI 
        filteredProjects.value = props.projects.data;
    } else {
        // FILTRA I PROGETTI IN BASE ALL'ID DELLA SKILL
        filteredProjects.value = props.projects.data.filter(project =>
            project.skills.some(skill => skill.id === id)
        );
    }
    // AGGIORNA LA SELEZIONE IN BASE ALLA SKILL
    selectedSkill.value = id;
}

// FUNZIONE PER FILTRARE I PROGETTI IN BASE AL NOME
const filteredProjectsSearch = computed(() => {
    if (!searchQuery.value) {

        /* SE VUOTA RESTITUISCI I PROGETTI */
        return props.projects.data;
    }

    /* FILTRO I PROGETTI IN BASE AL NOME */
    return props.projects.data.filter(project =>
        project.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

// FUNZIONE PER COMBINARE I DUE FILTRI
const filteredProjectsList = computed(() => {
    
    /* FILTRO I PROGETTI IN BASE ALLA SKILL SELEZIONATA */
    const filteredBySkill = selectedSkill.value === 'all' 
    ? filteredProjects.value  // Se selectedSkill.value è 'all', mostro tutti i progetti
    : filteredProjects.value.filter(project =>
        project.skills.some(skill => skill.id === selectedSkill.value)
    ); // Altrimenti, filtro i progetti per trovare quelli che contengono la skill selezionata


    /* FILTRO I PROGETTI IN BASE AL NOME NELLA SEARCHBAR */
    const filteredByName = filteredBySkill.filter(project =>
        project.name.toLowerCase().includes(searchQuery.value.toLowerCase()) // Filtra i progetti che contengono il testo di searchQuery nel nome, ignorando maiuscole/minuscole
    );

    /* RESTITUISCO L'ARRAY DEI PROGETTI FILTRATI PER SKILL E NOME */
    return filteredByName;
});

</script>

<template>
    <div class="container mx-auto">

        <!-- NAVBAR DELLE SKILL -->
        <nav class="mb-12 border-b-2 border-light-tail-100 dark:text-dark-navy-100">
            <ul class="flex flex-col lg:flex-row justify-evenly items-center">
                <li class="cursor-pointer capitalize mx-2 my-2">
                    <!-- BOTTONE PER TUUTI I PROGETTI CHE RICHIAMA LA FUNZIONE PASSANDO COME PARAMETRO 'ALL' -->
                    <button @click="filterProjects('all')"
                        class="flex text-center px-4 py-2 hover:text-light-tail-500 dark:text-dark-navy-100"
                        :class="{ 'active': selectedSkill === 'all' }">Tutti</button>
                </li>
                <li class="cursor-pointer capitalize mx-2 my-2" v-for="projectSkill in skills.data"
                    :key="projectSkill.id">
                    <!-- BOTTONE CHE MOSTRA I PROGETTI FILTRATI PASSANDO COME PARAMENTRO ID DELLA SKILL -->
                    <button @click="filterProjects(projectSkill.id)"
                        class="flex text-center py-2 hover:text-light-tail-500 dark:text-dark-navy-100"
                        :class="{ 'active': selectedSkill === projectSkill.id }">
                        {{ projectSkill.name }}
                    </button>
                </li>
            </ul>
        </nav>

        <!-- CAMPO DI RICERCA -->
            <div class="mb-4">
                <input type="text" v-model="searchQuery" placeholder="Cerca Progetto..."
                    class="px-4 w-full py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-950">
            </div>
        <!-- SEZIONE PROGETTI CARD -->
        <section
            class="grid gap-y-12 lg:grid-cols-4 lg:gap-8 max-h-custom overflow-y-auto custom-scrollbar">
            <!-- RICHIAMO LA FUNZIONE DOVE HO UNITO I DUE FILTRI -->
            <ProjectCard v-for="project in filteredProjectsList" :key="project.id" :project="project" />
        </section>


    </div>
</template>

<style>
/* styles.css */

.custom-scrollbar {
    scrollbar-width: thin;
    /* Per i browser che supportano la personalizzazione della scrollbar */
    scrollbar-color: #07567D #FDFAF6;
    padding: 10px;
    /* thumb color, track color */
}

/* Per i browser basati su WebKit */
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #FDFAF6;
    /* track color */
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: #07567D;
    /* thumb color */
    border-radius: 10px;
    /* opzionale */
    border: 2px solid #FDFAF6;
    /* opzionale, crea uno spazio intorno al thumb */
}
</style>
