<template>
    <modal-wrapper name="add-modal">
        <template #title>Edit Product: {{ product.name }}</template>
        <template #content>
            <form action="#" class="space-y-4">
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Product Name</div>
                    <div class="w-3/4">
                        <input type="text" class="input-text" placeholder="Product Name..." v-model="form.name">
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Category</div>
                    <div class="w-3/4">
                        <Multiselect :options="categories" label="name" value-prop="id" v-model="form.category_id"></Multiselect>
                        <form-error :errors="errors" property="category_id"></form-error>
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4">Description</div>
                    <div class="w-3/4">
                        <textarea class="input-text" placeholder="Description..." v-model="form.description"></textarea>
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Price</div>
                    <div class="w-3/4">
                        <input type="number" class="input-text" placeholder="Price..." v-model="form.price">
                        <form-error :errors="errors" property="price"></form-error>
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Quantity</div>
                    <div class="w-3/4">
                        <input type="number" class="input-text" placeholder="Quantity..." v-model="form.quantity">
                        <form-error :errors="errors" property="quantity"></form-error>
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4">Image</div>
                    <div class="w-3/4">
                        <input type="file" ref="imageInput" @change="onFileChange">
                    </div>
                </div>
            </form>
        </template>
        <template #footer>
            <button class="btn btn-blue" @click.prevent="editClickHandle">Update Product</button>
        </template>
    </modal-wrapper>
</template>

<script setup>
import ModalWrapper from "@/Components/ModalWrapper.vue";
import { reactive, watch, ref, defineEmits } from "vue";
import _ from 'lodash';
import Multiselect from '@vueform/multiselect';
import FormError from "@/Components/FormError.vue";
import axios from 'axios'; // Import Axios for API calls

const props = defineProps({
    categories: {
        type: Object,
        default: () => ({})
    },
    product: {
        type: Object,
        default: () => ({})
    }
});
const selectedImage = ref(null);
const form = ref([]);
const errors = ref([]);
const emits = defineEmits(["update:modelValue"]);

const onFileChange = (event) => {
    selectedImage.value = event.target.files[0];
};

const editClickHandle = () => {
    // Convert form data to FormData object for sending the image
    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('description', form.value.description);
    formData.append('price', form.value.price);
    formData.append('quantity', form.value.quantity);
    formData.append('category_id', form.value.category_id);
    formData.append('image', selectedImage.value);

    const formDataObject = {};
    for (let key of formData.keys()) {
        formDataObject[key] = formData.get(key);
    }
    console.log(formDataObject);

    // Send PUT request to the API to update the product
    axios.post(`/products/${props.product.id}`, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(response => {
            emits('update:modelValue', false);
        })
        .catch(error => {
            // Handle the error response
            console.error(error);
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
                console.log(errors.value); // Log the validation errors to the console
            }
        });
};


watch(() => props.product, () => {
    form.value = _.clone(props.product);
});
</script>
