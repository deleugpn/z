<template>
  <Head title="Home" />

<!--  <pre>-->
<!--    {{ usePage() }}-->
<!--  </pre>-->

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

        <Alert />

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <PostForm />
          </div>
        </div>

        <div class="mt-2 overflow-hidden shadow-sm sm:rounded-lg">
          <RecentPosts :posts="props.posts"/>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import RecentPosts from "@/Pages/Home/RecentPosts.vue";
import Alert from "@/Pages/Home/Alert.vue";
import PostForm from "@/Pages/Home/PostForm.vue";
import {PageLinks, PageMeta} from "@/types";

export interface Post {
  id: number;
  title: string;
  content: string;
  published_at: string;
}

export interface FeedPost extends Post {
  is_owner: boolean;
  author: {
    id: number;
    name: string;
    email: string;
    following: boolean;
  };
}

export interface FeedProps {
  posts: {
    data: FeedPost[];
    links: PageLinks;
    meta: PageMeta;
  }
}

const props = defineProps<FeedProps>();
</script>
