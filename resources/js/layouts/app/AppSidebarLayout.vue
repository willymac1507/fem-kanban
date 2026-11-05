<script lang="ts" setup>
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import {Toaster} from '@/components/ui/sonner';
import type {BreadcrumbItem} from '@/types';
import {useStore} from "@/../stores/stores";

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const store = useStore();
</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar/>
        <AppContent class="min-w-0 overflow-x-clip">
            <AppSidebarHeader :breadcrumbs="breadcrumbs">{{ store.activeBoard }}</AppSidebarHeader>
            <slot/>
        </AppContent>
        <Toaster/>
    </AppShell>
</template>
