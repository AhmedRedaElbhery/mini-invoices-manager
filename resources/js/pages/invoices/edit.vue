<template>
    <NavBar></NavBar>

    <div class="w-[80%] mx-auto mt-5 p-4 border border-gray-300">
        <div class="flex justify-self-center my-3">
            <h1 class="my-4">
                <span class="text-xl font-bold mr-2"> Invoice Number: </span>
                {{ invoice.invoice_code }}
            </h1>
        </div>

        <div class="flex justify-self-start bg-blue-500 text-white p-2 m-5">
            <Link :href="`/invoicedetails/${invoice.id}`">Add new Item</Link>
        </div>

        <table class="w-[100%] mx-auto my-3 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Item Name
                    </th>
                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Quantity
                    </th>
                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Unit Price
                    </th>

                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Total Price
                    </th>

                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="item in invoice_details" :key="item.id">
                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.product_name }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.quantity }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.unit_price }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.total }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2"></td>
                </tr>
            </tbody>
        </table>


        <div class="p-2">
            <form @submit.prevent="update" class="w-[100%]">
                <div class="flex justify-between">
                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2"
                            >Invoice Date</label
                        >
                        <input
                            type="date"
                            class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            v-model="form.invoice_date"
                        />
                    </div>

                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2"
                            >Due Date</label
                        >
                        <input
                            type="date"
                            class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            v-model="form.due_date"
                        />
                    </div>

                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2"
                            >Customer</label
                        >
                        <select
                            class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            v-model="form.customer_id"
                        >
                            <option
                                v-for="customer in customers"
                                :key="customer.id"
                                :value="customer.id"
                            >
                                {{ customer.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2"
                            >discount</label
                        >
                        <input
                            type="number"
                            class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            v-model="form.discount"
                        />
                    </div>

                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2"
                            >status</label
                        >
                        <select
                            class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                        >
                            <option></option>
                        </select>
                    </div>

                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2"
                            >Sub Total</label
                        >
                        <input
                            readonly
                            type="number"
                            class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            v-model="form.subtotal"
                        />
                    </div>
                </div>

                <div
                    class="w-[70%] mx-auto bg-green-600 text-white p-2 rounded-lg mt-5"
                >
                    <button class="flex justify-self-center">
                        Update Invoice
                    </button>
                </div>
            </form>
        </div>


    </div>
</template>

<script setup>
import NavBar from "../layout/navbar.vue";
import { router, useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const { invoice, customers, invoice_details } = defineProps({
    invoice: Object,
    customers: Object,
    invoice_details: Object,
});

const form = useForm({
    customer_id: invoice.customer_id,
    invoice_date: invoice.invoice_date,
    due_date: invoice.due_date,
});

// function deleteitem(id) {
//     if (confirm("are you sure you want to delete this item?")) {
//         router.delete(`/invoicedetaile/${id}`);
//     }
// }
</script>
