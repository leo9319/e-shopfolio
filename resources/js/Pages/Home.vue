<template>

    <Head title="Home"></Head>

    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-2 sm:flex py-3 dark:invert dark:opacity-75">
                                <img src="/images/logo2x.png" alt="">
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6" v-if="$page.props.auth.user">
                            <!-- Settings Dropdown -->

                            <div class="flex items-center space-x-2">
                                <!-- Shopping cart icon -->
                                <i class="lni lni-cart text-2xl text-gray-600 dark:text-gray-400"></i>
                            </div>

                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile</DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <div v-else class="my-auto">
                            <Link
                                :href="route('login')"
                                class="font-semibold hover:text-gray-900 text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Log in
                            </Link
                            >

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="ml-4 font-semibold hover:text-gray-900 text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Register
                            </Link
                            >
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden" v-if="$page.props.auth.user">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                    v-if="$page.props.auth.user"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Admin Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile</ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>
            <main>
                <div tabindex="0" class="focus:outline-none">
                    <div class="mx-auto container">
                        <div class="flex flex-wrap items-center lg:justify-between justify-center">
                            <div tabindex="0" class="focus:outline-none mx-2 w-72 xl:mb-0 my-8" v-for="product in products.data">
                                <div>
                                    <img alt="person capturing an image" src="https://cdn.tuk.dev/assets/templates/classified/Bitmap (1).png" tabindex="0" class="focus:outline-none w-full h-44" />
                                </div>
                                <div class="bg-white h-44">
                                    <div class="flex items-center justify-between px-4 pt-4">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" tabindex="0" class="focus:outline-none" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="Mee9 4h6a2 2 0 0 1 2 2v14l-5-3l-5 3v-14a2 2 0 0 1 2 -2"></path>
                                            </svg>
                                        </div>
                                        <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                                            <button class="focus:outline-none text-xs text-yellow-700 cursor-pointer" @click.prevent="addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="flex items-center">
                                            <h2 tabindex="0" class="focus:outline-none text-lg font-semibold cursor-pointer hover:underline">{{ product.name }}</h2>
                                            <p tabindex="0" class="focus:outline-none text-xs text-gray-600 pl-5">4 days ago</p>
                                        </div>
                                        <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-2">{{ product.description }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center lg:justify-between justify-center pb-10 mt-16">
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import {Head, Link} from '@inertiajs/vue3';
import {ref, getCurrentInstance} from "vue";
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Swal from 'sweetalert2';

const showingNavigationDropdown = ref(false);
const instance = getCurrentInstance();

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    products: Object
});

const addToCart = () => {

    if(instance.proxy.$page.props.auth.user === null) {
        Swal.fire({
            title: 'Please log in/register to add to cart!',
            html: `<div class="py-4"><a href="/login" type="text" class="rounded">Log in</a> <a href="/register" class="rounded">Register</a></div>`,
            showConfirmButton: false
        })
    }


}
</script>

