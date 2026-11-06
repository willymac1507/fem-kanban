import {defineStore} from 'pinia'

export const useStore = defineStore('store', {
    state: () => {
        return {
            activeBoard: 'No Boards',
            boardsCount: 0,
        }
    }
})
