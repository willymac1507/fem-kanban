<script lang="ts" setup>
import AppSLayout from '@/layouts/app/AppSidebarLayout.vue'
import {useStore} from "@/../stores/stores";
import {computed, provide} from "vue";
import {usePage} from "@inertiajs/vue3";
import {boardsKey} from "@/types/injection-keys";

interface Props {
    boards: Array<{
        id: number, name: string, columns: Array<{
            id: number,
            title: string, tasks: Array<{
                id: number, title: string,
                subtasks: Array<{
                    id: number,
                    title: string,
                    is_completed: boolean
                }>
            }>
        }>
    }>;
}

const page = usePage();
const props = defineProps<Props>();
const store = useStore();
provide(boardsKey, computed(() => props.boards))
console.log(props.boards)

</script>

<template>
    <AppSLayout>
        <slot/>
    </AppSLayout>
</template>
