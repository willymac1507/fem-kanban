<script lang="ts" setup>
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import {ref} from "vue";
import BoardIcon from '@/components/icons/BoardIcon.vue';
import NewBoardForm from "./NewBoardForm.vue";


interface Props {
    open: boolean;
}

const props = defineProps<Props>();
const open = ref(false);
</script>

<template>
    <Dialog v-model:open="open">
        <DialogTrigger
            class="text-main-purple peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 pl-10.5 text-left outline-hidden ring-sidebar-ring transition-[width,height,padding] focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground data-[state=open]:hover:bg-sidebar-accent data-[state=open]:hover:text-sidebar-accent-foreground  [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground h-12 cursor-pointer">
            <component :is="BoardIcon"></component>
            <span>+ Create New Board</span>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Add New Board</DialogTitle>
            </DialogHeader>
            <NewBoardForm @success="open = false"/>
        </DialogContent>
    </Dialog>
</template>

