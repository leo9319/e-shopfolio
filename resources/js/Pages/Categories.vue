<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Categories</h2>
        </template>

        <div class="mt-12 mb-24 w-11/12 mx-auto border-t rounded">
            <div class="flex flex-col">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input
                                                id="checkbox-all"
                                                type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <label for="checkbox-all" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Name
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Slug
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Description
                                    </th>
                                    <th scope="col" class="p-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <tr v-for="category in categories.data" :key="category.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 w-4">
                                        <div class="flex items-center">
                                            <input
                                                :id="'checkbox-table-' + category.id"
                                                type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <label :for="'checkbox-table-' + category.id" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ category.name }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ category.slug }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ category.description.slice(0, 20) }}...
                                    </td>
                                    <td class="py-4 px-6 text-sm text-right whitespace-nowrap space-x-2">
                                        <a href="#" class="text-blue-600">
                                            <i class="lni lni-pencil-alt"></i>
                                        </a>
                                        <a href="#" class="text-red-600">
                                            <i class="lni lni-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center pb-5">
                <template v-for="link in categories.links">
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        v-html="link.label"
                        class="px-2"
                        :class="{ 'text-gray-500' : link.url, 'font-extrabold' : link.active }"
                    />
                    <span v-else v-html="link.label"></span>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});
</script>
