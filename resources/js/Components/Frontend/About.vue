<script setup>

</script>

<template>

    <!-- SEZIONE CHI SONO -->
    <section id="about" class="section bg-light-secondary dark:bg-dark-secondary">
        <div class="container mx-auto">
            <div class="flex flex-col xl:flex-row gap-24">

                <!-- IMMAGINE -->
                <img src="../../../img/about-image.jpg" alt="Io"
                    class="object-cover h-full w-[556px] md:mx-auto lg:mx-0 rounded-2xl">
                <div class="flex flex-col items-center lg:items-start">

                    <!-- CONTENUTO -->
                    <div class="flex flex-col text-center lg:text-start">
                        <h2 class="text-3xl lg:text-4xl font-medium lg:font-extrabold mb-3">
                            Chi Sono
                        </h2>
                        <p class="mb-4 text-accent">Full-Stack Web Development</p>
                        <hr class="mb-4 opacity-90 dark:opacity-5">
                        <p class="mb-8">
                            Sono uno sviluppatore web con una passione iniziata nel 2022, perfezionata con un corso
                            intensivo di 700 ore presso Boolean. Ho competenze avanzate in JavaScript, SCSS, HTML e
                            Vue.js, oltre a PHP e Laravel per il back-end.<br><br>
                            Ho imparato a usare Inertia e Tailwind in progetti Laravel-Vue.js. Il mio obiettivo è
                            continuare a migliorare e sviluppare applicazioni web di alta qualità, affrontando nuove
                            sfide nel settore.
                        </p>
                    </div>

                    <!-- BOTTONE CONTATTAMI -->
                    <a href="#" class="btn btn-md bg-accent text-light-tail-100">
                        Contattami
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>