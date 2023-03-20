<template>
    <div>
        <DatePicker v-model="selecionado" mode="date" :attributes="attributes" expanded></DatePicker>
    </div>
</template>

<script setup>
import { DatePicker } from 'v-calendar';
import { reactive, ref } from 'vue';
import { computed } from 'vue';

const selecionado = ref(new Date());

const todos = reactive([
    {
        description: 'Take Noah to basketball practice.',
        isComplete: false,
        dates: [
            new Date(2023, 2, 1), // Jan 1st
            new Date(2023, 2, 10), // Jan 10th
            new Date(2023, 2, 22), // Jan 22nd
        ], // Every Friday
        color: 'red',
    },
]);

const attributes = computed(() => {
    return [
        // Attributes for todos
        ...todos.map(todo => ({
            dates: todo.dates,
            dot: {
                color: todo.color,
                class: todo.isComplete ? 'opacity-75' : '',
            },
            popover: {
                label: todo.description,
            },
            customData: todo,
        })),
    ];
});

</script>