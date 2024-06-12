<script setup>
/* IMPORTAZIONE */
import ProjectCard from './ProjectCard.vue';

/* PROPS */
defineProps({
    skills: Object,
    projects: Object
});
</script>

<template>
    <div class="container mx-auto">

        <!-- NAVBAR DELLE SKILL -->
        <nav class="mb-12 border-b-2 border-light-tail-100 dark:text-dark-navy-100">
            <ul class="flex flex-col lg:flex-row justify-evenly items-center">
                <li class="cursor-pointer capitalize mx-2 my-2">
                    <button
                        class="flex text-center px-4 py-2 hover:text-light-tail-500 dark:text-dark-navy-100">Tutti</button>
                </li>
                <li class="cursor-pointer capitalize mx-2 my-2" v-for="projectSkill in skills.data"
                    :key="projectSkill.id">
                    <button class="flex text-center py-2 hover:text-light-tail-500 dark:text-dark-navy-100">{{
                        projectSkill.name }}</button>
                </li>
            </ul>
        </nav>

        <!-- SEZIONE PROGETTI CARD -->
        <section class="grid gap-y-12 lg:grid-cols-3 lg:gap-8">
            <ProjectCard v-for="project in projects.data" :key="project.id" :project="project" />
        </section>
    </div>
</template>
