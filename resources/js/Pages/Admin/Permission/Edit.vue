<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";

const props = defineProps({
  permission: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm({
  _method: 'put',
  name: props.permission.name,
});
</script>

<template>
  <Head title="Update permission" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Permissions
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex flex-col">
              <div>
                <h1
                  class="
                    inline-block
                    text-2xl
                    sm:text-3xl
                    font-extrabold
                    text-slate-900
                    tracking-tight
                    dark:text-slate-200
                    py-4
                    block
                    sm:inline-block
                    flex
                  "
                >
                  Update permission
                </h1>
                <Link
                  :href="route('permission.index')"
                  class="
                    no-underline
                    hover:underline
                    text-cyan-600
                    dark:text-cyan-400
                  "
                  >&lt;&lt; Back to all permissions</Link
                >
              </div>
              <div class="w-full py-2 bg-white overflow-hidden">
                <form
                  @submit.prevent="
                    form.post(route('permission.update', this.permission.id))
                  "
                >
                  <div class="py-2">
                    <label
                      class="block font-bold text-sm text-gray-700"
                      :class="{ 'text-red-400': form.errors.name }"
                      for="name"
                    >
                      Name
                    </label>

                    <input
                      class="
                        my-2
                        rounded-md
                        shadow-sm
                        border-gray-300
                        focus:border-indigo-300
                        focus:ring
                        focus:ring-indigo-200
                        focus:ring-opacity-50
                        block
                        w-full
                      "
                      :class="{ 'border-red-400': form.errors.name }"
                      id="name"
                      type="text"
                      v-model="form.name"
                    />
                    <div class="text-red-400 text-sm" v-if="form.errors.name">
                      {{ form.errors.name }}
                    </div>
                  </div>

                  <div class="flex justify-end mt-4">
                    <BreezeButton
                      class="ml-4"
                      :class="{ 'opacity-25': form.processing }"
                      :disabled="form.processing"
                    >
                      Update
                    </BreezeButton>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
