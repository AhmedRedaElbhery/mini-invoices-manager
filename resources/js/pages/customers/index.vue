<template>
    <NavBar></NavBar>
    <div class="w-[75%] container mx-auto">

        <div v-if="$page.props.flash.success" class="bg-green-600 text-white font-bold p-3">
            {{ $page.props.flash.success }}
        </div>

        <div class="my-5">
            <h1 class="inline text-2xl font-bold my-5">Customers</h1>

            <Link href="/customers/create" class="ml-3 text-blue-600"
                >New Customer</Link
            >
        </div>

        <table class="w-full border border-gray-300 text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-3">Name</th>
                    <th class="border p-3">Email</th>
                    <th class="border p-3">Phone</th>
                    <th class="border p-3">Invoices</th>
                    <th class="border p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="customer in customers.data" :key="customer.id">
                    <td class="border p-3">{{ customer.name }}</td>
                    <td class="border p-3">{{ customer.email }}</td>
                    <td class="border p-3">{{ customer.phone }}</td>
                    <td class="border p-3">{{ customer.invoices_number }}</td>
                    <td>
                        <Link
                            href="/customer/edit/{{ custoemr.id }}"
                            class="text-center inline-block w-[60px] py-2 mx-1.5 bg-blue-600 text-white"
                            >Edit</Link
                        >
                        <Link
                            href="/customer/delete/{{ custoemr.id }}"
                            class="text-center p-2.5 mx-1.5 bg-red-600 text-white"
                            >Delete</Link
                        >
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="flex gap-2 mt-5">
            <Link
                v-for="link in customers.links"
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
import { Link } from "@inertiajs/vue3";

defineProps({
    customers: Object,
});
</script>
