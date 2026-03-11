<script setup lang="ts">
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { LoaderCircle, SendHorizontal } from 'lucide-vue-next';
import type { User } from '@/types/user';
import type { MessageResponse } from '@/types/messages';

const props = defineProps<{
  user: User;
  messages: MessageResponse;
}>();

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Users',
    href: '/users',
  },
];

const messageForm = useForm({
    body: ''
});

const submit = () => {
    messageForm.post(`/users/${props.user.id}/messages`);
};
</script>

<template>
  <Head title="Messages" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <Card class="flex h-full flex-1 flex-col gap-4 overflow-x-auto border-0 shadow-transparent lg:p-6 p-3 min-w-[350px]">
      <CardHeader class="p-0">
        <CardTitle class="space-x-3 overflow-hidden">Chat with {{ props.user.name }}</CardTitle>
      </CardHeader>
      <CardContent class="flex flex-col mx-auto w-full max-w-[1440px] px-0 h-full">
        <div class="flex flex-col gap-2 p-4 overflow-y-auto flex-1">
          <div
            v-for="message in props.messages"
            :key="message.id"
            class="flex flex-col"
            :class="message.sender_id === props.user.id ? 'self-start' : 'self-end'"
          >
            <div
                class="px-4 py-2 rounded-lg break-words"
                :class="message.sender_id === props.user.id ? 'bg-gray-200 text-gray-900' : 'bg-blue-500 text-white'"
            >
                {{ message.body }}
            </div>
            <span class="text-xs text-gray-400 mt-1">
                {{ new Date(message.created_at).toLocaleTimeString() }}
            </span>
          </div>
        </div>
        <div class="p-4">
            <form @submit.prevent="submit">
                <div class="relative">
                    <Input
                        id="message"
                        type="text"
                        required
                        v-model="messageForm.body"
                        placeholder="Type your message"
                        class="pr-16"
                    />
                    <Button
                        type="submit"
                        size="icon"
                        class="absolute right-1 top-1/2 -translate-y-1/2 h-8 w-8"
                        :disabled="messageForm.processing"
                    >
                        <LoaderCircle
                            v-if="messageForm.processing"
                            class="h-4 w-4 animate-spin"
                        />
                        <span v-else>
                            <SendHorizontal />
                        </span>
                    </Button>
                </div>
            </form>
        </div>
      </CardContent>
    </Card>
  </AppLayout>
</template>
