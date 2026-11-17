<script lang="ts" setup>
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import {Toaster} from '@/components/ui/sonner';
import type {BreadcrumbItem} from '@/types';
import {useStore} from "@/../stores/stores";
import AddTask from "@/components/AddTask.vue";
import {computed} from "vue";
import {SidebarProvider} from "@/components/ui/sidebar";
import AppLogo from "@/components/AppLogo.vue";
import {Link} from "@inertiajs/vue3";
import {dashboard} from "@/routes";

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const store = useStore();
const sidebarState = computed(() => store.sidebarState === 'expanded');
</script>

<template>
    <AppShell variant="sidebar">
        <div
            class="w-full bg-sidebar h-25 flex flex-row items-center">
            <div
                :class="!sidebarState ? 'border-b border-lines' : ''"
                class="w-75 pl-10 h-full flex flex-row items-center border-r border-lines">
                <Link :href="dashboard()">
                    <AppLogo/>
                </Link>
            </div>
            <div
                class="border-b border-lines h-full flex flex-row grow items-center justify-between px-4">
                <h1>
                    {{ store.activeBoard }}
                </h1>
                <AddTask/>
            </div>
        </div>
        <SidebarProvider :default-open="true"
                         class="relative min-h-(--desktop-sidebar-height)">
            <AppSidebar/>
            <AppContent class="min-w-0 overflow-x-clip">
                <slot/>
            </AppContent>
        </SidebarProvider>
        <Toaster/>
    </AppShell>
</template>
