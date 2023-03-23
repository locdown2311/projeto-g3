<template>
    <DatePicker v-model="selecionado" :attributes="attributes" mode="date" :rules="rules">
        <template #day-popover>
            <div class="my-custom-popover">
                <div class="my-custom-popover-header"></div>
                <div class="my-custom-popover-content">
                    <!-- Pegar a posicao do dia atual e associar com os dados de todos-->
                    <div v-for="(todo, index) in todos">
                        
                        <div v-if="comparaDatas(todo.dates[index], selecionado) ">

                            <div>{{ todo.description }}</div>
                            <div>{{ todo.orientador }}</div>
                            <div>
                                <Link  href="/projetos/busca-id/3">🔎</Link>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DatePicker>
</template>


<script setup>
import { DatePicker } from 'v-calendar';
import { ref, computed, watch} from 'vue';
import { Link } from '@inertiajs/vue3';

const rules = ref({
    hours: 0,
    minutes: 0,
    seconds: 0,
    milliseconds: 0,
});
const selecionado = ref(new Date())

const selecaoAtual = computed(() => selecionado.value);


watch(selecionado, () => {
    console.log('A seleção foi alterada:', selecionado.value);
});
function comparaDatas(data1, data2) {
    const nData1 = new Date(data1)
    const nData2 = new Date(data2)

    return nData1.getTime() === nData2.getTime();
}


// Fazer uma constante ser computed


const todos = ref([

    {
        description: 'Projeto Podcast',
        orientador: 'Prof. Fred',
        dates: [
            new Date(2023, 2, 25),
        ],
        color: 'blue',
    },
    {
        description: 'Projeto Teste',
        orientador: 'Prof. Fred',
        dates: [
            new Date(2023, 2, 25),
        ],
        color: 'red',
    },
    {
        description: 'Projeto Teste',
        orientador: 'Prof. Fred',
        dates: [
            new Date(2023, 2, 24),
        ],
        color: 'green',
    },



]);

const attributes = computed(() => [
    // Attributes for todos
    ...todos.value.map(todo => ({
        dates: todo.dates,
        dot: {
            color: todo.color,
            class: todo.isComplete ? 'opacity-75' : '',
        },
        // We need to at least pass a truthy value for the popover to appear
        // Pass an object to customize popover settings like visibility, placement, etc.
        popover: true,
        customData: todo,
    })),
]);

</script>


<style scoped>
.my-custom-popover {
    background-color: white;
    border: 1px solid gray;
    border-radius: 5px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    color: black;
    padding: 10px;
    max-width: 300px;
}

.my-custom-popover-header {
    font-weight: bold;
    margin-bottom: 5px;
}

.my-custom-popover-content {
    font-size: 14px;
    line-height: 1.5;
}
</style>