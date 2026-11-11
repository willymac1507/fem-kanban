import type {ComputedRef, InjectionKey} from 'vue'
import type {Column} from "@/types/data";

export interface Item {
    id: number
    name: string
    columns: Column[]
}

export const boardsKey: InjectionKey<ComputedRef<Item[]>> = Symbol('boards')
