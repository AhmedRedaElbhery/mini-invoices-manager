<template>
    <NavBar></NavBar>

    <div class="w-[80%] container mx-auto justify-items-center">
        <div class="my-5">
            <h1 class="text-xl font-bold">customer Details</h1>
        </div>
    </div>

    <div class="w-[80%] mx-auto border border-gray-400 p-3">
        <div class="flex mt-3">
            <div class="flex w-[30%] text-lg mx-5 p=2">
                <span class="block mb-2 mr-3 font-bold mr-3"> Name: </span>
                {{ customer.name }}
            </div>

            <div class="w-[30%] text-lg mx-5 flex p=2">
                <span class="block mb-2 font-bold mr-3"> Email: </span>
                {{ customer.email }}
            </div>

            <div class="w-[30%] text-lg mx-5 flex p=2">
                <span class="block mb-2 font-bold mr-3"> Phone: </span>{{ customer.phone }}
            </div>
        </div>

        <div class="flex mt-5">
            <div class="w-[30%] text-lg mx-5 flex p=2">
                <span class="block mb-2 font-bold mr-3"> City: </span>{{ customer.city }}
            </div>

            <div class="w-[30%] text-lg mx-5 flex p=2">
                <span class="block mb-2 font-bold mr-3"> Country :</span>{{ customer.country }}
            </div>

            <div class="w-[30%] text-lg mx-5 flex p=2">
                <span class="block mb-2 font-bold mr-3"> Address: </span>{{ customer.address }}
            </div>
        </div>

        <table class="w-[95%] mx-auto my-8 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Invoice Code
                    </th>

                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>

                    <th class="border border-gray-300 px-4 py-2 text-left">Paid At</th>

                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Total Price
                    </th>

                    <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="invoice in invoices" :key="invoice.id">
                    <td class="border border-gray-300 px-4 py-2">
                        {{ invoice.invoice_code }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ invoice.status_type }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ invoice.paid_at }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ (invoice.total_cost).toFixed(2) }}
                    </td>

                    <td class="border border-gray-300 px-4 py-2">
                        <button @click="show(invoice.id)" class="bg-gray-600 text-white px-3 py-1.5">
                            Show Invoice
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import NavBar from "../layout/navbar.vue";
import { Link } from "@inertiajs/vue3";

const page = usePage();

defineProps({
    customer: Object,
    invoices: Object,
});

function show(id)
{
    router.get(`/invoice/${id}`);
}
</script>
