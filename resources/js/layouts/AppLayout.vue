<script lang="ts" setup>
import AppSLayout from '@/layouts/app/AppSidebarLayout.vue'

import {provide} from 'vue';

interface Props {
    boards: Array<{ id: number, name: string }>;
}

const props = defineProps<Props>();

provide('boards', props.boards);

</script>

<template>
    <AppSLayout>
        <slot/>
    </AppSLayout>
</template>
