<script setup></script>

<template>
    <!-- SEZIONE HOME -->
    <section id="home"
        class="lg:h-full flex items-center bg-light-primary dark:bg-dark-primary py-32 lg:py-50 overflow-hidden">
        <div class="container mx-auto h-full" v-motion :initial="{ opacity: 0, y:100, }" :visible="{ opacity: 1, y:0, }">
            <div class="flex lg:flex-row md:flex-col flex-col items-center h-full pt-8 ">

                <!-- CONTENUTO -->
                <div class="flex-1 flex flex-col items-center lg:items-start">
                    <p class="text-lg mt-16 text-accent text-md mb-[32px]"> Ciao, Sono Marco! 👋</p>
                    <h1
                        class="text-center lg:text-start text-4xl leading-[44px] md:text-5xl md:leading-tight lg:text-7xl lg:leading-[1.2] font-bold md:tracking-[-2px]">
                        Costruisco & progetto <br> Interfacce Web. </h1>
                    <p class="pt-4 pb-8 md:pt-6 md:pb-10 max-w-[480px] text-lg text-center lg:text-left">
                        Mi dedico alla creazione di applicazioni web di eccellenza, costantemente impegnato nel
                        migliorare le mie competenze.
                    </p>

                    <!-- BOTTONE CONTATTAMI -->
                    <a href="#contact"
                        class="btn btn-md bg-accent hover:bg-light-secondary md:btn-lg transition-all hover:text-light-tail-500 dark:hover:bg-dark-secondary dark:hover:text-dark-navy-100">Contattami
                    </a>
                    <div class="pt-12">
                        <h5 class="text-lg flex justify-center lg:justify-start items-center text-black dark:text-white mb-4">
                            Seguimi su
                        </h5>

                        <!-- ICONE SOCIAL -->
                        <div class="flex items-center mb-6">
                            <a href="https://github.com/MarcoFonti" target="_blank"
                                class="w-12 h-12 rounded-full flex items-center justify-center border border-white text-black dark:text-white hover:bg-light-secondary hover:border-light-secondary dark:hover:bg-dark-secondary dark:hover:border-dark-secondary mr-3 sm:mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"
                                    class="w-6 h-6">
                                    <path
                                        d="M12 0C5.373 0 0 5.373 0 12c0 5.303 3.438 9.8 8.205 11.387.6.11.82-.26.82-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.334-1.757-1.334-1.757-1.09-.745.083-.729.083-.729 1.205.084 1.84 1.237 1.84 1.237 1.07 1.834 2.809 1.305 3.495.997.107-.775.418-1.305.76-1.605-2.665-.305-5.467-1.332-5.467-5.93 0-1.31.467-2.382 1.236-3.22-.124-.304-.535-1.527.117-3.176 0 0 1.01-.324 3.3 1.23.957-.266 1.983-.398 3.004-.403 1.02.005 2.047.137 3.006.403 2.287-1.554 3.295-1.23 3.295-1.23.653 1.65.242 2.873.118 3.176.77.838 1.234 1.91 1.234 3.22 0 4.61-2.807 5.62-5.48 5.918.43.37.823 1.102.823 2.222v3.293c0 .32.217.694.825.575C20.565 21.795 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/in/marcofonti99/" target="_blank"
                                class="w-12 h-12 rounded-full flex items-center justify-center border border-white text-black dark:text-white hover:bg-light-secondary hover:border-light-secondary dark:hover:bg-dark-secondary dark:hover:border-dark-secondary mr-3 sm:mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="#FFFFFF"
                                        d="M20.615 0H3.385C1.516 0 0 1.515 0 3.385v17.23C0 22.485 1.515 24 3.385 24h17.23C22.484 24 24 22.485 24 20.615V3.385C24 1.515 22.485 0 20.615 0zM7.231 19.231H3.846v-9.23h3.385v9.23zm-1.693-10.615a1.538 1.538 0 1 1 0-3.077 1.538 1.538 0 0 1 0 3.077zM19.231 19.231h-3.385v-4.846c0-1.154-.023-2.645-1.692-2.645-1.692 0-1.954 1.32-1.954 2.692v4.8h-3.385v-9.23h3.308v1.436h.046c.462-.877 1.593-1.8 3.268-1.8 3.499 0 4.142 2.3 4.142 5.3v6.293z" />
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/marco.fonti.5" target="_blank"
                                class="w-12 h-12 rounded-full flex items-center justify-center border border-white text-black dark:text-white hover:bg-light-secondary hover:border-light-secondary dark:hover:bg-dark-secondary dark:hover:border-dark-secondary mr-3 sm:mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"
                                    class="w-6 h-6">
                                    <path
                                        d="M9.197 21V12H6v-3.197h3.197V5.823C9.197 2.829 11.106 1 13.791 1c1.146 0 2.131.085 2.416.123v2.8l-1.658.001c-1.3 0-1.553.619-1.553 1.528v2.001H16l-.487 3.197h-2.823V21h-3.493z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                
                <!-- IMMAGINE LOGO PRIMARIO -->
                <div class="flex flex-1 justify-end items-center h-full mt-8 md:mt-8">
                    <img class="rounded-lg" src="../../../img/home-image.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
</template>