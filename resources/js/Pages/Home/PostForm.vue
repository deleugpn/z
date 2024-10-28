<template>
  <div class="flex items-start space-x-4">
    <div class="flex-shrink-0">
      <User />
    </div>

    <div class="min-w-0 flex-1">
      <form @submit.prevent="createPost" class="space-y-4">
        <div class="border-b border-gray-200 focus-within:border-indigo-600">
          <input v-model="form.title" class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Your post title" >

          <InputError :message="form.errors.title" class="mt-2" />
        </div>

        <div class="border-b border-gray-200 focus-within:border-indigo-600">
          <label for="comment" class="sr-only">Add your comment</label>
          <textarea rows="3" v-model="form.content" class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Post something..." />
        </div>

        <div class="flex justify-between">
          <div class="flex items-center space-x-5">
            <div class="flow-root"></div>
          </div>
          <div class="flex-shrink-0">
            <button class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
              {{ form.id ? 'Save' : 'Post' }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import {type Post} from '@/Pages/Home.vue';
import User from '@/Components/Icons/User.vue';
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

interface NewPostProps {
  post?: Post;
}

const emit = defineEmits();

const props = defineProps<NewPostProps>();

const form = useForm({
  id: props.post?.id,
  title: props.post?.title,
  content: props.post?.content,
});

const createPost = () => {
  form.put('/posts', {
    preserveScroll: false,
    onSuccess: () => {
      form.reset();

      if (form.id) {
        emit('post-updated');
      }
    },
    onError: () => {
      console.log(form.errors)
    },
  });
};
</script>
