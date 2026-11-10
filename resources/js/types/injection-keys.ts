import type {ComputedRef, InjectionKey} from 'vue'

export interface Item {
    id: number
    name: string
    columns: Array<{ id: number, title: string }>
}

export const boardsKey: InjectionKey<ComputedRef<Item[]>> = Symbol('boards')
