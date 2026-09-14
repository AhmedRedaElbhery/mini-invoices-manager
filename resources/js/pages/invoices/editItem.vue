<template>
    <NavBar></NavBar>
    <div class="w-[80%] mx-auto p-3">
        <div class="flex justify-self-center text-2xl font-bold mt-4">
            <h1>Edit Item</h1>
        </div>
    </div>
    <form @submit.prevent="updateitem(item.id)" class="w-[80%] mx-auto border border-gray-600 p-4">
        <div class="flex">
            <div class="w-[30%] mx-3">

                <label class="block text-lx font-bold">Item Name</label>
                <select v-model="form.product_id" class="w-[100%] border border-gray-400 p-2 mt-3">
                    <option v-for="product in products" :key="product.id" :value="product.id">{{ product.name }}
                    </option>
                </select>

            </div>

            <div class="w-[30%] mx-3">
                <label class="block text-lx font-bold">Quantity</label>
                <input v-model="form.quantity" type="number" class="w-[100%] border border-gray-400 p-2 mt-3"
                    placeholder="Enter Quantity" />
            </div>

            <div class="w-[30%] mx-3">
                <label class="block text-lx font-bold">Description</label>
                <textarea v-model="form.description" class="p-1 w-[100%] border border-gray-600 mt-2.5"></textarea>
            </div>
        </div>

        <div class="w-[30%] mx-3 bg-green-500 text-white rounded justify-self-center mt-5">
            <button type="submit" class="w-[100%] p-3 text-center">Update</button>
        </div>

    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import NavBar from "../layout/navbar.vue";

const props = defineProps({
    products: Object,
    item: Object,
});

const form = useForm({
    product_id: props.item.product_id,
    quantity: props.item.quantity,
    description: props.item.description,
});

function updateitem(id)
{
    form.post(`/invoiceupdateItem/${id}`);
}


</script>