<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from '@/Components/Card.vue';
import { onMounted, ref, defineProps } from 'vue';
import { getColor } from '@/composable/api';
import PrimaryButton from '@/Components/PrimaryButton.vue';


const parsePageId = (path) => path.substring(path.lastIndexOf('/') + 1)

const pageId = parsePageId(window.location.pathname)

const dados = ref([])
onMounted(async () => {
    const response = await getColor(pageId);
    dados.value = response.data;
});


defineProps({ busca: Object })

</script>

<template>
    <AppLayout title="Busca">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Busca {{ busca }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-8 text-2xl">
                            Resultados da busca
                        </div>
                        <div class="mt-6 text-gray-500">
                            <Card v-for="item in busca.projetos" :key="item.id" class="mb-2">
                                <template #title>
                                    <ul class="flex inline">
                                        <li v-for="(valor, chave) in busca.catcores" :key="chave">
                                            <div class="h-4 w-4 border rounded-full" :class="valor"></div>
                                        </li>
                                    </ul>
                                </template>

                                <template #content>
                                    <p>Nome: {{ item.nome_projeto }}</p>
                                    <p>ℹDescrição: {{ item.descricao }}</p>
                                    <p>👨‍🔬Orientado por: {{ item.professor }}</p>
                                    <a class="btn btn-xs sm:btn-sm md:btn-md lg:btn-md" :href ="`mailto:${item.contato}?subject=Interesse no projeto ${item.nome_projeto}&body=Caro ${item.professor} vi esse projeto no G3 e...`">Enviar email</a>
                                    <div class="mt-4"></div>
                                    <p>📅Data de inicio: {{ item.data_inicio }}</p>
                                    <p>📅Data de fim: {{ item.data_fim }}</p>
                                    <a :href="`/download/${item.user_id}/${item.uuid}`">⏬Download do edital</a>
                                </template>
                            </Card>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
