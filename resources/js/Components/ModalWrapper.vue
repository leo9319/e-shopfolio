<template>
    <VueFinalModal
        :name="name"
        v-slot="{ close }"
        v-bind="$attrs"
        classes="modal-container"
        :content-class="['modal', width]"
    >
        <transition name="fade">
            <div v-if="isLoading"
                 class="absolute backdrop-blur-sm rounded flex items-center justify-center text-white text-2xl top-0 left-0 h-full w-full bg-gray-500 bg-opacity-70 z-50">
                {{ loadingText }}
                <span class="dot-flashing ml-6"></span>
            </div>
        </transition>
        <div class="modal-header">
            <div class="flex flex-row space-x-4 w-full">
                <div><span class="modal-header-title"><slot name="title">Modal Title</slot></span></div>
                <div class="flex-1 flex flex-row items-center space-x-6 justify-end">
                    <slot name="header-buttons"></slot>
                </div>
            </div>
        </div>
        <div class="modal-content">
            <slot name="content"></slot>
        </div>
        <div class="modal-footer">
            <div>
                <button v-if="!withoutCancel" class="btn btn-gray btn-size-sm" @click="close">{{ closeButtonText }}</button>
            </div>
            <div>
                <slot name="footer"></slot>
            </div>
        </div>
    </VueFinalModal>
</template>

<script>
import {VueFinalModal} from "vue-final-modal";

export default {
    components: {VueFinalModal},
    props: {
        width: {
            type: String,
            default: ''
        },
        loadingText: {
            type: String,
            default: 'Loading',
        },
        isLoading: {
            type: Boolean,
            default: false,
        },
        name: {
            type: String,
            default: 'default'
        },
        withoutCancel: {
            type: Boolean,
            default: false
        },
        closeButtonText: {
            type: String,
            default: 'Cancel'
        }
    },
    name: "ModalWrapper",
    inheritAttrs: false,
}
</script>
