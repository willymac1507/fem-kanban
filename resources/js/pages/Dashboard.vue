<script lang="ts" setup>
import {Head} from '@inertiajs/vue3';
import {dashboard} from '@/routes';
import {computed, ComputedRef, inject} from "vue";
import {useStore} from "../../stores/stores";
import {Board} from "@/types/data";

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const boards: Array<Board> | undefined = inject('boards') ? inject('boards') : new Array<Board>();
const store = useStore();
const board: ComputedRef = computed(() => {
    return boards!.filter(board => board.name === store.activeBoard)[0];
})

</script>

<template>
    <Head title="Dashboard"/>

    <div
        class="flex h-full flex-1 flex-row gap-4 overflow-x-auto p-4"
    >
        <div v-for="column in board.columns" class="flex flex-col gap-4 w-70">
            <h4 class="text-medium-gray uppercase">{{ column.title }} ({{ column.tasks.length }})</h4>
            <h4 v-for="task in column.tasks">{{ task.title }}</h4>
        </div>
    </div>
</template>
