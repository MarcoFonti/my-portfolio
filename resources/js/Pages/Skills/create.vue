<!-- JS -->
<script setup>
/* IMPORTAZIONI */
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

/* PROPS */
defineProps({
    projects: Array,
});

/* CAMPI CHE RICEVARA' LA REQUEST */
const form = useForm({
    name: '',
    project_ids: [],
});

/* INVIO MODULO IN POST, CORRISPONDENTE ALLA ROTTA DEFINITA SU WEB.PHP (STORE) */
const submit = () => {
    form.post(route('skills.store'));
};
</script>

<!-- HTML -->
<template>

    <!-- TITOLO PAGINA -->
    <Head title="Crea Abilità" />

    <!-- AUTENTICAZIONE -->
    <AuthenticatedLayout>

        <!-- SEZIONE HEADER -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crea Abilità</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white py-6 shadow-sm sm:rounded-lg">

                    <!-- FORM -->
                    <form class="p-4" @submit.prevent="submit">

                        <!-- SELECT MULTIPLA PROGETTI -->
                        <div>
                            <InputLabel for="project_id" value="PROGETTI" />
                            <select v-model="form.project_ids" id="project_id" name="project_ids" multiple
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option v-for="project in projects" :key="project.id" :value="project.id">{{
                                    project.name }}
                                </option>
                            </select>
                        </div>
                        <!-- InputError per la selezione multipla dei progetti -->
                        <InputError v-if="form.errors['project_ids']" class="mt-2" :message="form.errors['project_ids']" />

                        <!-- NOME SKILL -->
                        <div class="mt-3">
                            <InputLabel for="name" value="NOME"/>

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                                autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="flex items-center justify-end mt-8">

                            <!-- BOTTONE DI SALVATAGGIO DELLA SKILL CREATA (PASSATA ALLO STORE) -->
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                SALVA
                            </PrimaryButton>
                        </div>
                    </form>
                </div>

                <!-- BOTTONE TORNA ALL'INDEX -->
                <div class="flex justify-star m-2 p-2">
                    <Link :href="route('skills.index')"
                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-800 text-white rounded-md">
                    Torna Indietro</Link>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
    
</template>