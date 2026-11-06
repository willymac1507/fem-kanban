<script lang="ts" setup>
import {Head} from '@inertiajs/vue3';
import {dashboard} from '@/routes';
import {computed, ComputedRef, inject} from "vue";
import {useStore} from "../../stores/stores";
import {Board, Column, Subtask, Task} from "@/types/data";

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


function setColor(taskColumn: Column): string {
    console.log(taskColumn)
    let color
    let subtasks = taskColumn.tasks.map(countSubtasks)
    let completed = taskColumn.tasks.map(countCompleted)
    if (sumArray(completed) === 0) {
        color = 'bg-red-500'
    } else if (sumArray(subtasks) === sumArray(completed)) {
        color = 'bg-green-500'
    } else {
        color = 'bg-yellow-500'
    }

    return color
}

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
        class="flex h-full flex-1 flex-row gap-4 overflow-x-auto p-4"
    >
        <div v-for="column in board.columns" class="flex flex-col gap-4 w-70">
            <div class="flex flex-row justify-start gap-2 items-center">
                <span :class="setColor(column)" class="w-3 h-3 rounded-full"></span>
                <h4 class="text-medium-gray uppercase">{{ column.title }} ({{ column.tasks.length }})</h4>
            </div>
            <h4 v-for="task in column.tasks">{{ task.title }}</h4>
        </div>
    </div>
</template>
