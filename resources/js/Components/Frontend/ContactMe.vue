<script setup>
/* IMPORTAZIONE */
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

/* VARIABILE REATTIVA PER MOSTRARE IL MESSAGGIO DI SUCCESSO */
const showMessage = ref(false)

/* CAMPI DEL FORM */
const form = useForm({
    name: "",
    email: "",
    body: ""
});

/* FUNZIONE CHE IMPOSTA IL VALORE DEL MESSAGGIO DI SUCCESSO */
function setShowMessage(value) {
    showMessage.value = value;
}

/* FUNZIONE PER RESETTARE IL FORM E MOSTRARE I,L MESSAGGIO DI SUCCESSO */
function cleanForm() {
    form.reset() // Resetto il form
    setShowMessage(true) // Mostra il messaggio di successo
    setTimeout(() => {
        setShowMessage(false) // Nasconde il messaggio di successo dopo 3 secondi
    }, 3000);
}

/* FUNZIONE PER GESTIRE L'INVIO DEL FORM */
const submit = () => {
    /* Invia i dati del form alla rotta 'contact' */
    form.post(route('contact'), {
        preserveScroll: true, // Mantiene la posizione dello scroll
        onSuccess: () => cleanForm() // Chiama cleanForm() in caso di successo
    })
}
</script>

<template>

    <!-- SEZIONE CONTATTAMI -->
    <section class="section bg-light-primary dark:bg-dark-primary">
        <div class="container mx-auto">
            <div class="flex flex-col items-center text-center">
                <h2 class="section-title">Contattami</h2>
                <p class="subtitle">
                    Compilando i campi e inviando il modulo, potrai contattarmi direttamente. Ti risponderò il prima
                    possibile per fornirti tutte le informazioni di cui hai bisogno. Grazie per il tuo interesse!
                </p>
            </div>
            <div class="flex flex-col lg:flex-row lg:gap-x-8">
                <div class="flex flex-1 flex-col items-start space-y-8 mb-12 lg:mb-0 lg:pt-2">

                    <!-- DOMANDE E EMAIL -->
                    <div class="flex flex-col lg:flex-row gap-x-4">
                        <div class="text-accent w-14 flex items-start justify-center mt-2 mb-4 lg:mb-0 text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-body text-xl mb-1">Hai delle domande?</h4>
                            <p class="mb-1 text-paragraph">Sono qui per aiutarti.</p>
                            <p class="text-accent font-normal">Mandami una Email a marcofonti05@gmail.com</p>
                        </div>
                    </div>

                    <!-- INDIRIZZO -->
                    <div class="flex flex-col lg:flex-row gap-x-4">
                        <div class="text-accent w-14 flex items-start justify-center mt-2 mb-4 lg:mb-0 text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-body text-xl mb-1">Posizione Attuale</h4>
                            <p class="mb-1 text-paragraph">Bologna, Italia.</p>
                            <p class="text-accent font-normal">Via Canaletta n.13, Chiavica.</p>
                        </div>
                    </div>
                </div>

                <!-- FORM -->
                <form @submit.prevent="submit" class="space-y-8 w-full max-w-md">

                    <!-- Mostra il messaggio di successo se showMessage è true -->
                    <div v-if="showMessage" class="m-2 p-4 bg-green-900 text-light-secondary rounded-lg">Messaggio
                        inviato con successo.</div>
                    <div class="flex gap-8">
                        <div>
                            <!-- Campo input per il nome -->
                            <input v-model="form.name" type="text" class="input" placeholder="Nome">
                            <span v-if="form.errors.name" class="text-sm m-2 text-red-400">{{ form.errors.name }}</span>
                        </div>
                        <div>

                            <!-- Campo input per l'email -->
                            <input v-model="form.email" type="email" class="input" placeholder="Email">
                            <span v-if="form.errors.email" class="text-sm m-2 text-red-400">{{ form.errors.email
                                }}</span>
                        </div>
                    </div>

                    <!-- Campo textarea per il messaggio -->
                    <textarea v-model="form.body" class="textarea" placeholder="Scrivi Messaggio"
                        spellcheck="false"></textarea>
                    <span v-if="form.errors.body" class="text-sm m-2 text-red-400">{{ form.errors.body }}</span>

                    <!-- BOTTONE INVIA MESSAGGIO -->
                    <button class="btn btn-lg bg-accent hover:bg-dark-secondary text-white">
                        Invia Messaggio
                    </button>
                </form>
            </div>
        </div>
    </section>
</template>