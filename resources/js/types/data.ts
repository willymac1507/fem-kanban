export type Board = {
    id: number;
    name: string;
    columns: [
        board_id: number,
        title: string,
        tasks: [
            {
                id: number,
                board_id: number,
                title: string,
                description: string,
                status: string
                subtasks: [
                    {
                        id: number,
                        task_id: number,
                        title: string,
                        is_completed: boolean
                    }
                ]
            }
        ]
    ]
}

export type Task = {
    id: number;
    board_id: number;
    title: string;
    description: string;
    status: string;
}

export type Subtask = {
    id: number;
    task_id: number;
    title: string;
    is_completed: boolean;
}
