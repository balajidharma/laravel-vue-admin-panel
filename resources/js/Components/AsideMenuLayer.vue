<script setup>
import { router } from '@inertiajs/vue3'
import { mdiLogout, mdiClose } from '@mdi/js'
import { computed } from 'vue'
import { useLayoutStore } from '@/Stores/layout.js'
import { useStyleStore } from '@/Stores/style.js'
import AsideMenuList from '@/Components/AsideMenuList.vue'
import AsideMenuItem from '@/Components/AsideMenuItem.vue'
import BaseIcon from '@/Components/BaseIcon.vue'

defineProps({
  menu: {
    type: Object,
    default: () => {}
  }
})

const emit = defineEmits(['menu-click'])

const layoutStore = useLayoutStore()

const styleStore = useStyleStore()

const logoutItem = computed(() => ({
  name: 'Logout',
  icon: mdiLogout,
  color: 'info',
  link: '#'
}))

const logoutItemClick = () => {
  router.post(route('logout'))
}

const menuClick = (event, item) => {
  emit('menu-click', event, item)
}
</script>

<template>
  <aside
    id="aside"
    class="lg:py-2 lg:pl-2 w-60 fixed flex z-40 top-0 h-screen transition-position overflow-hidden"
  >
    <div
      :class="styleStore.asideStyle"
      class="lg:rounded-xl flex-1 flex flex-col overflow-hidden dark:bg-slate-900"
    >
      <div
        :class="styleStore.asideBrandStyle"
        class="flex flex-row h-14 items-center justify-between dark:bg-slate-900"
      >
        <div class="text-center flex-1 lg:text-left lg:pl-6 xl:text-center xl:pl-0">
          <b class="font-black">One</b>
        </div>
        <button 
          class="hidden lg:inline-block xl:hidden p-3"
          @click.prevent="layoutStore.isAsideLgActive = false"
        >
          <BaseIcon
            :path="mdiClose"
          />
        </button>
      </div>
      <div
        :class="styleStore.darkMode ? 'aside-scrollbars-[slate]' : styleStore.asideScrollbarsStyle" 
        class="flex-1 overflow-y-auto overflow-x-hidden"
      >
        <AsideMenuList
          :menu="menu"
          @menu-click="menuClick"
        />
      </div>

      <ul>
        <AsideMenuItem
          :item="logoutItem"
          @menu-click="logoutItemClick"
        />
      </ul>
    </div>
  </aside>
</template>
