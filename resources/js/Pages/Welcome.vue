<script setup>
/* IMPORTAZIONE */
import Header from '../Components/Frontend/Header.vue';
import Frontend from '../Layouts/Frontend.vue';
import Home from '../Components/Frontend/Home.vue';
import SectionCtaProject from '../Components/Frontend/SectionCtaProject.vue';
import About from '../Components/Frontend/About.vue';
import Skills from '../Components/Frontend/Skills.vue';
import Portfolio from '../Components/Frontend/Portfolio.vue';
import Certificate from '../Components/Frontend/Certificate.vue';
import ContactMe from '../Components/Frontend/ContactMe.vue';
import { Head, Link } from '@inertiajs/vue3';

/* PROPS */
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },

    skills: Object,
    projects: Object
});
</script>

<template>

    <!-- TITOLO PAGINA -->

    <Head title="Home" />

    <div class="bg-slate-200 dark:bg-slate-900">

        <!-- HEADER -->
        <Header>

            <!-- LINK -->
            <div v-if="canLogin">

                <!-- SE LOGGATO -->
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="block mr-3 py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                Dashboard</Link>

                <!-- SE NON LOGGATO -->
                <template v-else>

                    <!-- LOGIN -->
                    <Link :href="route('login')"
                    class="block py-2 pr-4 pl-3 text-light-tail-500 rounded dark:text-dark-navy-100 hover:text-light-tail-500 dark:hover:text-white">
                    Accedi</Link>

                    <!-- REGISTRAZIONE -->
                    <!-- <Link v-if="canRegister" :href="route('register')"
                    class="block py-2 pr-4 pl-3 text-light-tail-500 rounded dark:text-dark-navy-100">
                    Register</Link> -->

                </template>
            </div>
            
        </Header>
    </div>

    <Frontend>

        <!-- HOME PAGE -->
        <Home />

        <!-- SEZIONE CTA PROGETTI -->
        <SectionCtaProject />

        <!-- CHI SONO -->
        <About />

        <!-- ABILITA' -->
        <Skills :skills="skills" />

        <!-- PORTFOLIO -->
        <Portfolio :projects="projects" :skills="skills" />

        <!-- CERTIFICATO -->
        <Certificate/>
        
        <!-- CONTATTAMI -->
        <ContactMe/>

    </Frontend>
    
</template>
