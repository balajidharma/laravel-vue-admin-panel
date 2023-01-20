<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { getButtonColor } from '@/colors.js'
import BaseIcon from '@/Components/BaseIcon.vue'

const props = defineProps({
  label: {
    type: [String, Number],
    default: null
  },
  icon: {
    type: String,
    default: null
  },
  href: {
    type: String,
    default: null
  },
  target: {
    type: String,
    default: null
  },
  routeName: {
    type: String,
    default: null
  },
  type: {
    type: String,
    default: null
  },
  color: {
    type: String,
    default: 'white'
  },
  as: {
    type: String,
    default: null
  },
  small: Boolean,
  outline: Boolean,
  active: Boolean,
  disabled: Boolean,
  roundedFull: Boolean
})

const is = computed(() => {
  if (props.as) {
    return props.as
  }

  if (props.routeName) {
    return Link
  }

  if (props.href) {
    return 'a'
  }

  return 'button'
})

const computedType = computed(() => {
  if (is.value === 'button') {
    return props.type ?? 'button'
  }

  return null
})

const labelClass = computed(() => props.small && props.icon ? 'px-1' : 'px-2')

const componentClass = computed(() => {
  const base = [
    'inline-flex',
    'cursor-pointer',
    'justify-center',
    'items-center',
    'whitespace-nowrap',
    'focus:outline-none',
    'transition-colors',
    'focus:ring',
    'duration-150',
    'border',
    props.roundedFull ? 'rounded-full' : 'rounded',
    props.active ? 'ring ring-black dark:ring-white' : 'ring-blue-700',
    getButtonColor(props.color, props.outline, !props.disabled)
  ]

  if (props.small) {
    base.push(
      'text-sm',
      props.roundedFull ? 'px-3 py-1' : 'p-1'
    )
  } else {
    base.push(
      'py-2',
      props.roundedFull ? 'px-6' : 'px-3'
    )
  }


  if (props.disabled) {
    base.push('cursor-not-allowed', props.outline ? 'opacity-50' : 'opacity-70')
  }

  return base
})
</script>

<template>
  <component
    :is="is"
    :class="componentClass"
    :href="routeName ? routeName : href"
    :type="computedType"
    :target="target"
    :disabled="disabled"
  >
    <BaseIcon
      v-if="icon"
      :path="icon"
    />
    <span
      v-if="label"
      :class="labelClass"
    >{{ label }}</span>
  </component>
</template>
