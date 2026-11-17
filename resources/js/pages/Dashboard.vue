<script lang="ts" setup>
import {Head} from '@inertiajs/vue3';
import {dashboard} from '@/routes';
import {computed, ComputedRef, inject, useAttrs} from "vue";
import {useStore} from "../../stores/stores";
import {Subtask, Task} from "@/types/data";
import {boardsKey} from "@/types/injection-keys";
import BoardColumn from "../components/BoardColumn.vue";
import ShowSidebarIcon from "@/components/icons/ShowSidebarIcon.vue";
import {useSidebar} from "@/components/ui/sidebar";

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
const {toggleSidebar} = useSidebar();
const boards = inject(boardsKey, computed(() => []))
const store = useStore();
const attrs = useAttrs();
const board: ComputedRef = computed(() => {
    return boards.value!.filter(board => board.name === store.activeBoard)[0];
})

const sidebarState = computed(() => {
    return store.sidebarState === 'expanded'
});

function countSubtasks(task: Task) {
    return task.subtasks.length
}

function countCompleted(task: any) {
    return task.subtasks.filter((subtask: Subtask) => subtask.is_completed).length
}

function sumArray(arr: Array<number>) {
    return arr.reduce((a, b) => a + b, 0)
}


</script>

<template>
    <Head title="Dashboard"/>

    <div
        class="relative bg-background flex h-full flex-1 flex-row gap-4 overflow-x-auto p-4 pl-6"
    >
        <BoardColumn :board="board" v-bind="attrs"/>

    </div>
    <button v-if="!sidebarState"
            class="transition-all transition-discrete flex items-center h-12 rounded-r-full bg-main-purple text-heading-m font-bold text-white absolute bottom-10 left-0 pl-4 pr-6"
            @click="toggleSidebar">
        <ShowSidebarIcon/>
    </button>
</template>
