<template>
    <modal-wrapper name="add-modal">
        <template #title>Add Product</template>
        <template #content>
            <form action="#" class="space-y-4">
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Product Name</div>
                    <div class="w-3/4">
                        <input type="text" class="input-text" placeholder="Product Name...">
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Product Category</div>
                    <div class="w-3/4">
                        <Multiselect :options="categories" label="name" value-prop="id"></Multiselect>
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4">Description</div>
                    <div class="w-3/4">
                        <textarea class="input-text" placeholder="Description..."></textarea>
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4">Category</div>
                    <div class="w-3/4">
                        <input type="text" class="input-text" placeholder="Select Category...">
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4">Price</div>
                    <div class="w-3/4">
                        <input type="text" class="input-text" placeholder="Price...">
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4">Quantity</div>
                    <div class="w-3/4">
                        <input type="text" class="input-text" placeholder="Quantity...">
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4">Image</div>
                    <div class="w-3/4">
                        <input type="file">
                    </div>
                </div>
            </form>
        </template>
        <template #footer>
            <button class="btn btn-blue">Add Product</button>
        </template>
    </modal-wrapper>
</template>

<script setup>
import ModalWrapper from "@/Components/ModalWrapper.vue";
import Multiselect from '@vueform/multiselect';
import {onMounted} from "vue";

defineProps({
    categories: {
        type: Array,
        default: []
    }
})

onMounted(() => {

    // const apiToken = '8dd40f2690e0f8e606893bf95bd15ee0f26087801d3c2a28c9d3672079ecf437';
    // console.log(apiToken)
    //
    axios.defaults.headers.common['Authorization'] = `Bearer 3|ukrKHiwBK6dUM3fJ98HKOUeStt8b8bYQSwoLhwKV`;

    axios.get('api/categories/getAll').then(response => console.log(response))
})

</script>
