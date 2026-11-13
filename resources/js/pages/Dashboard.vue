<script lang="ts" setup>
import {Head} from '@inertiajs/vue3';
import {dashboard} from '@/routes';
import {computed, ComputedRef, inject} from "vue";
import {useStore} from "../../stores/stores";
import {Subtask, Task} from "@/types/data";
import {boardsKey} from "@/types/injection-keys";
import BoardColumn from "./BoardColumn.vue";

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

const boards = inject(boardsKey, computed(() => []))
const store = useStore();
const board: ComputedRef = computed(() => {
    return boards.value!.filter(board => board.name === store.activeBoard)[0];
})

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
        class="bg-vdark-gray flex h-full flex-1 flex-row gap-4 overflow-x-auto p-4"
    >
        <BoardColumn :board="board"/>
    </div>
</template>
