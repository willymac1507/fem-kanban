<script lang="ts" setup>
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import OptionalInput from "./OptionalInput.vue";
import {ref} from "vue";
import {Form, useForm} from "@inertiajs/vue3";
import CrossIcon from "@/components/icons/CrossIcon.vue";

const columns = ref([
    1
]);
const columnCounter = ref(1);

const emit = defineEmits(['success'])
const form = useForm({
    name: '',
    columns: [],
})

const submit = () => {
    form.post('/dashboard', {
        onSuccess: () => {
            console.log('success')
            emit('success')
        }
    })
}

function addColumn() {
    columnCounter.value++;
    columns.value.push(columnCounter.value);
}

function deleteColumn(id: number) {
    if (columns.value.length === 1) return;
    columns.value = columns.value.filter((column) => column !== id);
}


</script>

<template>
    <form class="flex flex-col gap-3"
          @submit.prevent="submit">
        <div class="flex flex-col gap-3 mb-6">
            <Label class="" for="boardName">Board
                Name</Label>
            <Input id="boardName" v-model="form.name"
                   placeholder="e.g. Web Design" type="text"/>
            <p v-if="form.errors.name" class="text-xs text-red">{{
                    form
                        .errors.name
                }}</p>
        </div>

        <div class="mb-6">
            <Label for="addColumn">Board Columns</Label>
            <div class="flex flex-col gap-3">
                <div v-for="(column, index) in columns" :key="index"
                     class="flex flex-row w-full gap-3 justify-start items-center">
                    <OptionalInput :id="column"
                                   v-model="form.columns[index]"
                                   name="columns[]"
                                   placeholder="e.g. Todo"
                    />
                    <button v-if="columns.length > 1" class="cursor-pointer"
                            type="button"
                            @click="deleteColumn(index)">
                        <component :is="CrossIcon"/>
                    </button>
                </div>
                <p v-if="form.errors.columns" class="text-xs text-red">
                    {{ form.errors.columns }}
                </p>

                <button
                    class="w-full h-10 bg-white text-main-purple font-bold text-xs rounded-full"
                    type="button"
                    @click="addColumn">
                    + Add New Column
                </button>
            </div>
        </div>
        <button
            class="w-full h-10 bg-main-purple text-white text-xs font-bold rounded-full"
            type="submit">
            Create New Board
        </button>
    </form>
</template>
