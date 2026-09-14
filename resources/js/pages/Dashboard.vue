<template>
    <NavBar></NavBar>

    <div class="w-[80%] mx-auto mt-10 rounded-lg border border-gray-300">
        <div class="flex p-5">
            <div class="w-[20%] mx-4 ml-10"> <span class="font-bold text-lg mr-2">Total Revenue: </span> {{ (numbers.total_revenue / 100).toFixed(2) }}</div>
            <div class="w-[20%] mx-4"> <span class="font-bold text-lg mr-2">pending Invoices: </span>{{ numbers.pending_invoices }}</div>
            <div class="w-[20%] mx-4"> <span class="font-bold text-lg mr-2">Paid Invoices: </span>{{ numbers.paid_invoices }}</div>
            <div class="w-[20%] mx-4"> <span class="font-bold text-lg mr-2">Overdue Invoices: </span>{{ numbers.overdue_invoices }}</div>
        </div>
    </div>

    <table class="w-[80%] mx-auto mt-10 border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border border-gray-200">Code</th>
                <th class="p-3 border border-gray-200">Customer</th>
                <th class="p-3 border border-gray-200">Amount</th>
                <th class="p-3 border border-gray-200">Status</th>
                <th class="p-3 border border-gray-200">Due Date</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="invoice in invoices" :key="invoice.id">
                <td class="p-3 border border-gray-200 text-center">
                    <Link :href="`/invoice/${invoice.id}`" class="text-blue-600 underline px-2" >{{ invoice.invoice_code }}</Link>
                </td>

                <td class="p-3 border border-gray-200 text-center">
                    {{ invoice.customer_name }}
                </td>

                <td class="p-3 border border-gray-200 text-center">
                    {{ (invoice.total_cost / 100).toFixed(2) }}
                </td>

                <td class="p-3 border border-gray-200 text-center">
                    {{ invoice.status_type }}
                </td>

                <td class="p-3 border border-gray-200 text-center">
                    {{ invoice.due_date }}
                </td>
            </tr>
        </tbody>
    </table>

</template>

<script setup>
import NavBar from './layout/navbar.vue'
import { Link } from '@inertiajs/vue3';

defineProps({
    invoices: Object,
    numbers: Object,
})
</script>