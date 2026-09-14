<template>
    <div class="no-print">
        <NavBar></NavBar>

        <div v-if="$page.props.flash.success" class="w-[80%] mx-auto bg-green-600 text-white font-bold p-3">
            {{ $page.props.flash.success }}
        </div>

        <div v-if="$page.props.flash.error" class="w-[80%] mx-auto bg-red-600 text-white font-bold p-3">
            {{ $page.props.flash.error }}
        </div>
    </div>

    <div class="w-[80%] mx-auto mt-2 px-4 py-2 border border-gray-300 print-area">
        <div class="flex justify-between">
            <div class="w-[40%]">
                <p class="my-4">
                    <span class="text-lg font-bold mr-2">Invoice Number:</span>
                    {{ invoice.invoice_code }}
                </p>

                <p class="my-4">
                    <span class="mt-4 text-lg font-bold mr-2">Invoice Date:</span>
                    {{ invoice.invoice_date }}
                </p>

                <p>
                    <span class="mt-4 text-lg font-bold mr-2">Due Date:</span>
                    {{ invoice.due_date }}
                </p>
            </div>

            <div class="w-[35%]">
                <p class="my-2">
                    <span class="mr-2 text-lg font-bold">Customer Name:</span>
                    {{ customer.name }}
                </p>

                <p v-if="`${customer.email}`" class="my-3">
                    <span class="text-lg font-bold mr-2">Email:</span>
                    {{ customer.email }}
                </p>

                <p class="my-3">
                    <span class="text-lg font-bold mr-2">Address:</span>
                    {{ customer.address }}
                </p>

                <p class="my-3">
                    <span class="text-lg font-bold mr-2">City & Country:</span>
                    {{ customer.city }} , {{ customer.country }}
                </p>
            </div>
        </div>

        <table class="w-[90%] mx-auto my-2 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Item Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Unit Price</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Total Price</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="item in invoice_details" :key="item.id">
                    <td class="border border-gray-300 px-4 py-2">{{ item.product_name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ item.description }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ item.quantity }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ (item.unit_price / 100).toFixed(2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ (item.total / 100).toFixed(2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="flex">
            <div class="w-[55%] justify-self-start my-5 mx-15">
                <div v-for="payment in payments" :key="payment.id" class="border border-gray-300 flex pl-6">
                    <p class="p-3 mr-5 w-[30%]">
                        <span class="text-lg font-bold mr-2">Paid: </span>
                        {{ (payment.total / 100).toFixed(2) }}
                    </p>
                    <p class="p-3 w-[50%]">
                        <span class="text-lg font-bold mr-2">Paid At: </span>
                        {{ payment.date }}
                    </p>
                </div>
            </div>

            <div class="w-[20%] justify-self-end my-5 mx-25">
                <div class="border border-gray-300 block">
                    <p class="p-3">
                        <span class="text-lg font-bold mr-2">Sub Total: </span>
                        {{ (invoice.subtotal / 100).toFixed(2) }}
                    </p>
                </div>

                <div class="border border-gray-300 block">
                    <p class="p-3">
                        <span class="text-lg font-bold mr-2">Discount: </span>
                        {{ invoice.discount }} %
                    </p>
                </div>

                <div class="border border-gray-300 block">
                    <p class="p-3">
                        <span class="text-lg font-bold mr-2">Total: </span>
                        {{ (invoice.total_cost / 100).toFixed(2) }}
                    </p>
                </div>

                <div class="border border-gray-300 block">
                    <p class="p-3"><span class="text-lg font-bold">Paid: </span>{{ ((total_paid) /100).toFixed(2) }}</p>
                </div>

                <div class="border border-gray-300 block">
                    <p class="p-3"><span class="text-lg font-bold">Should be Paid: </span>{{ ((invoice.total_cost - total_paid) /100).toFixed(2) }}</p>
                </div>
            </div>
        </div>

        <div class="px-5 flex no-print">
            <Link v-if="total_paid <= 0 && invoice.status != 4" :href="`/invoice/${invoice.id}/edit`" class="bg-blue-700 text-white px-4 py-2 mx-3">Edit</Link>
            <Link @click="deleteItem(invoice.id)" class="bg-red-700 text-white p-2 mx-3">Delete</Link>
            <button v-if="total_paid != invoice.total_cost && invoice.status != 4" @click="makePaid(invoice.id)" class="bg-green-700 text-white p-2 mx-3">Mark As Paid</button>

            <button @click="printInvoice" class="bg-gray-800 text-white p-2 mx-3 cursor-pointer">
                Print Invoice
            </button>
        </div>
    </div>
</template>

<script setup>
import NavBar from "../layout/navbar.vue";
import { Link, router } from "@inertiajs/vue3";

defineProps({
    invoice: Object,
    customer: Object,
    invoice_details: Object,
    payments: Object,
    total_paid: Object,
});

function deleteItem(id) {
    if (confirm('are you sure you want to delete this invoice?')) {
        router.delete(`/invoice/${id}`);
    }
}

function makePaid(id) {
    router.post(`/invoicemakepaid/${id}`);
}

function printInvoice() {
    window.print();
}
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
}
</style>