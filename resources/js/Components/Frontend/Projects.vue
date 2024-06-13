<script setup>
/* IMPORTAZIONE */
import ProjectCard from './ProjectCard.vue';
import { ref } from 'vue';

/* PROPS */
const props = defineProps({
    skills: Object,
    projects: Object
});

/* VARIBILE REATTIVA PER I PROGETTI FILTRATI */
const filteredProjects = ref(props.projects.data);

/* SELEZIONE SKILL */
const selectedSkill = ref('all')

/* FUNZIONE PER FILTRARE I PROGETTI IN BASE ALL'ID DELLA SKILL */
const filterProjects = (id) => {
    if (id === "all") {
        /* SE ID E' ALL, MOSTRA TUTTI I PROGETTI */
        filteredProjects.value = props.projects.data;

        /* SELEZIONE SKILL */
        selectedSkill.value = id;
    } else {
        /* ALTRIMENTI, FILTRA I PROGETTI IN BASE ALL'ID DELLA SKILL */
        filteredProjects.value = props.projects.data.filter(project => {
            /* VERIFICO CHE NELL'ARRAY DELLE SKILLS DEL PROGETTO CI SIA UNA SKILL CON ID SPECIFICO */
            return project.skills.some(skill => skill.id === id);
        });

        /* SELEZIONE SKILL */
        selectedSkill.value = id;
    }

}

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

        <!-- SEZIONE PROGETTI CARD -->
        <section
            class="grid gap-y-12 lg:grid-cols-4 lg:gap-8 max-h-custom overflow-y-auto custom-scrollbar">
            <ProjectCard v-for="project in filteredProjects" :key="project.id" :project="project" />
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
