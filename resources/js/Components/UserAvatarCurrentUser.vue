<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import UserAvatar from '@/Components/UserAvatar.vue'

const userName = computed(() => usePage().props.value.auth.user.name)
</script>

<template>
  <UserAvatar
    :username="userName"
    api="initials"
  />
</template>