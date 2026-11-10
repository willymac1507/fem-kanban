<script lang="ts" setup>
import {Head} from '@inertiajs/vue3';
import {dashboard} from '@/routes';
import {computed, ComputedRef, inject} from "vue";
import {useStore} from "../../stores/stores";
import {Subtask, Task} from "@/types/data";
import {boardsKey} from "@/types/injection-keys";

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
        class="flex h-full flex-1 flex-row gap-4 overflow-x-auto p-4"
    >
        <div v-for="column in board.columns" class="flex flex-col gap-4 w-70">
            <div class="flex flex-row justify-start gap-2 items-center">
                <span :class="'bg-bullet-' + column.color"
                      class="w-3 h-3 rounded-full"></span>
                <h4 class="text-medium-gray uppercase">{{ column.title }}
                    ({{ column.tasks.length }})</h4>
            </div>
            <div v-for="task in column.tasks"
                 class="w-full bg-dark-gray rounded-lg p-4 flex flex-col gap-2">
                <h3>{{ task.title }}</h3>
                <p class="font-bold body-md text-medium-gray">
                    {{ countCompleted(task) }} of {{ countSubtasks(task) }}
                    subtasks
                </p>
            </div>
        </div>
    </div>
</template>
