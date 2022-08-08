<script setup>
import { mdiGithub } from '@mdi/js'
import BaseButton from '@/Components/BaseButton.vue'
import SectionBanner from '@/Components/SectionBanner.vue'

</script>
<template>
  <SectionBanner bg="pinkRed">
    <h1 class="text-3xl text-white mb-6">
      Like the project? Please star on <b>GitHub</b> ;-)
    </h1>
    <div>
      <BaseButton
        href="https://github.com/balajidharma/laravel-vue-admin-panel"
        :icon="mdiGithub"
        label="GitHub"
        target="_blank"
        rounded-full
      />
    </div>
  </SectionBanner>  
</template>