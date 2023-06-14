<script setup>
import AsideMenuItem from '@/Components/AsideMenuItem.vue'

defineProps({
  isDropdownList: Boolean,
  menu: {
    type: Object,
    default: () => {}
  }
})

const emit = defineEmits(['menu-click', 'dropdown-active'])

const menuClick = (event, item) => {
  emit('menu-click', event, item)
}

const dropdownActive = value => {
  emit('dropdown-active', value)
}
</script>

<template>
  <ul>
    <AsideMenuItem
      v-for="(item, index) in menu"
      :key="index"
      :item="item"
      :is-dropdown-list="isDropdownList"
      @menu-click="menuClick"
      @dropdown-active="dropdownActive"
    />
  </ul>
</template>
