<script setup>

/* PROPS */
defineProps({
    skills: Object
})
</script>

<template>

    <!-- SEZIONE SKILLS -->
    <section class="bg-light-tail-100 dark:bg-dark-navy-500 py-16">
        <div class="container mx-auto">
            <div class="flex flex-wrap gap-4 justify-center">
                <!-- RECUPERO SINGOLA SKILL -->
                <div class="flex items-center justify-center" v-for="skill in skills.data" :key="skill.id">
                    <span class="border border-accent px-4 py-2 rounded-full mb-2">{{ skill.name }}</span>
                </div>
            </div>
        </div>
    </section>
</template>
