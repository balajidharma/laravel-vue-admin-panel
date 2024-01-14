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
  categoryType: {
    type: Object,
    default: () => ({}),
  },
  itemOptions: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  name: '',
  description: '',
  enabled: true,
  parent_id: '',
  weight: ''
})

</script>

<template>
  <LayoutAuthenticated>
    <Head title="Create Category" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiMenu"
        title="Add Category"
        main
      >
        <BaseButton
          :route-name="route('admin.category.type.item.index', categoryType.id)"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('admin.category.type.item.store', categoryType.id))"
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
            :options="itemOptions"
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
