export type Board = {
    id: number;
    name: string;
    columns: Column[]
}

export type Column = {
    id: number;
    board_id: number;
    title: string;
    color: number;
    tasks: Task[];
}

export type Task = {
    id: number;
    column_id: number;
    title: string;
    description: string;
    status: string;
    subtasks: Subtask[];
}

export type Subtask = {
    id?: number;
    task_id: number;
    title: string;
    is_completed: boolean;
}
