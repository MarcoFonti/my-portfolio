<script setup>
/* IMPORTAZIONE */
import { Link } from '@inertiajs/inertia-vue3';

/* PROPS */
defineProps({
    project: Object
});
</script>

<template>
    <!-- CARD PROGETTI -->
    <Link :href="project.project_url" class="group flex flex-col items-center text-center cursor-pointer">

    <!-- IMMAGINE PROGETTO -->
    <div class="mb-6">
        <img class="rounded-2xl h-56" src="" :alt="project.name">
    </div>

    <!-- USO IL METODO MAP PER CREARE UN NUVO ARRAY ESTRAENDO IL NOME DELLLA SKILL E UNISCO GLI ELEMENTI IN UNA SOLA STRINGA SEPARANDOLI CON LA ',' -->
    <div class="group-hover:text-light-tail-500 capitalize text-accent text-sm mb-3">
        {{ project.skills.map(skill => skill.name).join(', ') }}
    </div>

    <!-- TITILO PROGETTO -->
    <h3 class="group-hover:text-light-tail-500 text-2xl font-semibold capitalize mb-3">{{ project.name }}</h3>
    </Link>
</template>
