<!-- JS -->
<script setup>
/* IMPORTAZIONI */
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

/* PROPS */
defineProps({
    skills: Array
});

/* CAMPI CHE RICEVARA' LA REQUEST */
const form = useForm({
    name: '',
    image: null,
    skill_ids: [],
    project_url: ''
});

/* INVIO MODULO IN POST, CORRISPONDENTE ALLA ROTTA DEFINITA SU WEB.PHP (STORE) */
const submit = () => {
    form.post(route('projects.store'));
};
</script>

<!-- HTML -->
<template>

    <!-- TITOLO PAGINA -->

    <Head title="Crea Projects" />

    <!-- AUTENTICAZIONE -->
    <AuthenticatedLayout>

        <!-- SEZIONE HEADER -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crea Projects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- BOTTONE TORNA ALL'INDEX -->
                <div class="flex justify-star m-2 p-2">
                    <Link :href="route('projects.index')"
                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-800 text-white rounded-md">
                    Torna Indietro</Link>
                </div>

                <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">

                    <!-- FORM -->
                    <form class="p-4" @submit.prevent="submit">

                        <!-- NOME PROGETTO -->
                        <div class="mt-2">
                            <InputLabel for="name" value="Name" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                                autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <!-- URL PROGETTO -->
                        <div class="mt-2">
                            <InputLabel for="project_url" value="URL" />

                            <TextInput id="project_url" type="text" class="mt-1 block w-full" v-model="form.project_url"
                                autocomplete="projecturl" />

                            <InputError class="mt-2" :message="form.errors.project_url" />
                        </div>

                        <!-- CHECKBOX SKILLS -->
                        <div class="block mt-4" v-for="skill in skills" :key="skill.id">
                            <label class="flex items-center">
                                <Checkbox :id="'skill_' + skill.id" :value="skill.id"
                                    v-model:checked="form.skill_ids" />
                                <span class="ms-2 text-sm text-gray-600">{{ skill.name }}</span>
                            </label>
                        </div>
                            <!-- InputError per il checkbox -->
                            <InputError class="mt-2" :message="form.errors['skill_ids']" />


                        <div class="flex items-center justify-end mt-4">

                            <!-- BOTTONE DI SALVATAGGIO DEL PROGETTO CREATO (PASSATA ALLO STORE)-->
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                SALVA PROGETTO CREATO
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>