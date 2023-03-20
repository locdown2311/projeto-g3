<script setup>
import Calendar from './Calendar.vue';
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ModalTarefa from '@/Components/ModalTarefa.vue';


const search = ref('');

const mostraModal = ref(false);
function closeModal() {
    mostraModal.value = false;
}

async function pesquisar() {
    await axios.get('/api/projetos', {
        params: {
            search: search.value
        }
    }).then(response => {
        console.log(response.data);
    });
}

</script>

<template>
    <div>
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
                        <li class="flex items-center space-x-4">
                            <div class="h-4 w-1 bg-red-500"></div>
                            <span>Item 1</span>
                        </li>
                        <li class="flex items-center space-x-4">
                            <div class="h-4 w-1 bg-green-500"></div>
                            <span>Item 2</span>
                        </li>
                        <li class="flex items-center space-x-4">
                            <div class="h-4 w-1 bg-blue-500"></div>
                            <span>Item 3</span>
                        </li>
                        <div class="mt-2 relative">
                            <input @input="pesquisar" v-model="search"
                                class="w-30 h-8 pr-8 pl-3 py-1 rounded-full bg-gray-100 border-2 border-gray-200 text-gray-500"
                                type="text" placeholder="Buscar...">
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
                                <form>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">
                                            Nome
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="nome" type="text" placeholder="Nome" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="descricao">
                                            Descrição
                                        </label>
                                        <textarea
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="descricao" type="text" placeholder="Descrição" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">
                                            Tipo
                                        </label>
                                        <input type="checkbox" class="bg-blue-500"> Pesquisa
                                        <input type="checkbox" class="bg-red-600"> Projeto
                                    </div>
                                    <!---Envio de arquivo do edital-->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edital">
                                            Edital
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="edital" type="file" placeholder="Edital">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="data_inicio">
                                            Data de início
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="data_inicio" type="date" placeholder="Data de início">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="data_fim">
                                            Data de término
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="data_fim" type="date" placeholder="Data de término">
                                    </div>
                                </form>
                            </div>
                        </template>

                        <template #footer>
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
