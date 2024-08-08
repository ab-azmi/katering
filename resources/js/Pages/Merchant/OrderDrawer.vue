<script setup lang="ts">
import { ref } from 'vue'
import { Minus, Plus } from 'lucide-vue-next'
import { Button } from '@/Components/ui/button'
import {
  Drawer,
  DrawerClose,
  DrawerContent,
  DrawerDescription,
  DrawerFooter,
  DrawerHeader,
  DrawerTitle,
  DrawerTrigger,
} from '@/Components/ui/drawer'
import { Menu } from '@/types'

defineProps<{
    orderList: {
        item: Menu;
        quantity: number;
    }[];
}>();

</script>

<template>
  <Drawer>
    <DrawerTrigger as-child>
     <slot/>
    </DrawerTrigger>
    <DrawerContent>
      <div class="mx-auto w-full max-w-lg">
        <DrawerHeader>
          <DrawerTitle>Your shopping list</DrawerTitle>
          <DrawerDescription>Make sure you grab everything</DrawerDescription>
        </DrawerHeader>
        
        <!-- List -->
         <div class="flex flex-col gap-3">
          <div class="flex items-center justify-between my-2">
            <h1 class="text-lg font-bold">Item</h1>
            <h1 class="text-lg font-bold">Quantity</h1>
          </div>
          <template v-for="order in orderList" :key="order.item.id">
            <div class="flex justify-between items-center">
              <p>{{ order.item.name }}</p>
              <p>{{ order.quantity }}</p>
            </div>
            <!-- TODO remove item -->
          </template>
         </div>

        <DrawerFooter>
          <DrawerClose as-child>
            <Button variant="outline">
              Close
            </Button>
          </DrawerClose>
        </DrawerFooter>
      </div>
    </DrawerContent>
  </Drawer>
</template>