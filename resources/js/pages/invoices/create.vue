<template>
    <NavBar></NavBar>

    <div class="w-[60%] mx-auto mt-5 p-4">
        <div>
            <h1 class="mt-4 text-2xl font-bold flex justify-self-center mb-3">
                Create New Invoice
            </h1>
        </div>

        <div class="border border-gray-300 rounded-lg p-5 bg-white shadow-sm">
            <form @submit.prevent="create">
                <div class="mb-4">
                    <label
                        class="block mb-2 font-medium text-gray-700 font-bold text-lg"
                        >Customer</label
                    >
                    <select
                        v-model="form.customer_id"
                        class="w-full border border-gray-300 rounded-md p-2.5"
                    >
                        <option value="">Choose The Customer</option>
                        <option
                            v-for="customer in customers"
                            :key="customer.id"
                            :value="customer.id"
                        >
                            {{ customer.name }}
                        </option>
                    </select>
                    <div class="text-red-600" v-if="form.errors.customer_id" >{{ form.errors.customer_id }}</div>
                </div>

                <div class="mb-4">
                    <label
                        class="block mb-2 font-medium text-gray-700 font-bold text-lg"
                    >
                        Invoice Date
                    </label>

                    <input
                        v-model="form.invoice_date"
                        type="date"
                        name="invoice_date"
                        class="w-full border border-gray-300 rounded-md p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <div class="text-red-600" v-if="form.errors.invoice_date" >{{ form.errors.invoice_date }}</div>

                </div>

                <div>
                    <label
                        class="block mb-2 font-medium text-gray-700 font-bold text-lg"
                    >
                        Due Date
                    </label>

                    <input
                        v-model="form.due_date"
                        type="date"
                        name="due_date"
                        class="w-full border border-gray-300 rounded-md p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <div class="text-red-600" v-if="form.errors.due_date" >{{ form.errors.due_date }}</div>

                </div>

                <div class="bg-green-600 text-white mx-auto mt-5 p-2 w-[50%]">
                    <button class="flex justify-self-center rounded">
                        Create Invoice
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import NavBar from "../layout/navbar.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({
    customers: Object,
});

const form = useForm({
    customer_id: "",
    invoice_date: "",
    due_date: "",
});

function create() {
    form.post("/invoice");
}
</script>
