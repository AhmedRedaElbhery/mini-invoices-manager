<template>
    <NavBar></NavBar>

    <div class="w-[80%] mx-auto mt-5 p-4 border border-gray-300">
        <div class="flex justify-self-center my-3">
            <h1 class="my-4">
                <span class="text-xl font-bold mr-2"> Invoice Number: </span>
                {{ invoice.invoice_code }}
            </h1>
        </div>

        <div @click="additem" class="w-[10%] bg-blue-500 text-white p-2 m-5">
            <button>Add new Item</button>
        </div>

        <form @submit.prevent="storeitem" v-if="showItem" class="w-[100%] flex ml-5">
            <div class="w-[25%] mr-4">
                <label class="block font-bold text-lg">Products</label>
                <select v-model="itemForm.product_id" class="p-2 w-[100%] border border-gray-600">
                    <option value="">Select Product</option>
                    <option v-for="product in products" :key="product.id" :value="product.id">
                        {{ product.name }}
                    </option>
                </select>
                <div class="text-red-600" v-if="$page.props.errors.product_id">
                    {{ $page.props.errors.product_id }}
                </div>
            </div>

            <div class="w-[25%] mx-4">
                <label class="block font-bold text-lg">Quantity</label>
                <input v-model="itemForm.quantity" class="p-2 w-[100%] border border-gray-600" />
                <div class="text-red-600" v-if="$page.props.errors.quantity">
                    {{ $page.props.errors.quantity }}
                </div>
            </div>

            <div class="w-[25%] mx-4">
                <label class="block font-bold text-lg">Description</label>
                <input v-model="itemForm.description" class="p-2 w-[100%] border border-gray-600" />
            </div>

            <div class="w-[20%] mx-4">
                <button type="submit" class="bg-green-600 px-3 text-white py-1.5 mx-3 my-5">
                    Add Item
                </button>
                <button @click="hide" class="bg-gray-600 px-3 text-white py-1.5 mx-2 my-5">
                    Cancel
                </button>
            </div>
        </form>

        <!-- <form @submit.prevent="updateitem" v-if="showeditItem" class="w-[100%] flex ml-5">
            <div class="w-[25%] mr-4">
                <label class="block font-bold text-lg">Products</label>
                <select v-model="itemForm.product_id" class="p-2 w-[100%] border border-gray-600">
                    <option value="">Select Product</option>
                    <option v-for="product in products" :key="product.id" :value="product.id">
                        {{ product.name }}
                    </option>
                </select>
                <div class="text-red-600" v-if="$page.props.errors.product_id">
                    {{ $page.props.errors.product_id }}
                </div>
            </div>

            <div class="w-[25%] mx-4">
                <label class="block font-bold text-lg">Quantity</label>
                <input v-model="itemForm.quantity" class="p-2 w-[100%] border border-gray-600" />
                <div class="text-red-600" v-if="$page.props.errors.quantity">
                    {{ $page.props.errors.quantity }}
                </div>
            </div>

            <div class="w-[25%] mx-4">
                <label class="block font-bold text-lg">Description</label>
                <input v-model="itemForm.description" class="p-2 w-[100%] border border-gray-600" />
            </div>

            <div class="w-[20%] mx-4">
                <button type="submit" class="bg-green-600 px-3 text-white py-1.5 mx-3 my-5">
                    Update Item
                </button>
                <button @click="hideEdit" class="bg-gray-600 px-3 text-white py-1.5 mx-2 my-5">
                    Cancel
                </button>
            </div>
        </form> -->

        <table class="w-[100%] mx-auto my-3 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Item Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Description
                    </th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Unit Price</th>

                    <th class="border border-gray-300 px-4 py-2 text-left">
                        Total Price
                    </th>

                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="item in invoice_details" :key="item.id">
                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.item_name }}
                    </td>

                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.description }}
                    </td>

                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.quantity }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.unit_price / 100 }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ item.total / 100 }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <button @click="editItem(item.id)" class="bg-green-600 py-2 px-3 mx-3 text-white">
                            Edit
                        </button>
                        <button @click="deleteitem(item.id)" class="bg-red-600 p-2 text-white">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="p-2">
            <form @submit.prevent="update(invoice.id)" class="w-[100%]">
                <div class="flex justify-between">
                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2">Invoice Date</label>
                        <input type="date" class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            v-model="form.invoice_date" />
                            <div v-if="$page.props.errors.invoice_date" class="text-red-600">{{ $page.props.errors.invoice_date }}</div>
                    </div>

                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2">Due Date</label>
                        <input type="date" class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            v-model="form.due_date" />
                            <div v-if="$page.props.errors.due_date" class="text-red-600">{{ $page.props.errors.due_date }}</div>

                    </div>

                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2">Customer</label>
                        <select class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3" v-model="form.customer_id">
                            <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                {{ customer.name }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.customer_id" class="text-red-600">{{ $page.props.errors.customer_id }}</div>

                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2">discount</label>
                        <input type="number" class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            v-model="form.discount" />
                            <div v-if="$page.props.errors.discount" class="text-red-600">{{ $page.props.errors.discount }}</div>

                    </div>

                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2">status</label>
                        <select v-model="form.status" class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3">
                            <option v-if="form.status == 0" value="0" >Draft</option>
                            <option value="1">Sent</option>
                            <option value="4">Cancel</option>
                        </select>

                        <div v-if="$page.props.errors.status" class="text-red-600">{{ $page.props.errors.status }}</div>

                    </div>

                    <div class="w-[25%]">
                        <label class="block mt-4 text-lg font-bold mr-2">Sub Total</label>
                        <input readonly type="number" class="w-[100%] p-2 border border-gray-600 rounded-lg mt-3"
                            :value="invoice.subtotal / 100" />
                            <div v-if="$page.props.errors.subtotal" class="text-red-600">{{ $page.props.errors.subtotal }}</div>

                    </div>
                </div>

                <div class="w-[70%] mx-auto bg-green-600 text-white p-2 rounded-lg mt-5">
                    <button class="w-[100%] text-center">Update Invoice</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import NavBar from "../layout/navbar.vue";
import { router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const { invoice, customers, invoice_details } = defineProps({
    invoice: Object,
    customers: Object,
    invoice_details: Object,
    products: Object,
});

const form = useForm({
    customer_id: invoice.customer_id,
    invoice_date: invoice.invoice_date,
    due_date: invoice.due_date,
    discount: invoice.discount,
    status: invoice.status,
});

const itemForm = useForm({
    product_id: "",
    quantity: "",
    description: "",
});

function deleteitem(id) {
    if (confirm("are you sure you want to delete this item?")) {
        router.delete(`/invoiceItem/${id}`);
    }
}

const showItem = ref(false);
// const showeditItem = ref(false);

function additem() {
    showItem.value = true;
}

function hide() {
    showItem.value = false;
}

// function hideEdit() {
//     showeditItem.value = false;
// }

function storeitem() {
    itemForm.post(`/invoiceAddItem/${invoice.id}`, {
        onSuccess: () => {
            showItem.value = false;

            itemForm.reset();
        },
    });
}

// function editItem(id) {
//     showeditItem.value = true;
// }


function update(id)
{
    form.put(`/invoice/${id}`);
}


</script>
