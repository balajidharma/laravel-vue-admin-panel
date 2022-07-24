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
</script>

<template>
  <Head title="View permission" />

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
                  View permission
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
              <div class="w-full py-2">
                <div class="min-w-full border-b border-gray-200 shadow">
                  <table class="table-fixed w-full text-sm">
                    <tbody class="bg-white dark:bg-slate-800">
                      <tr>
                        <td
                          class="
                            border-b border-slate-100
                            dark:border-slate-700
                            p-4
                            pl-8
                            text-slate-500
                            dark:text-slate-400
                          "
                        >
                          Name
                        </td>
                        <td
                          class="
                            border-b border-slate-100
                            dark:border-slate-700
                            p-4
                            text-slate-500
                            dark:text-slate-400
                          "
                        >
                          {{ permission.name }}
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="
                            border-b border-slate-100
                            dark:border-slate-700
                            p-4
                            pl-8
                            text-slate-500
                            dark:text-slate-400
                          "
                        >
                          Created
                        </td>
                        <td
                          class="
                            border-b border-slate-100
                            dark:border-slate-700
                            p-4
                            text-slate-500
                            dark:text-slate-400
                          "
                        >
                          {{ new Date(permission.created_at).toLocaleString() }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
