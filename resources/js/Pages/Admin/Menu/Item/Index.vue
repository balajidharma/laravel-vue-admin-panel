<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3"
import {
  mdiLink,
  mdiPlus,
  mdiSquareEditOutline,
  mdiTrashCan,
  mdiAlertBoxOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseButton from "@/Components/BaseButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButtons from "@/Components/BaseButtons.vue"
import NotificationBar from "@/Components/NotificationBar.vue"

const props = defineProps({
  items: {
    type: Object,
    default: () => ({}),
  },
  menu: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
})


const formDelete = useForm({})

function destroy(id) {
  if (confirm("Are you sure you want to delete?")) {
    formDelete.delete(route("menu.item.destroy", {menu: props.menu.id, item: id}))
  }
}
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Menus" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiLink"
        title="Menus"
        main
      >
        <BaseButton
          v-if="can.delete"
          :route-name="route('menu.item.create', menu.id)"
          :icon="mdiPlus"
          label="Add"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar
        v-if="$page.props.flash.message"
        color="success"
        :icon="mdiAlertBoxOutline"
      >
        {{ $page.props.flash.message }}
      </NotificationBar>
      <CardBox class="mb-6" has-table>
        <table>
          <thead>
            <tr>
              <th>
                Name
              </th>
              <th>
                Description
              </th>
              <th>
                Enable
              </th>
              <th v-if="can.edit || can.delete">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="item in items" :key="item.id">
              <td data-label="Name">
                  {{ item.name }}
              </td>
               <td data-label="Description">
                  {{ item.description }}
              </td>
              <td data-label="Enabled">
                  {{ item.enabled }}
              </td>
              <td
                v-if="can.edit || can.delete"
                class="before:hidden lg:w-1 whitespace-nowrap"
              >
                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                  <BaseButton
                    v-if="can.edit"
                    :route-name="route('menu.item.edit', {menu: menu.id, item: item.id})"
                    color="info"
                    :icon="mdiSquareEditOutline"
                    small
                  />
                  <BaseButton
                    v-if="can.delete"
                    color="danger"
                    :icon="mdiTrashCan"
                    small
                    @click="destroy(item.id)"
                  />
                </BaseButtons>
              </td>
            </tr>
          </tbody>
        </table>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
