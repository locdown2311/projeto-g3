<script setup>
import Calendar from './Calendar.vue';
import { ref, computed } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ModalTarefa from '@/Components/ModalTarefa.vue';
import { usePage, useForm, Link } from '@inertiajs/vue3';

defineProps({ errors: Object })


const form = useForm({
    nome_projeto: null,
    descricao: null,
    categorias: null,
    edital: null,
    data_inicio: null,
    data_fim: null,
})

function submit() {
    form.categorias = selecionados
    form.post('/projetos/store')
    closeModal()
}
const form_busca = useForm({
    busca: null,
})
const selecionados = ref([]);


function pesquisaLike() {
    const url = `/projetos/busca-like/${form_busca.busca}`;
    window.location.href = url
}

const tipos = computed(() => usePage().props.tipo)


const mostraModal = ref(false);
function closeModal() {
    mostraModal.value = false;
}


</script>

<template>
    <div>
        <div class="bg-blue-600 bg-red-600 bg-green-600 bg-indigo-800 bg-indigo-800 bg-pink-600"></div>

        <div
            class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Painel de projetos e pesquisas do professor
            </h1>

            <div class="grid grid-cols-3">
                <div class=" p-4">
                    <Calendar></Calendar>
                </div>
                <div class="p-4">
                    Tabela de cores:
                    <ul>
                        <li v-for="item in tipos" :key="item.id" class="flex items-center space-x-4">
                            <div class="h-4 w-1" :class="item.cor"></div>
                            <span>{{ item.nome }}</span>
                            
                            <Link :href="`/projetos/busca/${encodeURI(item.slug)}`">🔎</Link>

                        </li>
                        <div class="mt-2 relative">
                            <form @submit.prevent="pesquisaLike">
                                <input v-model="form_busca.busca"
                                    class="w-30 h-8 pr-8 pl-3 py-1 rounded-full bg-gray-100 border-2 border-gray-200 text-gray-500"
                                    type="text" placeholder="Buscar pelo professor...">
                            </form>
                            
                        </div>

                    </ul>
                </div>
                <div class="p-4">
                    <PrimaryButton :type="submit" @click="mostraModal = true">Adicionar ao calendário</PrimaryButton>

                    <ModalTarefa :show="mostraModal" @close="closeModal">
                        <template #title>
                            Adicionar projeto
                        </template>

                        <template #content>

                            <div class="mt-4">
                                <form @submit.prevent="submit">
                                    <input type="hidden" value="" />
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">
                                            Nome
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="nome" type="text" placeholder="Esse nome aparecerá no calendário" required
                                            v-model="form.nome_projeto">

                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="descricao">
                                            Descrição
                                        </label>
                                        <textarea
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="descricao" type="text"
                                            placeholder="Explique de forma chamativa o seu projeto" required
                                            v-model="form.descricao"></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">
                                            Tipo
                                        </label>
                                        <div v-for="item in tipos" :key="item.id" class="flex items-center space-x-4">
                                            <div class="h-4 w-1" :class="item.cor"></div>
                                            <input type="checkbox" :id="item.id" :value="item.slug" name="tipo"
                                                v-model="selecionados">
                                            <label :for="item.nome">{{ item.nome }}</label>

                                        </div>
                                    </div>
                                    <!---Envio de arquivo do edital-->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edital">
                                            Edital
                                        </label>
                                        <input type="file" accept="application/pdf" id="edital" name="edital"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            @input="form.edital = $event.target.files[0]" />
                                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                            {{ form.progress.percentage }}%
                                        </progress>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="data_inicio">
                                            Data de início
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="data_inicio" type="date" placeholder="Data de início"
                                            v-model="form.data_inicio">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="data_fim">
                                            Data de término
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="data_fim" type="date" placeholder="Data de término" v-model="form.data_fim">
                                    </div>
                                </form>
                            </div>
                        </template>

                        <template #footer>
                            <PrimaryButton @click="submit" type="submit">
                                Salvar
                            </PrimaryButton>
                            <div class="mr-3"></div>
                            <SecondaryButton @click="closeModal">
                                Cancelar
                            </SecondaryButton>

                        </template>
                    </ModalTarefa>
                </div>
            </div>
        </div>
    </div>
</template>
