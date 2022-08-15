<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import {
  mdiAccount,
  mdiAccountCircle,
  mdiLock,
  mdiMail,
  mdiAsterisk,
  mdiFormTextboxPassword,
  mdiArrowLeftBoldOutline,
} from "@mdi/js";
import SectionMain from "@/Components/SectionMain.vue";
import CardBox from "@/Components/CardBox.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";

const props = defineProps({
  user: {
    type: Object,
    default: () => ({}),
  },
});

const profileForm = useForm({
  name: props.user.name,
  email: props.user.email,
});
const passwordForm = useForm({
  old_password: "",
  new_password: "",
  confirm_password: "",
});
</script>

<template>
  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccount" title="Profile" main>
        <BaseButton
          :route-name="route('dashboard')"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <CardBox
          title="Edit Profile"
          :icon="mdiAccountCircle"
          form
          @submit.prevent="profileForm.post(route('admin.account.info.store'))"
        >
          <FormField
            label="Name"
            help="Required. Your name"
            :class="{ 'text-red-400': profileForm.errors.name }"
          >
            <FormControl
              v-model="profileForm.name"
              :icon="mdiAccount"
              name="name"
              required
              :error="profileForm.errors.name"
            />
          </FormField>
          <FormField
            label="Email"
            help="Required. Your e-mail"
            :class="{ 'text-red-400': profileForm.errors.email }"
          >
            <FormControl
              v-model="profileForm.email"
              :icon="mdiMail"
              type="email"
              name="email"
              required
              :error="profileForm.errors.email"
            />
          </FormField>

          <template #footer>
            <BaseButtons>
              <BaseButton color="info" type="submit" label="Submit" />
            </BaseButtons>
          </template>
        </CardBox>

        <CardBox
          title="Change Password"
          :icon="mdiLock"
          form
          @submit.prevent="
            passwordForm.post(route('admin.account.password.store'))
          "
        >
          <FormField
            label="Current password"
            help="Required. Your current password"
            :class="{ 'text-red-400': passwordForm.errors.old_password }"
          >
            <FormControl
              v-model="passwordForm.old_password"
              :icon="mdiAsterisk"
              name="old_password"
              type="password"
              required
              :error="passwordForm.errors.old_password"
            />
          </FormField>

          <BaseDivider />

          <FormField
            label="New password"
            help="Required. New password"
            :class="{ 'text-red-400': passwordForm.errors.new_password }"
          >
            <FormControl
              v-model="passwordForm.new_password"
              :icon="mdiFormTextboxPassword"
              name="new_password"
              type="password"
              required
              :error="passwordForm.errors.new_password"
            />
          </FormField>

          <FormField
            label="Confirm password"
            help="Required. New password one more time"
            :class="{ 'text-red-400': passwordForm.errors.confirm_password }"
          >
            <FormControl
              v-model="passwordForm.confirm_password"
              :icon="mdiFormTextboxPassword"
              name="confirm_password"
              type="password"
              required
              :error="passwordForm.errors.confirm_password"
            />
          </FormField>

          <template #footer>
            <BaseButtons>
              <BaseButton type="submit" color="info" label="Submit" />
            </BaseButtons>
          </template>
        </CardBox>
      </div>
    </SectionMain>
  </LayoutAuthenticated>
</template>