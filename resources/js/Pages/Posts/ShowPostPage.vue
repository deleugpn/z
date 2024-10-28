<template>
  <Head title="Post" />

<!--    <pre>-->
<!--      {{ usePage() }}-->
<!--    </pre>-->

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Post
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">

          <ShowPost :post="props.post" :disable-editor="true" />

        </div>
      </div>
    </div>
  </AuthenticatedLayout>

</template>

<script setup lang="ts">
import {Head, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {FeedPost} from "@/Pages/Home.vue";
import ShowPost from "@/Pages/Home/PostDisplay.vue";

const props = defineProps<{ post: FeedPost }>();
</script>
