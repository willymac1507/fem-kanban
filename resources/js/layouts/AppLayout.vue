<script lang="ts" setup>
import AppSLayout from '@/layouts/app/AppSidebarLayout.vue'
import {useStore} from "@/../stores/stores";
import {computed, provide} from "vue";
import {usePage} from "@inertiajs/vue3";
import {boardsKey} from "@/types/injection-keys";
import {Board} from "@/types/data";

interface Props {
    boards: Board[]
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
