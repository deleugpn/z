<template>
  <div v-for="alert in alerts">
    <div class="rounded-md bg-green-50 p-4 mb-4" v-if="alert.type === 'success'">
      <div class="flex">
        <div class="flex-shrink-0">
          <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true" />
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium text-green-800">{{ alert.message }}</p>
        </div>
      </div>
    </div>

    <div class="rounded-md bg-red-50 p-4 mb-4" v-if="alert.type === 'error'">
      <div class="flex">
        <div class="flex-shrink-0">
          <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium text-red-800">{{ alert.message }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import {CheckCircleIcon, XMarkIcon, XCircleIcon, } from '@heroicons/vue/20/solid'
import {usePage} from "@inertiajs/vue3";
import {ref, watch} from "vue";

const page = usePage();

const alerts = ref([])

watch(() => page.props.alert, (alert) => {
  if (alert) {
    alerts.value.push(alert)

    setTimeout(() => {
      alerts.value.shift()
    }, 5000)
  }
});
</script>
