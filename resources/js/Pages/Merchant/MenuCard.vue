<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/Components/ui/number-field'
import { Menu } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import Badge from '@/Components/ui/badge/Badge.vue';
import { ref } from 'vue';

const props = defineProps<{
    menu: Menu;
}>();

</script>

<template>
    <Card class="shadow-md">
        <CardHeader>
            <!-- For images -->
            <CardTitle>{{ menu.name }}</CardTitle>
            <CardDescription>
                {{ menu.description }}
            </CardDescription>
        </CardHeader>
        <CardContent>
            <div class="flex justify-between items-center">
                <Badge>$ {{ menu.price }}</Badge>

                <NumberField
                    @update:model-value="(v) => {
                        $emit('AddQuantity', { menu: menu, quantity: v})
                    }"
                    id="quantity" 
                    :default-value="0" 
                    :min="0"
                    :max="999"
                    >
                    <NumberFieldContent>
                        <NumberFieldDecrement />
                        <NumberFieldInput />
                        <NumberFieldIncrement/>
                    </NumberFieldContent>
                </NumberField>
            </div>
        </CardContent>
    </Card>
</template>