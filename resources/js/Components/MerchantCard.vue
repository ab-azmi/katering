<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card'
import { Merchant } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';


const props = defineProps<{
    merchant: Merchant;
}>();

</script>

<template>
  <Card class="shadow-md">
    <CardHeader>
      <CardTitle>{{ merchant.name }}</CardTitle>
      <CardDescription>
        {{ merchant.address }}
      </CardDescription>
    </CardHeader>
    <CardContent>
        <Link :href="route('merchant.detail', merchant.id)" as="button">
            <Button>
                
                Visit Merchant
            </Button>
        </Link>
    </CardContent>
  </Card>
</template>