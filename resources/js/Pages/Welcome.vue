<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import Calendar from '../Components/Calendar.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { computed } from 'vue';
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const tipos = computed(() => usePage().props.tipo)

</script>

<template>
    <Head title="Calendário Unificado" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen w-screen bg-dots-darker bg-center dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="border-double border-4 border-indigo-600 rounded-md p-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="border-double border-4 border-indigo-600 rounded-md p-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Entrar</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="border-double border-4 border-indigo-600 rounded-md p-2 ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Registrar</Link>
            </template>
        </div>

        <div
            class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <ApplicationLogo></ApplicationLogo>
            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Quadro de projetos e pesquisas
            </h1>
            <div class="grid grid-cols-2">
                <div class=" p-4">
                    <Calendar></Calendar>
                </div>
                <div class="p-4">
                    Tabela de cores:
                    <div class="grid grid-cols-2">
                        <ul>
                            <li v-for="item in tipos" :key="item.id" class="flex items-center space-x-4">
                                <div class="h-4 w-1" :class="item.cor"></div>
                                <span>{{ item.nome }}</span>
                            </li>

                            <div class="mt-2 relative">
                                <input
                                    class="w-full h-8 pr-8 pl-3 py-1 rounded-full bg-gray-100 border-2 border-gray-200 text-gray-500"
                                    type="text" placeholder="Buscar...">
                                <div class="absolute top-0 right-0 h-full w-8 flex items-center justify-center">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="search w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M14.408 14.408a1 1 0 1 1-1.414 1.414l-2.461-2.461a5.5 5.5 0 1 1 1.414-1.414l2.461 2.461zM6.5 10a3.5 3.5 0 1 0 7 0 3.5 3.5 0 0 0-7 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}</style>
