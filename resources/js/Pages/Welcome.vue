<script setup>
/* IMPORTAZIONE */
import Header from '../Components/Frontend/Header.vue';
import Frontend from '../Layouts/Frontend.vue';
import Home from '../Components/Frontend/Home.vue';
import SectionCtaProject from '../Components/Frontend/SectionCtaProject.vue';
import About from '../Components/Frontend/About.vue';
import { Head, Link } from '@inertiajs/vue3';

/* PROPS */
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
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
                        class="py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                    Accedi</Link>

                    <!-- REGISTRAZIONE -->
                    <!-- <Link v-if="canRegister" :href="route('register')"
                    class="py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                    Register</Link> -->

                </template>
            </div>
        </Header>
    </div>

    <Frontend>
        <!-- HOME PAGE -->
        <Home/>

        <!-- SEZIONE CTA PROGETTI -->
        <SectionCtaProject/>

        <!-- CHI SONO -->
        <About/>
    </Frontend>

</template>
