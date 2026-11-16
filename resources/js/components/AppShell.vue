<script lang="ts" setup>
import {usePage} from '@inertiajs/vue3';

const isOpen = usePage().props.sidebarOpen;
</script>

<template>

    <slot/>

</template>
