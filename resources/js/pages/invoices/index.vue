<template>
    <NavBar></NavBar>

    <div v-if="$page.props.flash.success" class="w-[70%] mx-auto bg-green-600 text-white font-bold p-3">
            {{ $page.props.flash.success }}
        </div>

    <div class="w-[70%] mx-auto mt-5 p-3">
        <div>
            <h1 class="mt-4 text-2xl font-bold">Invoices</h1>
            <Link
                href="/invoice/create"
                class="text-blue-600 mb-2 flex justify-self-end"
                >Create New Invoice</Link
            >
        </div>

        <table class="w-[100%] border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border border-gray-200">Code</th>
                    <th class="p-3 border border-gray-200">Customer</th>
                    <th class="p-3 border border-gray-200">Amount</th>
                    <th class="p-3 border border-gray-200">Status</th>
                    <th class="p-3 border border-gray-200">Due Date</th>
                    <th class="p-3 border border-gray-200">Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="invoice in invoices.data" :key="invoice.id">
                    <td class="p-3 border border-gray-200">
                        {{ invoice.invoice_code }}
                    </td>
                    <td class="p-3 border border-gray-200">
                        {{ invoice.customer_name }}
                    </td>
                    <td class="p-3 border border-gray-200">
                        {{ invoice.total_cost }}
                    </td>
                    <td class="p-3 border border-gray-200">
                        {{ invoice.status_type }}
                    </td>
                    <td class="p-3 border border-gray-200">
                        {{ invoice.due_date }}
                    </td>
                    <td class="p-3 border border-gray-200">
                        <Link
                            :href="`/invoice/${invoice.id}`"
                            class="p-2.5 m-1 text-white bg-gray-600"
                            >Show</Link
                        >
                        <Link
                            :href="`/invoice/${invoice.id}/edit`"
                            class="p-2.5 m-1 text-white bg-green-600"
                            >Edit</Link
                        >
                        <button
                            @click="deleteinvoice(invoice.id)"
                            class="p-2.5 m-1 text-white bg-red-600"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="flex gap-2 mt-5">
            <Link
                v-for="link in invoices.links"
                :key="link.label"
                :href="link.url ?? ''"
                v-html="link.label"
                class="px-3 py-2 border rounded"
                :class="{
                    'bg-black text-white': link.active,
                    'text-gray-600': !link.url,
                }"
            />
        </div>
    </div>
</template>

<script setup>
import NavBar from "../layout/navbar.vue";
import { Link, router } from "@inertiajs/vue3";

defineProps({
    invoices: Object,
});

function deleteinvoice(id) {
    if (confirm("are you sure you want to delete this invoice?")) {
        router.delete(`invoice/${id}`);
    }
}
</script>
