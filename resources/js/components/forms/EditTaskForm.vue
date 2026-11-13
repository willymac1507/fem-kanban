<script lang="ts" setup>
import {useForm} from "@inertiajs/vue3";
import {Label} from "@/components/ui/label";
import {Textarea} from "@/components/ui/textarea";
import {Input} from "@/components/ui/input";
import CrossIcon from "@/components/icons/CrossIcon.vue";
import OptionalInput from "@/components/forms/OptionalInput.vue";
import {computed, ref} from "vue";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/components/ui/select";
import {Board, Task} from "@/types/data";
import {useStore} from "../../../stores/stores";

interface Props {
    board: Board
    task: Task
}

interface Status {
    index: number,
    status: string
}

class SubTask {
    id?: number;
    task_id: number;
    title: string;
    is_completed: boolean = false;

    constructor(task_id: number, title: string) {
        this.task_id = task_id;
        this.title = title;
    }
}

const emit = defineEmits(['taskUpdated'])

const props = defineProps<Props>()
const store = useStore()
const activeBoard = ref(store.activeBoard)
const thisBoard: Board = props.board

const form = useForm({
    column_id: props.task.column_id,
    title: props.task.title,
    description: props.task.description,
    status: props.task.status,
    subTasks: props.task.subtasks,
})

const status = computed({
    get: () => form.status,
    set: (value: { index: number, status: string }) => {
        form.status = value.status;
        form.column_id = value.index;
    }
})

const subTasks = ref(props.task.subtasks.map((subTask, index) => index + 1));
const subTaskCounter = ref(subTasks.value.length);

function addSubTask() {
    // subTaskCounter.value++;
    // subTasks.value.push(subTaskCounter.value);
    form.subTasks.push(new SubTask(props.task.id, ''));
}

function deleteSubTask(id: number) {
    subTasks.value = subTasks.value.filter((subTask, index) => index !== id);
    form.subTasks.splice(id, 1);
}

function submit() {
    console.log(props.task.id)
    form.post('/boards/tasks/' + props.task.id + '/update', {
        onSuccess: () => {
            form.reset()
            emit('taskUpdated')
        }
    })
}

function getSubtaskError(index: number): string | undefined {
    if (form.errors[`subTasks.${index}.title`]) {
        return 'The title field is required.'
    }

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
                <div v-for="(subTask, index) in form.subTasks" :key="index"
                     class="flex flex-col w-full gap-2 justify-start items-start">
                    <div
                        class="flex flex-row w-full gap-3 justify-start items-center">
                        <OptionalInput
                            :id="index"
                            v-model="form.subTasks[index].title"
                            name="subTasks[]"
                            placeholder="e.g. Make Coffee"
                        />
                        <button v-if="form.subTasks.length > 1"
                                class="cursor-pointer"
                                type="button" @click="deleteSubTask(index)">
                            <component :is="CrossIcon"></component>
                        </button>
                    </div
                    >
                    <p v-if="getSubtaskError(index)"
                       class="text-xs text-red">{{
                            getSubtaskError(index)
                        }}</p>
                </div>

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
                Save Task
            </button>
        </div>

    </form>
</template>

<style scoped>

</style>
