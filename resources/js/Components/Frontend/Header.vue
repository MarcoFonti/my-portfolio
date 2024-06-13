<script setup>
/* IMPORTAZIONE */
import { ref, onMounted } from 'vue';

// NAVBAR HAMBURGER
const showingNavigationDropdown = ref(false);

/* VARIABILE CHE GESTISCE LO STATO DELLO SCROLLING */
const scrollBg = ref(false)

/* ARRAY DI OGGETTI DELLA NAVBAR */
const navigations = [
    {name: 'Home', href: '#home'},
    {name: 'Chi sono', href: '#about'},
    {name: 'Progetti', href: '#portfolio'},
    {name: 'Contattami', href: '#contact'},

];

/* FUNZIONE PER IMPOSTARE LO STATO DI SCROLLBG */
const setScrollBg = (value) => {
    scrollBg.value = value;
}

/* METODO DA ESEGUIRE SOLO UNA VOLTA CHE IL COMPONENTE E STATO MONTANTO NEL DOM */
onMounted(() => {

    // Aggiunge un event listener per l'evento di scroll sulla finestra
    window.addEventListener("scroll", () =>{

        // Se lo scroll è maggiore di 50px, imposta scrollBg a true, altrimenti a false
        return window.scrollY > 50 ? setScrollBg(true) : setScrollBg(false);
    })
})

</script>

<template>

    <!-- COLORE DELLA NAVABAR IN BASE A SCROLLBG -->
    <nav class="w-full fixed z-20 border-gray-200 px-2 sm:px-4 rounded" :class="{'bg-light-primary dark:bg-dark-primary' : scrollBg, 'bg-white dark:bg-slate-800' : !scrollBg}">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../../../img/logo-primary.png" class="w-44" alt="Logo" />
            </a>

            <!-- TOGGLE PER LA NAVBAR HAMBURGER -->
            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <!-- NAVBAR STANDARD -->
            <div class="w-full md:block md:w-auto" id="navbar-default" :class="{ hidden: showingNavigationDropdown }">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-light-tail-500 dark:border-y-dark-navy-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                    
                    <!-- LINK NAVIGAZIONE -->
                    <li v-for="(navigation, index) in navigations" :key="index">
                        <a :href="navigation.href"
                            class="block py-2 pr-4 pl-3 text-light-tail-500 rounded dark:text-dark-navy-100 hover:text-light-tail-500 dark:hover:text-white"
                            aria-current="page">{{ navigation.name }}</a>
                    </li>
                    

                    <!-- LOGIN E (REGISTRAZIONE) -->
                    <li>
                        <slot />
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>