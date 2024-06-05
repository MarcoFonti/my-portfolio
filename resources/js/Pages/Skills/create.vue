<!-- JS -->
<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


const form = useForm({
    name: '',
    image: null
});

const submit = () => {
    form.post(route('skills.store'));
};
</script>

<!-- HTML -->
<template>
    <!-- TITOLO -->

    <Head title="Crea Skills" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crea Skills</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-star m-2 p-2">
                    <Link :href="route('skills.index')"
                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-800 text-white rounded-md">
                    Torna Indietro</Link>
                </div>
                <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">
                    <!-- FORM -->
                    <form class="p-4" @submit.prevent="submit">
                        <!-- NOME SKILL -->
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                                autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <!-- IMMAGINE SKILL -->
                        <div class="mt-2">
                            <InputLabel for="image" value="Image" />

                            <TextInput id="image" type="file" class="mt-1 block w-full"
                                @input="form.image = $event.target.files[0]" />

                            <InputError class="mt-2" :message="form.errors.image" />
                        </div>


                        <div class="flex items-center justify-end mt-4">

                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Store
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>