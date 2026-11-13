class SubTask {
    id?: number;
    title: string;
    is_completed: boolean = false;

    constructor(title: string) {
        this.title = title;
    }
}

export default SubTask;
