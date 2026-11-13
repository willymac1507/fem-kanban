<script lang="ts" setup>

import {Board, Subtask, Task} from "@/types/data";
import {ref} from "vue";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger
} from "@/components/ui/dialog";
import EditTaskForm from "@/components/forms/EditTaskForm.vue";
import VerticalElipsisIcon from "@/components/icons/VerticalElipsisIcon.vue";
import {Checkbox} from "@/components/ui/checkbox";
import {router} from "@inertiajs/vue3";

interface Props {
    task: Task
    board: Board
}

const props = defineProps<Props>()

const subtasks = ref(props.task.subtasks)

const open = ref(false);
const editOpen = ref(false);
const viewOpen = ref(false);
const deleteOpen = ref(false);
const viewMenuOpen = ref(false);

function updateSubTask(id: number, isCompleted: boolean) {
    router.patch(('/subtasks/' + id), {
        is_completed: isCompleted
    }, {
        preserveState: true,
        preserveScroll: true,
    })
}

function countSubtasks(task: Task) {
    return task.subtasks.length
}

function countCompleted(task: Task) {
    return task.subtasks.filter((subtask: Subtask) => subtask.is_completed).length
}

function openEdit() {
    viewOpen.value = false;
    viewMenuOpen.value = false;
    editOpen.value = true;
}
</script>

<template>


    <Dialog v-model:open="viewOpen">
        <DialogTrigger>
            <div
                class="w-full bg-dark-gray rounded-lg p-4 flex flex-col gap-2 items-start">
                <h3 class="text-left">{{ task.title }}</h3>
                <p class="font-bold body-md text-medium-gray">
                    {{ countCompleted(task) }} of {{ countSubtasks(task) }}
                    subtasks
                </p>
            </div>
        </DialogTrigger>
        <DialogContent :showCloseButton="false" class="w-120">
            <DialogHeader>
                <DialogTitle class="mb-6">
                    <div class="relative flex flex-row items-center gap-2">
                        <h2>{{
                                task.title
                            }}</h2>
                        <div class="ml-auto w-1.25">
                            <VerticalElipsisIcon
                                class="size-5 cursor-pointer"
                                @click="viewMenuOpen = !viewMenuOpen"/>
                        </div>
                        <div v-if="viewMenuOpen"
                             class="absolute -right-24 top-12 w-48 p-4 bg-vdark-gray rounded-md flex flex-col gap-4 justify-between">
                            <button
                                class="text-left text-sm
                                text-medium-gray" @click="openEdit">Edit
                                Task
                            </button>
                            <button class="text-left text-sm text-red">Delete
                                Task
                            </button>
                        </div>
                    </div>

                </DialogTitle>
                <DialogDescription
                    class="min-h-17 shrink text-body-md leading-6 text-medium-gray">
                    {{
                        task.description
                    }}
                </DialogDescription>
            </DialogHeader>
            <div class="flex flex-col w-full gap-2">
                <div class="text-xs text-white font-bold">Subtasks ({{
                        countCompleted(task)
                    }} of
                    {{ countSubtasks(task) }})
                </div>
                <div v-for="subtask in task.subtasks"
                     class="bg-vdark-gray focus-visible:bg-main-purple/24 flex flex-row gap-4 items-center  rounded-sm p-2"
                >
                    <Checkbox :id="'toggle'+subtask.id"
                              v-model="subtask.is_completed"
                              class="bg-dark-gray border-main-purple/24 data-[state=checked]:border-main-purple data-[state=checked]:bg-main-purple data-[state=checked]:text-white"
                              @update:modelValue="updateSubTask(subtask.id!,
                              subtask.is_completed)"
                    />
                    <p :class="subtask.is_completed ? 'text-medium-gray line-through' :
                    'text-white'"
                       class="text-left text-xs  font-bold">{{
                            subtask.title
                        }}</p>
                </div>
            </div>
        </DialogContent>
    </Dialog>

    <Dialog v-model:open="editOpen">
        <DialogContent class="w-120">
            <DialogHeader>
                <DialogTitle>
                    Edit Task
                </DialogTitle>
            </DialogHeader>
            <EditTaskForm :board="board" :task="task"
                          @taskUpdated="editOpen = false"/>
        </DialogContent>

    </Dialog>

</template>
