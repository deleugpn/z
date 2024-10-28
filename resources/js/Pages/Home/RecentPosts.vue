<template>
  <section>
    <ul role="list" class="space-y-2">
      <li v-for="post in props.posts.data" :key="post.id" class="p-4 border bg-white">
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

    <PageFooter :links="props.posts.links" :meta="props.posts.meta" />

  </section>
</template>

<script setup lang="ts">
import {ref} from "vue";
import {FeedProps} from "@/Pages/Home.vue";
import PostForm from "@/Pages/Home/PostForm.vue";
import PostDisplay from "@/Pages/Home/PostDisplay.vue";
import PageFooter from "@/Pages/Home/PageFooter.vue";

const props = defineProps<FeedProps>()

const postBeingUpdated = ref()
</script>
