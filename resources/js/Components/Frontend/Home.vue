<script setup></script>

<template>
    <section id="home"
        class="lg:h-[85vh] flex items-center bg-light-primary dark:bg-dark-primary py-32 lg:py-0 overflow-hidden">
        <div class="container mx-auto h-full">
            <div class="flex flex-col md:flex-row items-center h-full pt-8 ">
                <div class="flex-1 flex flex-col items-center lg:items-start">
                    <p class="text-lg text-accent text-md mb-[32px]"> Ciao, Sono Marco! 👋</p>
                    <h1
                        class="text-center lg:text-start text-4xl leading-[44px] md:text-5xl md:leading-tight lg:text-7xl lg:leading-[1.2] font-bold md:tracking-[-2px]">
                        Costruisco & progetto <br> Interfacce Web. </h1>
                    <p class="pt-4 pb-8 md:pt-6 md:pb-10 max-w-[480px] text-lg text-center lg:text-left">
                        Mi dedico alla creazione di applicazioni web di eccellenza, costantemente impegnato nel
                        migliorare le mie competenze.
                    </p>
                    <button
                        class="btn btn-md bg-accent hover:bg-light-secondary md:btn-lg transition-all hover:text-light-tail-500 dark:hover:bg-dark-secondary dark:hover:text-dark-navy-100">Contattami
                    </button>
                </div>
                <div class="flex flex-1 justify-end items-center h-full mt-8 md:mt-0">
                    <img class="rounded-lg" src="../../../img/home-image.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
</template>