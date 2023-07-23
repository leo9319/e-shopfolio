<template>
    <modal-wrapper name="add-modal">
        <template #title>Add Category</template>
        <template #content>
            <form action="#" class="space-y-4">
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Category Name</div>
                    <div class="w-3/4">
                        <input type="text" class="input-text" placeholder="Product Name...">
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4 required">Slug</div>
                    <div class="w-3/4">
                        <input type="text" class="input-text" placeholder="Slug...">
                    </div>
                </div>
                <div class="form-row flex items-center">
                    <div class="w-1/4">Description</div>
                    <div class="w-3/4">
                        <textarea class="input-text" placeholder="Description..."></textarea>
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

</script>
