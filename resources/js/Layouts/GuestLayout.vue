<script setup lang="ts">
import { Toaster } from '@/Components/ui/sonner'
</script>

<template>
    <div class="min-h-screen max-w-5xl mx-auto">
            <slot />
            <Toaster />
    </div>
</template>
