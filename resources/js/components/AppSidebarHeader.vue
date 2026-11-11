<script lang="ts" setup>
import type {BreadcrumbItem} from '@/types';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItem[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header
        class="bg-sidebar flex h-25 shrink-0 items-center gap-2 border-b border-lines px-6 transition-[width,height] ease-linear md:px-4"
    >
        <slot/>
    </header>
</template>
