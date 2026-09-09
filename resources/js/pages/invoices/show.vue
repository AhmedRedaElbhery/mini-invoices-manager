<template>
    <NavBar></NavBar>

    <div class="w-[80%] mx-auto mt-5 p-4 border border-gray-300">
        <div class="flex justify-between">
            <div class="w-[40%]">
                <p class="my-4">
                    <span class="text-lg font-bold mr-2">
                        Invoice Number:
                    </span>
                    {{ invoice.invoice_code }}
                </p>

                <p class="my-4">
                    <span class="mt-4 text-lg font-bold mr-2">
                        Invoice Date:
                    </span>
                    {{ invoice.invoice_date }}
                </p>

                <p>
                    <span class="mt-4 text-lg font-bold mr-2"> Due Date: </span>
                    {{ invoice.due_date }}
                </p>
            </div>

            <div class="w-[35%]">
                <p class="my-2">
                    <span class="mr-2 text-lg font-bold"> Customer Name: </span>
                    {{ customer.name }}
                </p>

                <p v-if="`${customer.email}`" class="my-3">
                    <span class="text-lg font-bold mr-2"> Email: </span>
                    {{ customer.email }}
                </p>

                <p class="my-3">
                    <span class="text-lg font-bold mr-2"> Address: </span>
                    {{ customer.address }}
                </p>

                <p class="my-3">
                    <span class="text-lg font-bold mr-2">
                        City & Country:
                    </span>
                    {{ customer.city }} , {{ customer.country }}
                </p>
            </div>
        </div>

        <table class="w-[90%] mx-auto my-3 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Item Name
                    </th>

                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Description
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
                </tr>
            </thead>

            <tbody>
                <tr v-for="item in invoice_details" :key="item.id">
                    <td class="border border-gray-300 px-4 py-2">{{ item.product_name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ item.description }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ item.quantity }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ item.unit_price /100 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ item.total /100}}</td>
                </tr>
            </tbody>
        </table>

        <div class="w-[15%] block justify-self-end my-10 mx-15">
            <div class="border border-gray-300 block">
                <p class="p-3">
                    <span class="text-lg font-bold mr-2">Sub Total: </span>
                    {{ invoice.subtotal /100 }}
                </p>
            </div>

            <div class="border border-gray-300 block">
                <p class="p-3">
                    <span class="text-lg font-bold mr-2">discount: </span>
                    {{ invoice.discount }} %
                </p>
            </div>

            <div class="border border-gray-300 block">
                <p class="p-3">
                    <span class="text-lg font-bold mr-2">Total: </span>
                    {{ invoice.total_cost /100 }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import NavBar from "../layout/navbar.vue";

defineProps({
    invoice: Object,
    customer: Object,
    invoice_details: Object,
});

</script>
