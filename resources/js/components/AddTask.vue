<script lang="ts" setup>
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import {computed, inject, ref} from "vue";
import NewTaskForm from "@/components/NewTaskForm.vue";
import {boardsKey} from "@/types/injection-keys";

const boards = inject(boardsKey, computed(() => []));


const open = ref(false);
</script>

<template>
    <Dialog v-model:open="open">
        <DialogTrigger
            class="bg-main-purple text-sm px-4 rounded-full font-bold h-12">
            + Create New Task
        </DialogTrigger>
        <DialogContent class="w-120">
            <DialogHeader>
                <DialogTitle>Add New Task</DialogTitle>
            </DialogHeader>
            <NewTaskForm :boards="boards" @taskCreated="open = false"/>
        </DialogContent>
    </Dialog>
</template>

