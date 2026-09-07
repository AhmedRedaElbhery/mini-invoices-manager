<template>
    <NavBar></NavBar>
    <div class="w-[75%] container mx-auto">
        <div
            v-if="$page.props.flash.success"
            class="bg-green-600 text-white font-bold p-3"
        >
            {{ $page.props.flash.success }}
        </div>

        <div class="my-5">
            <h1 class="inline text-2xl font-bold my-5">Products & Services</h1>

            <Link
                href="/products/create"
                class="text-blue-600 flex justify-self-end"
                >add new Product/Service</Link
            >
        </div>

        <table class="w-full border border-gray-300 text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-3">Name</th>
                    <th class="border p-3">Type</th>
                    <th class="border p-3">Price</th>
                    <th class="border p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="product in products.data" :key="product.id">
                    <td class="border p-3">
                        {{ product.name }}
                    </td>

                    <td class="border p-3">
                        <span v-if="product.type == 0"> Product </span>

                        <span v-else-if="product.type == 1"> Service </span>
                    </td>

                    <td class="border p-3">
                        {{ product.unit_price / 100 }}
                    </td>

                    <td>
                        <div class="flex items-center gap-2">

                            <Link :href="`/products/${product.id}/edit`"
                                class="inline-block w-[70px] rounded bg-blue-600 px-3 py-2 text-center text-sm text-white">
                                Edit
                            </Link>

                            <form @submit.prevent="deleteproduct(product.id)">
                                <button type="submit"
                                    class="w-[70px] rounded bg-red-600 px-3 py-2 text-center text-sm text-white">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>

        <div class="flex gap-2 mt-5">
            <Link
                v-for="link in products.links"
                :key="link.label"
                :href="link.url ?? ''"
                v-html="link.label"
                class="px-3 py-2 border rounded"
                :class="{
                    'bg-black text-white': link.active,
                    'text-gray-400': !link.url,
                }"
            />
        </div>
    </div>
</template>

<script setup>
import NavBar from "../layout/navbar.vue";
import { Link, router } from "@inertiajs/vue3";

defineProps({
    products: Object,
});

function deleteproduct(id){
    if (confirm("Are you sure you want to delete this product?")) {
        router.delete(`/products/${id}`);
    }
}

</script>
