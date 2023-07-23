<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Products</h2>
        </template>

        <div class="pt-12 pb-8 flex justify-center">
            <table class="table-auto bg-white">
                <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Quantity</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products.data" :key="product.id">
                    <td class="border px-4 py-2">{{ product.id }}</td>
                    <td class="border px-4 py-2">{{ product.name }}</td>
                    <td class="border px-4 py-2">{{ product.description }}</td>
                    <td class="border px-4 py-2">{{ product.price }}</td>
                    <td class="border px-4 py-2">{{ product.quantity }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <template v-for="link in products.links">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    v-html="link.label"
                    class="px-1"
                    :class="{ 'text-gray-500' : link.url, 'font-bold' : link.active }"
                    />
                <span v-else v-html="link.label"></span>
            </template>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    products: {
        type: Array,
        required: true,
    }
});

</script>
