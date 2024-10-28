<template>
  <div class="flex">
    <div class="flex-shrink-0">
      <User />
    </div>

    <div class="ml-3">
      <div class="text-sm">
        <a href="#">
          <span class="font-medium text-gray-900">{{ post.author.name }}</span>
          <span class="pl-2 text-sm text-gray-500">{{ post.author.email }}</span>
        </a>
      </div>
      <div class="mt-1">
        <span>{{ post.title }}</span>
        <p class="text-sm text-gray-700">{{ post.content }}</p>
      </div>
      <div class="mt-2 text-sm">
        <span class="font-medium text-gray-500">{{ post.published_at }}</span>
      </div>
    </div>

    <div class="ml-auto pl-3" v-if="post.is_owner">
      <div class="-mx-1.5 -my-1.5">
        <button v-if="!props.disableEditor" @click="emitStartUpdating(post)" type="button" class="inline-flex rounded-md p-1.5 text-indigo-500 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-indigo-50">
          <span class="sr-only">Dismiss</span>
          <PencilIcon class="h-5 w-5" aria-hidden="true" />
        </button>

        <Link :href="`/posts/${post.id}`" method="delete" as="button" type="button" class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
          <span class="sr-only">Dismiss</span>
          <TrashIcon class="h-5 w-5" aria-hidden="true" />
        </Link>
      </div>
    </div>

    <div class="ml-auto pl-3" v-else>
      <div class="-mx-1.5 -my-1.5">
        <Link v-if="post.author.following" :href="`/authors/${post.author.id}/follows`" method="delete" as="button" type="button" class="inline-flex rounded-md p-1.5 text-orange-500 hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-offset-2 focus:ring-offset-orange-50">
          Unfollow
        </Link>

        <Link v-else :href="`/authors/${post.author.id}/follows`" method="post" as="button" type="button" class="inline-flex rounded-md p-1.5 text-indigo-500 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-indigo-50">
          Follow
        </Link>
      </div>
    </div>

  </div>
</template>

<script setup lang="ts">
import {PencilIcon, TrashIcon} from "@heroicons/vue/20/solid";
import {Link} from "@inertiajs/vue3";
import User from "@/Components/Icons/User.vue";
import {FeedPost} from "@/Pages/Home.vue";

interface PostDisplayProps {
  post: FeedPost;
  disableEditor?: boolean;
}

interface PostDisplayEmits {
  (e: 'startUpdating', post: FeedPost): void;
}

const props = defineProps<PostDisplayProps>();

const emit = defineEmits<PostDisplayEmits>();

const emitStartUpdating = (post: FeedPost) => {
  emit('startUpdating', post);
};
</script>
