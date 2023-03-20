<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <Link :href="'/'">
        <ApplicationLogo></ApplicationLogo>
    </Link>
</template>
