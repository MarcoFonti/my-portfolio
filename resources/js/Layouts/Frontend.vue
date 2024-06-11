<script setup>

import Footer from '../Components/Frontend/Footer.vue'

</script>

<template>
    <div class="bg-slate-200 dark:bg-slate-900">

        <!-- MAIN -->
        <main class="min-h-screen">
            <slot />
        </main>
        
        <!-- FOOTER -->
        <Footer></Footer>
    </div>
</template>