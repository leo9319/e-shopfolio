<template>
    <modal-wrapper name="add-modal">
        <template #title>Add Product</template>
        <template #content>
            <form action="#" class="space-y-4">
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Product Name</div>
                    <div class="w-3/4">
                        <input type="text" class="input-text" placeholder="Product Name..." v-model="form.product_name">
                        <form-error :errors="errors" property="name"></form-error>
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
            <button class="btn btn-blue" @click.prevent="addClickHandle">Add Product</button>
        </template>
    </modal-wrapper>
</template>

<script setup>
import ModalWrapper from "@/Components/ModalWrapper.vue";
import Multiselect from '@vueform/multiselect';
import {ref, defineEmits} from "vue";
import FormError from "@/Components/FormError.vue";

defineProps({
    categories: {
        type: Array,
        default: []
    }
});

const selectedImage = ref(null);

const emits = defineEmits(["update:modelValue"]);

const onFileChange = (event) => {
    selectedImage.value = event.target.files[0];
};

const form = ref({
    product_name: '',
    category_id: '',
    description: '',
    price: '',
    quantity: '',
    image: ''
});

const errors = ref([])

const addClickHandle = () => {

    errors.value = [];

    console.log(selectedImage.value)

    const formData = new FormData();
    formData.append('name', form.value.product_name);
    formData.append('category_id', form.value.category_id);
    formData.append('description', form.value.description);
    formData.append('price', form.value.price);
    formData.append('quantity', form.value.quantity);
    formData.append('image', selectedImage.value);


    axios.post('/products', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(response => {
            console.log(response)
            form.value = [];
            selectedImage.value = '';
            emits('update:modelValue', false);
        })
        .catch(error => {
            errors.value = error.response.data.errors;
        });
}

</script>
