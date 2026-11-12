<script lang="ts" setup>

import {Board} from "@/types/data";
import ColumnTask from "./ColumnTask.vue";

interface Props {
    board: Board
}

defineProps<Props>()

</script>

<template>
    <div v-for="column in board.columns" class="flex flex-col gap-4 w-70">
        <div class="flex flex-row justify-start gap-2 items-center">
                <span :class="'bg-bullet-' + column.color"
                      class="w-3 h-3 rounded-full"></span>
            <h4 class="text-medium-gray uppercase">{{ column.title }}
                ({{ column.tasks.length }})</h4>
        </div>
        <ColumnTask v-for="task in column.tasks" :key="task.id" :board="board"
                    :task="task"/>
    </div>
</template>
