<script setup lang="ts">
import { Search } from 'lucide-vue-next'
import { Input } from '@/Components/ui/input'
import { ref } from 'vue'

const search = defineModel<string>()
</script>

<template>
    <div class="relative w-full max-w-sm items-center my-4">
        <Input id="search" v-model="search" type="text" placeholder="Search..." class="pl-10" />
        <span class="absolute start-0 inset-y-0 flex items-center justify-center px-2">
            <Search class="size-6 text-muted-foreground" />
        </span>
    </div>
</template>