<script lang="ts" setup>
import {useForm} from "@inertiajs/vue3";
import {Label} from "@/components/ui/label";
import {Textarea} from "@/components/ui/textarea";
import {Input} from "@/components/ui/input";
import CrossIcon from "@/components/icons/CrossIcon.vue";
import OptionalInput from "@/components/OptionalInput.vue";
import {computed, ComputedRef, ref} from "vue";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/components/ui/select";
import {Board} from "@/types/data";
import {useStore} from "../../stores/stores";

interface Props {
    boards: Board[]
}

interface Status {
    index: number,
    status: string
}

const emit = defineEmits(['taskCreated'])

const props = defineProps<Props>()
const store = useStore()
const activeBoard = ref(store.activeBoard)
const thisBoard: ComputedRef<Board | undefined> = computed(() => {
    return props.boards.find(board => board.name === activeBoard.value)
})

const form = useForm({
    column_id: 0,
    title: '',
    description: '',
    status: '',
    subTasks: []
})

const status = computed({
    get: () => form.status,
    set: (value: { index: number, status: string }) => {
        form.status = value.status;
        form.column_id = value.index;
    }
})

const subTasks = ref([1]);
const subTaskCounter = ref(1);

function addSubTask() {
    subTaskCounter.value++;
    subTasks.value.push(subTaskCounter.value);
}

function deleteSubTask(id: number) {
    subTasks.value = subTasks.value.filter((subTask, index) => index !== id);
    form.subTasks.splice(id, 1);
}

function submit() {
    form.post('/boards/tasks/store', {
        onSuccess: () => {
            form.reset()
            emit('taskCreated')
        }
    })
}
</script>

<template>
    <form class="w-full flex flex-col gap-5" @submit.prevent="submit">
        <div class="mt-2">
            <Label class="" for="title">Title</Label>
            <Input id="title" v-model="form.title"
                   placeholder="e.g. Take coffee break" type="text"/>
            <p v-if="form.errors.title" class="text-xs text-red">{{
                    form
                        .errors.title
                }}</p>
        </div>
        <div>
            <Label for="description">Description</Label>
            <Textarea id="description" v-model="form.description"
                      placeholder="e.g. It is always good to take a break. This 15 minute break will recharge the batteries a little."
                      rows="5"/>
            <p v-if="form.errors.description" class="text-xs text-red">{{
                    form
                        .errors.description
                }}</p>
        </div>
        <div>
            <Label for="subtasks">Subtasks</Label>
            <div class="flex flex-col w-full gap-3">
                <div v-for="(subTask, index) in subTasks" :key="index"
                     class="flex flex-row w-full gap-3 justify-start items-center">
                    <OptionalInput
                        :id="subTask"
                        v-model="form.subTasks[index]"
                        name="subTasks[]"
                        placeholder="e.g. Make Coffee"
                    />
                    <button v-if="subTasks.length > 1" class="cursor-pointer"
                            type="button" @click="deleteSubTask(index)">
                        <component :is="CrossIcon"></component>
                    </button>
                </div>
                <p v-if="form.errors.subTasks" class="text-xs text-red">{{
                        form
                            .errors.subTasks
                    }}</p>
                <button
                    class="w-full h-10 bg-white text-main-purple font-bold text-xs rounded-full"
                    type="button"
                    @click="addSubTask()">
                    + Add New Subtask
                </button>
            </div>
        </div>
        <div>
            <Label for="status">Status</Label>
            <Select v-model="status"
                    class="">
                <SelectTrigger
                    class="w-full bg-vdark-gray border-medium-gray text-xs font-bold ">
                    <SelectValue asChild>
                        <span>{{ form.status ? form.status : '' }}</span>
                    </SelectValue>
                </SelectTrigger>
                <SelectContent :avoidCollisions="false" align="end"
                               class="w-full bg-vdark-gray border-medium-gray">
                    <SelectGroup>
                        <SelectItem v-for="(column, index) in
                        thisBoard?.columns ?? []"
                                    :key="index"
                                    :value="{'index': column.id, 'status':
                                    column.title}"
                                    class="text-xs font-bold">
                            {{ column.title }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
            <p v-if="form.errors.status" class="text-xs text-red">{{
                    form
                        .errors.status
                }}</p>
            <p v-if="form.errors.column_id" class="text-xs text-red">{{
                    form
                        .errors.column_id
                }}</p>
        </div>
        <div>
            <button
                class="w-full h-10 bg-main-purple text-white font-bold text-xs rounded-full"
                type="submit"
            >
                Create Task
            </button>
        </div>

    </form>
</template>

<style scoped>

</style>
