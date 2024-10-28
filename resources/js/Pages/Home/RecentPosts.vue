<template>
  <section>
    <ul role="list" class="space-y-2">
      <li v-for="post in props.posts.data" :key="post.id" class="p-6 border bg-white">
        <PostForm
            v-if="post.id === postBeingUpdated?.id"
            @postUpdated="postBeingUpdated = null"
            :post="post"
        />

        <PostDisplay
            v-if="post.id !== postBeingUpdated?.id"
            @startUpdating="postBeingUpdated = $event;"
            :post="post"
        />
      </li>
    </ul>

    <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-1" aria-label="Pagination">
      <div class="hidden sm:block">
        <p class="text-sm text-gray-700">
          Showing
          {{ ' ' }}
          <span class="font-medium">{{  props.posts.meta.from }}</span>
          {{ ' ' }}
          to
          {{ ' ' }}
          <span class="font-medium">{{  props.posts.meta.to }}</span>
          {{ ' ' }}
          of
          {{ ' ' }}
          <span class="font-medium">{{  props.posts.meta.total }}</span>
          {{ ' ' }}
          results
        </p>
      </div>
      <div class="flex flex-1 justify-between sm:justify-end">
        <Component :is="props.posts.links.prev ? Link : 'span'" :href="props.posts.links.prev" :class="props.posts.links.prev ? 'font-semibold text-gray-900' : 'text-gray-500 cursor-not-allowed'" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm  ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Previous</Component>
        <Component :is="props.posts.links.next ? Link : 'span'" :href="props.posts.links.next" :class="props.posts.links.next ? 'font-semibold text-gray-900' : 'text-gray-500 cursor-not-allowed'" class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</Component>
      </div>
    </nav>

  </section>
</template>

<script setup lang="ts">
import {ref} from "vue";
import {FeedProps} from "@/Pages/Home.vue";
import PostForm from "@/Pages/Home/PostForm.vue";
import PostDisplay from "@/Pages/Home/PostDisplay.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps<FeedProps>()

const postBeingUpdated = ref()
</script>
