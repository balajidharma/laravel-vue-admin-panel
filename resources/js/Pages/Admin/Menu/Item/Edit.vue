<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiMenu,
  mdiArrowLeftBoldOutline
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'

const props = defineProps({
  menu: {
    type: Object,
    default: () => ({}),
  },
  item: {
    type: Object,
    default: () => ({}),
  },
  item_options: {
    type: Object,
    default: () => ({}),
  },
})


const form = useForm({
  _method: 'put',
  name: props.item.name,
  uri: props.item.uri,
  description: props.item.description,
  enabled: props.item.enabled,
  parent_id: props.item.parent_id,
  weight: props.item.weight
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Update menu item" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiMenu"
        title="Update menu item"
        main
      >
        <BaseButton
          :route-name="route('menu.item.index', menu.id)"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('menu.item.update', {menu: props.menu.id, item:props.item.id}))"
      >
        <FormField
          label="Name"
          :class="{ 'text-red-400': form.errors.name }"
        >
          <FormControl
            v-model="form.name"
            type="text"
            placeholder="Enter Name"
            :error="form.errors.name"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.name">
              {{ form.errors.name }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Link"
          :class="{ 'text-red-400': form.errors.uri }"
        >
          <FormControl
            v-model="form.uri"
            type="text"
            placeholder="Enter Link"
            :error="form.errors.name"
          >
            <div class="item-list">
                You can also enter an internal path such as <em class="placeholder">/home</em> or an external URL such as <em class="placeholder">http://example.com</em>. 
                Add prefix <em class="placeholder">&lt;admin&gt;</em> to link for admin page. Enter <em class="placeholder">&lt;nolink&gt;</em> to display link text only.
            </div>
            <div class="text-red-400 text-sm" v-if="form.errors.uri">
              {{ form.errors.uri }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Description"
          :class="{ 'text-red-400': form.errors.description }"
        >
          <FormControl
            v-model="form.description"
            type="text"
            placeholder="Enter Description"
            :error="form.errors.description"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.description">
              {{ form.errors.description }}
            </div>
          </FormControl>
        </FormField>
        <FormCheckRadioGroup
          v-model="form.enabled"
          name="enabled"
          :options="{ enabled: 'Enabled' }"
        />
        <FormField
          label="Parent Item"
          :class="{ 'text-red-400': form.errors.parent_id }"
        >
          <FormControl
            v-model="form.parent_id"
            type="select"
            placeholder="--ROOT--"
            :error="form.errors.parent_id"
            :options="item_options"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.parent_id">
              {{ form.errors.parent_id }}
            </div>
            <div>
                The maximum depth for a link and all its children is fixed. Some menu links may not be available as parents if selecting them would exceed this limit.
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Weight"
          :class="{ 'text-red-400': form.errors.weight }"
        >
          <FormControl
            v-model="form.weight"
            type="text"
            placeholder="Enter Weight"
            :error="form.errors.weight"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.weight">
              {{ form.errors.weight }}
            </div>
          </FormControl>
        </FormField>
        <template #footer>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="info"
              label="Submit"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
