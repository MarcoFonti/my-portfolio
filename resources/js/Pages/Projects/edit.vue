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
import { Inertia } from '@inertiajs/inertia'

/* PROPS */
const props = defineProps({
    skills: Array,
    project: Object
});

/* CAMPI CHE RICEVARA' LA REQUEST */
const form = useForm({
    name: props.project?.name,
    project_url: props.project?.project_url,
    skill_ids: props.project?.skill_ids,
});

/* INVIO UNA RICHIESTA HTTP POST AL URL, USO 'METHOD' PER INDICARE CHE LA RICHIESTA DEVE ESSERE TRATTATA COME 'PUT' */
const submit = () => {
    Inertia.post(`/projects/${props.project.id}`, {
        _method: 'put',

        /* INVIO NUOVI VALORI */
        name: form.name,
        project_url: form.project_url,
        skill_ids: form.skill_ids,
    })
};

</script>

<!-- HTML -->
<template>

    <!-- TITOLO PAGINA -->

    <Head title="Modifica Progetto" />

    <!-- AUTENTICAZIONE -->
    <AuthenticatedLayout>

        <!-- SEZIONE HEADER -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifica Skills</h2>
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

                            <InputError class="mt-2" :message="$page.props.errors.name" />
                        </div>

                        <!-- URL PROGETTO -->
                        <div class="mt-2">
                            <InputLabel for="project_url" value="URL" />

                            <TextInput id="project_url" type="text" class="mt-1 block w-full" v-model="form.project_url"
                                autocomplete="projecturl" />

                            <InputError class="mt-2" :message="$page.props.errors.project_url" />
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
                        <InputError class="mt-2" :message="$page.props.errors['skill_ids']" />

                        <div class="flex items-center justify-end mt-4">

                            <!-- BOTTONE DI SALVATAGGIO DELLA SKILL MODIFICATA (PASSATA UPDATE) -->
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                SALVA MODIFICHE
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>