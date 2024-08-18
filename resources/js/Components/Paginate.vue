<script setup lang="ts">
import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from '@/Components/ui/pagination'
import { Paginated } from '@/types'

import {
    Button,
} from '@/Components/ui/button'
import { router } from '@inertiajs/vue3'
import { defineProps, ref, watch } from 'vue'


const props = defineProps<{
    data: Paginated;
}>()

const currPage = ref(props.data.current_page)
const totalItem = ref(props.data.total -1)

const handlePageChange = (page: number) => {
    if(page < 1 || page > props.data.last_page) return

    router.visit(props.data.path + '?page=' + page)
}

</script>

<template>
    <Pagination v-slot="{ page }" :total="totalItem" :sibling-count="1" show-edges :default-page="1">
        <PaginationList v-slot="{ items }" class="flex items-center gap-1">
            <PaginationFirst @click.prevent="handlePageChange(1)"/>
            <PaginationPrev @click.prevent="handlePageChange(currPage - 1)"/>

            <template v-for="(item, index) in items">
                <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                    <Button class="w-10 h-10 p-0" :variant="item.value === currPage ? 'default' : 'outline'"
                        @click.prevent="handlePageChange(item.value)">
                        {{ item.value }}
                    </Button>
                </PaginationListItem>
                <PaginationEllipsis v-else :key="item.type" :index="index" />
            </template>

            <PaginationNext @click.prevent="handlePageChange(currPage + 1)" />
            <PaginationLast @click.prevent="handlePageChange(data.last_page)"/>
        </PaginationList>
    </Pagination>
</template>