<script lang="ts" setup>
import AppSLayout from '@/layouts/app/AppSidebarLayout.vue'
import {useStore} from "@/../stores/stores";

interface Props {
    boards: Array<{ id: number, name: string }>;
}

const props = defineProps<Props>();
const store = useStore();
store.boards = props.boards;

</script>

<template>
    <AppSLayout>
        <slot/>
    </AppSLayout>
</template>
