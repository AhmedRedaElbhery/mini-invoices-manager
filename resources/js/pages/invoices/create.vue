<template>
    <NavBar />

    <div class="w-[80%] mx-auto mt-5 p-4">
        <div>
            <h1 class="mt-4 text-2xl font-bold flex justify-self-center mb-3">
                Create New Invoice
            </h1>
        </div>

        <div class="border border-gray-300 rounded-lg p-5 bg-white shadow-sm">
            <form @submit.prevent="create">
                <div class="flex">
                    <div class="w-[30%] mr-3 mb-4">
                        <label class="block mb-2 font-medium text-gray-700 font-bold text-lg">
                            Customer
                        </label>

                        <select v-model="form.customer_id" class="w-full border border-gray-300 rounded-md p-2.5">
                            <option value="">Choose The Customer</option>

                            <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                {{ customer.name }}
                            </option>
                        </select>

                        <div class="text-red-600" v-if="form.errors.customer_id">
                            {{ form.errors.customer_id }}
                        </div>
                    </div>

                    <div class="w-[30%] mr-3 mb-4">
                        <label class="block mb-2 font-medium text-gray-700 font-bold text-lg">
                            Invoice Date
                        </label>

                        <input v-model="form.invoice_date" type="date"
                            class="w-full border border-gray-300 rounded-md p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                        <div class="text-red-600" v-if="form.errors.invoice_date">
                            {{ form.errors.invoice_date }}
                        </div>
                    </div>

                    <div class="w-[30%] mr-3">
                        <label class="block mb-2 font-medium text-gray-700 font-bold text-lg">
                            Due Date
                        </label>

                        <input v-model="form.due_date" type="date"
                            class="w-full border border-gray-300 rounded-md p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                        <div class="text-red-600" v-if="form.errors.due_date">
                            {{ form.errors.due_date }}
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-300 pt-5">
                    <h2 class="flex justify-self-center text-xl font-bold mb-4">
                        Invoice Items
                    </h2>

                    <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                        <div class="flex gap-4">
                            <div class="w-[30%]">
                                <label class="block mb-2 font-bold text-gray-700">
                                    Product
                                </label>

                                <select v-model="itemForm.product_id"
                                    class="w-full border border-gray-300 rounded-md p-2.5">
                                    <option value="" disabled>Choose Product</option>

                                    <option v-for="product in products" :key="product.id" :value="product.id">
                                        {{ product.name }}
                                    </option>
                                </select>

                                <div v-if="itemForm.errors.product_id" class="text-red-600 mt-1">
                                    {{ itemForm.errors.product_id }}
                                </div>
                            </div>

                            <div class="w-[25%]">
                                <label class="block mb-2 font-bold text-gray-700">
                                    Quantity
                                </label>

                                <input v-model="itemForm.quantity" type="number" min="1"
                                    class="w-full border border-gray-300 rounded-md p-2.5" />

                                <div v-if="itemForm.errors.quantity" class="text-red-600 mt-1">
                                    {{ itemForm.errors.quantity }}
                                </div>
                            </div>

                            <div class="w-[25%]">
                                <label class="block mb-2 font-bold text-gray-700">
                                    Description
                                </label>

                                <input v-model="itemForm.description" type="text"
                                    class="w-full border border-gray-300 rounded-md p-2.5" />

                                <div v-if="itemForm.errors.description" class="text-red-600 mt-1">
                                    {{ itemForm.errors.description }}
                                </div>
                            </div>

                            <div class="w-[20%] flex items-end">
                                <button type="button" @click="addItem"
                                    class="bg-blue-600 text-white rounded-md px-5 py-2.5 w-full">
                                    + Add Item
                                </button>
                            </div>
                        </div>
                    </div>

                    <div v-if="form.items.length > 0" class="mt-5">
                        <table class="w-full border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 p-3 text-left">Product</th>

                                    <th class="border border-gray-300 p-3 text-left">
                                        Description
                                    </th>

                                    <th class="border border-gray-300 p-3 text-left">Quantity</th>

                                    <th class="border border-gray-300 p-3 text-left">
                                        Unit Price
                                    </th>

                                    <th class="border border-gray-300 p-3 text-left">Total</th>

                                    <th class="border border-gray-300 p-3 text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in form.items" :key="index">
                                    <td class="border border-gray-300 p-3">
                                        {{
                                            products.find((product) => product.id == item.product_id)
                                        ?.name
                                        }}
                                    </td>

                                    <td class="border border-gray-300 p-3">
                                        {{ item.description }}
                                    </td>

                                    <td class="border border-gray-300 p-3">
                                        {{ item.quantity }}
                                    </td>

                                    <td class="border border-gray-300 p-3">
                                        {{ item.unit_price }}
                                    </td>

                                    <td class="border border-gray-300 p-3 font-bold">
                                        {{ item.total }}
                                    </td>

                                    <td class="border border-gray-300 p-3">
                                        <button type="button" @click="removeItem(index)"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex my-8">
                            <div class="mx-4 border border-gray-300 rounded-lg p-4 bg-gray-50 w-[30%]">
                                <div class="flex">
                                    <span class="font-bold text-lg mr-4"> Subtotal: </span>

                                    <span class="font-bold text-lg">
                                        {{ subtotal }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex mx-4 border border-gray-300 rounded-lg bg-gray-50 w-[33%]">
                                <span class="mt-4 font-bold text-lg px-2">Discount: </span>
                                <input v-model="form.discount" @input="calculateDiscount" type="text"
                                    class="w-[100%] py-4 px-2 border border-gray-100" placeholder="Enter Number of Discount percent" min="0" max="100" />

                                <div class="text-red-600" v-if="$page.props.errors.discount">{{
                                    $page.props.errors.discount }}</div>
                            </div>

                            <div class="mx-4 border border-gray-300 rounded-lg p-4 bg-gray-50 w-[30%]">
                                <div class="flex">
                                    <span class="font-bold text-lg mr-4"> total: </span>

                                    <span class="font-bold text-lg">
                                        {{ form.total }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-red-600 mt-2" v-if="form.errors.items">
                        {{ form.errors.items }}
                    </div>
                </div>

                <div class="bg-green-600 hover:bg-green-700 text-white mx-auto mt-5 p-2 w-[50%] rounded">
                    <button type="submit" :disabled="form.processing" class="w-[100%] rounded">
                        {{ form.processing ? "Creating..." : "Create Invoice" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import NavBar from "../layout/navbar.vue";

import { useForm } from "@inertiajs/vue3";

import { computed } from "vue";

const props = defineProps({
    customers: Object,
    products: Object,
});

const form = useForm({
    customer_id: "",
    invoice_date: "",
    due_date: "",
    discount: "",
    total: "",

    items: [],
});

const itemForm = useForm({
    product_id: "",
    quantity: "",
    description: "",
});


function addItem() {
    if (!itemForm.product_id || !itemForm.quantity) {
        alert('Enter Product & Quantity');
        return;
    }

    const quantity = Number(itemForm.quantity);

    if (quantity < 1) {
        return;
    }

    const product = props.products.find((product) => product.id == itemForm.product_id);

    if (!product) {
        return;
    }

    const unitPrice = product.unit_price / 100;
    const total = unitPrice * quantity;

    form.items.push({
        product_id: itemForm.product_id,
        quantity: quantity,
        description: itemForm.description,
        unit_price: unitPrice,
        total: total,
    });

    itemForm.product_id = "";
    itemForm.quantity = "";
    itemForm.description = "";

    form.discount = "";
    form.total = "";

    itemForm.clearErrors();
}

function removeItem(index) {
    form.items.splice(index, 1);
    form.discount = "";
    form.total = "";
}

const subtotal = computed(() => {
    let sum = 0;
    for (const item of form.items) {
        sum += Number(item.total);
    }
    return sum;
});


function calculateDiscount(event) {
    const discountPercent = Number(event.target.value);
    if (discountPercent < 0 || discountPercent > 100) {
        return;
    }
    form.discount = discountPercent;
    form.total = subtotal.value - ((subtotal.value * discountPercent) / 100);
}

function create() {
    form.post("/invoice");
}

</script>
