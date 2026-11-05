import {defineStore} from 'pinia'

export const useStore = defineStore('store', {
    state: () => {
        return {
            activeBoard: 'No Boards',
            boards: [] as Board[],
        }
    }
})

interface Board {
    id: number;
    name: string;
}
