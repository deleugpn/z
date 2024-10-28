<template>
  <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-1" aria-label="Pagination">
    <div class="hidden sm:block">
      <p class="text-sm text-gray-700">
        Showing
        {{ ' ' }}
        <span class="font-medium">{{  props.meta.from }}</span>
        {{ ' ' }}
        to
        {{ ' ' }}
        <span class="font-medium">{{  props.meta.to }}</span>
        {{ ' ' }}
        of
        {{ ' ' }}
        <span class="font-medium">{{  props.meta.total }}</span>
        {{ ' ' }}
        results
      </p>
    </div>
    <div class="flex flex-1 justify-between sm:justify-end">
      <Component :is="props.links.prev ? Link : 'span'" :href="props.links.prev" :class="props.links.prev ? 'font-semibold text-gray-900' : 'text-gray-500 cursor-not-allowed'" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm  ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Previous</Component>
      <Component :is="props.links.next ? Link : 'span'" :href="props.links.next" :class="props.links.next ? 'font-semibold text-gray-900' : 'text-gray-500 cursor-not-allowed'" class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</Component>
    </div>
  </nav>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {PageLinks, PageMeta} from "@/types";

interface PageFooterProps {
  links: PageLinks;
  meta: PageMeta;
}

const props = defineProps<PageFooterProps>();
</script>
