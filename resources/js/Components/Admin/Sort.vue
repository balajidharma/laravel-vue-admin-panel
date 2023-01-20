<script setup>
import { ref, computed } from "vue"
import { Link } from "@inertiajs/vue3"

const props = defineProps({
  label: {
    type: String,
    default: "",
  },
  attribute: {
    type: String,
    default: "",
  },
})

const downFill = ref("lightgray")
const upFill = ref("lightgray")

const sortLink = computed(() => {
  let url = new URL(document.location)
  let sortValue = url.searchParams.get("sort")

  if (sortValue == props.attribute) {
    url.searchParams.set("sort", "-" + props.attribute)
    upFill.value = "black"
  } else if (sortValue === "-" + props.attribute) {
    url.searchParams.set("sort", props.attribute)
    downFill.value = "black"
  } else {
    url.searchParams.set("sort", props.attribute)
  }
  return url.href
});
</script>

<template>
  <div class="flex items-center gap-4">
    <Link
      :href="sortLink"
      class="no-underline hover:underline text-cyan-600 dark:text-cyan-400"
      >{{ label }}</Link
    >
    <div class="flex flex-col">
      <svg
        class="inline-block"
        xmlns="http://www.w3.org/2000/svg"
        width="15px"
        height="15px"
        viewBox="0 0 15 15"
        fill="none"
      >
        <path d="M7.5 3L15 11H0L7.5 3Z" :fill="upFill" />
      </svg>
      <svg
        class="inline-block"
        xmlns="http://www.w3.org/2000/svg"
        width="15px"
        height="15px"
        viewBox="0 0 15 15"
        fill="none"
      >
        <path
          d="M7.49988 12L-0.00012207 4L14.9999 4L7.49988 12Z"
          :fill="downFill"
        />
      </svg>
    </div>
  </div>
</template>