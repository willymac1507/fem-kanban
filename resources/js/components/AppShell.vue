<script lang="ts" setup>
import {usePage} from '@inertiajs/vue3';
import {SidebarProvider} from '@/components/ui/sidebar';

const isOpen = usePage().props.sidebarOpen;
</script>

<template>
    <SidebarProvider :default-open="isOpen">
        <slot/>
    </SidebarProvider>
</template>
