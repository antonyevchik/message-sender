<script setup lang="ts">
import { Card, CardAction, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import type { UserResponse } from '@/types/user';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Users',
    href: '/users',
  },
];

const props = defineProps<{
  users: UserResponse;
}>();
</script>

<template>
  <Head title="Users" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <Card class="flex h-full flex-1 flex-col gap-4 overflow-x-auto border-0 shadow-transparent lg:p-6 p-3 min-w-[350px]">
      <CardHeader class="p-0">
        <CardTitle class="space-x-3 overflow-hidden">User list</CardTitle>
      </CardHeader>
      <CardContent class="mx-auto w-full max-w-[1440px] px-0">
        <div class="overflow-x-auto rounded-lg border">
          <table class="min-w-full divide-y">
            <thead class="bg-gray-50 dark:bg-stone-800">
              <tr>
                <th class="px-2 py-2 text-left text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">Id</th>
                <th class="px-2 py-2 text-left text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">Name</th>
              </tr>
            </thead>
            <tbody class="text-xs sm:text-sm md:text-base divide-y divide-gray-200 bg-white dark:bg-stone-700 text-gray-700 dark:text-gray-300">
              <tr v-for="user in props.users.data" :key="user.id">
                <td class="px-2 py-2">
                  {{ user.id }}
                </td>
                <td class="px-2 py-2">
                  {{ user.name }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </CardContent>
      <CardFooter class="mx-auto w-full max-w-[1440px] px-0">
        <div class="mt-4 flex gap-2">
          <a
            v-for="link in props.users.links"
            :key="link.label"
            :href="link.url || '#'"
            v-html="link.label"
            class="rounded border px-3 py-1 text-sm"
            :class="{
              'bg-gray-200 dark:bg-gray-700 font-bold': link.active,
              'pointer-events-none text-gray-400': !link.url,
            }"
          />
        </div>
      </CardFooter>
    </Card>
  </AppLayout>
</template>
