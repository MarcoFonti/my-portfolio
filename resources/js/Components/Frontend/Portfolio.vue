<script setup>

/* IMPORTAZIONE */
import Projects from './Projects.vue'


/* PROPS */
defineProps({
    skills: Object,
    projects: Object
});
</script>

<template>

    <!-- SEZIONE PORTFOLIO -->
    <section id="portfolio" class="section bg-light-primary dark:bg-dark-primary min-h-[1400px]">
        <div class="container mx-auto">
            <div class="flex flex-col items-center text-center">
                <h2 class="section-title">I miei progetti</h2>
                <p class="subtitle">Questa è la sezione dove verranno presentati i miei progetti. Qui potrete trovare
                    una raccolta dei miei lavori, ognuno dei quali riflette la mia passione e il mio impegno. Spero che
                    vi piaccia esplorare le mie creazioni tanto quanto mi è piaciuto realizzarle.</p>
            </div>
        </div>

        <!-- PROGETTI -->
        <Projects :skills="skills" :projects="projects" />
    </section>
</template>