<script lang="ts" setup>
import {Input} from "@/components/ui/input";

interface Props {
    placeholder: string
    id: number
    name: string
}

const data = defineModel<string>();

defineProps<Props>();
</script>

<template>
    <Input :id="'addColumn'+id" v-model="data"
           :name="name"
           :placeholder="placeholder"
           class="grow" type="text"/>

</template>
