<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Products</h2>
        </template>

        <AddProduct v-model="showAddModal" :categories="categories"></AddProduct>
        <EditProduct v-model="showEditModal" :product="product" :categories="categories"></EditProduct>

        <div class="mt-12 mb-24 w-11/12 mx-auto">
            <div class="flex justify-end">
                <button class="btn btn-blue btn-size-sm mb-2" @click.prevent="showAddModal = true">Add Product</button>
            </div>

            <div class="flex flex-col border-t rounded">
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
                                        Product Name
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Description
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Category
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Price
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Quantity
                                    </th>
                                    <th scope="col" class="p-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <tr v-for="product in products.data" :key="product.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 w-4">
                                        <div class="flex items-center">
                                            <input
                                                :id="'checkbox-table-' + product.id"
                                                type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <label :for="'checkbox-table-' + product.id" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ product.name }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ product.description }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ product.category.name }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        ${{ product.price }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ product.quantity }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-right whitespace-nowrap space-x-2">
                                        <button class="text-blue-600" @click.prevent="editClickHandle(product)">
                                            <i class="lni lni-pencil-alt"></i>
                                        </button>
                                        <button class="text-red-600" @click.prevent="deleteClickHandle(product.id)">
                                            <i class="lni lni-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center pb-5">
                <template v-for="link in products.links">
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
import { Head, Link } from '@inertiajs/vue3';
import {ref} from 'vue';
import AddProduct from "../Components/Modals/AddProduct.vue";
import EditProduct from "../Components/Modals/EditProduct.vue";
import Swal from 'sweetalert2';

const props = defineProps({
    products: {
        type: Object,
        default: () => ({}),
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

const showAddModal = ref(false);
const showEditModal = ref(false);

const product = ref();

const deleteClickHandle = (product_id) => {
    Swal.fire({
        title: 'Are you sure you want to delete this product?',
        icon: 'warning',
        showCancelButton: true, // Display the "Cancel" button
        confirmButtonText: 'Yes', // Text for the "Yes" button
        cancelButtonText: 'No', // Text for the "No" button
        confirmButtonColor: '#e74c3c',
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/products/${product_id}`)
                .then(response => console.log(response))
                .catch(error => console.log(error))
        } else {
            // The user clicked "No" button, do nothing or handle accordingly
        }
    });

}

const editClickHandle = (item) => {
    product.value = item;
    showEditModal.value = true
}

</script>
