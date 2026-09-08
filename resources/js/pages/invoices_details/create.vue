<template>
    <NavBar></NavBar>

    <div class="w-[80%] mx-auto mt-10">
        <div class="justify-self-center">
            <p class="font-bold text-xl mr-2">
                Add Item To Invoice number: {{ $page.props.invoice_number }}
            </p>
        </div>

        <form
            @submit.prevent="store"
            class="w-[80%] mx-auto border border-gray-600 p-3 mt-5"
        >
            <div class="flex">
                <div class="w-[50%] py-2">
                    <label class="text-lg font-bold block">Items</label>
                    <select
                        class="w-[70%] border border-gray-600 mt-2 rounded px-3 py-1.5"
                        v-model="form.product_id"
                    >
                        <option value="" disabled>Select Item</option>
                        <option
                            v-for="product in products"
                            :key="product.id"
                            :value="product.id"
                        >
                            {{ product.name }}
                        </option>
                    </select>
                    <div class="text-red-600" v-if=" page.props.errors.product_id " > {{ page.props.errors.product_id }}</div>

                </div>

                <div class="w-[50%] py-2">
                    <label class="text-lg font-bold block">Quantity</label>
                    <input
                        v-model="form.quantity"
                        class="w-[70%] border border-gray-600 mt-2 rounded px-3 py-1.5"
                    />

                    <div class="text-red-600" v-if=" page.props.errors.quantity " > {{ page.props.errors.quantity }}</div>

                </div>

            </div>

            <div class="flex">
                <div
                    class=" mx-auto rounded-lg bg-green-600 text-white p-2 my-3"
                >
                    <button class="w-[100%] px-25 flex justify-self-center">
                        Add Item To Invoice
                    </button>
                </div>

                <div
                    class="mx-auto rounded-lg bg-gray-600 text-white p-2 my-3"
                >
                    <Link
                        class="w-[100%] px-25 flex justify-self-center"
                        :href="`/invoice/${$page.props.id}/edit`"
                        >Go Back To Invoice</Link
                    >
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import NavBar from "../layout/navbar.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    products: Object,
});

const page = usePage();

const form = useForm({
    product_id: "",
    quantity: "",
    invoice_id: page.props.id,
});

function store() {
    form.post("/invoicedetails");
}
</script>
