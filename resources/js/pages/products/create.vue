<template>
    <NavBar></NavBar>

    <div class="w-[75%] container mx-auto justify-items-center">
        <div class="my-5">
            <h1 class="text-xl font-bold">create New Product/Service</h1>
        </div>
        <form
            class="w-[80%] mx-auto mt-10 p-6 border border-gray-300 rounded-lg"
            @submit.prevent="create"
        >
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block mb-2 font-semibold"> Name </label>

                    <input
                        v-model="form.name"
                        class="w-[100%] p-2"
                        type="text"
                        name="name"
                        placeholder="Enter Name"
                    />
                    <div v-if="form.errors.name" class="text-red-600">
                        {{ form.errors.name }}
                    </div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Type
                    </label>

                    <select
                        v-model="form.type"
                        class="w-[100%]  border border-gray-300  px-1 py-2 text-gray-700"
                    >
                        <option value="" disabled>Select Type</option>
                        <option value="0">Product</option>
                        <option value="1">Service</option>
                    </select>

                    <div
                        v-if="form.errors.type"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.type }}
                    </div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Description
                    </label>

                    <textarea
                        v-model="form.description"
                        class="w-[100%] h-[100px]"
                        type="text"
                        name="description"
                        placeholder="Enter description (Optional)"
                    >
                    </textarea>
                    <div v-if="form.errors.description" class="text-red-600">
                        {{ form.errors.description }}
                    </div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold"> Unit Price </label>

                    <input
                        v-model="form.price"
                        class="w-[100%] p-2"
                        type=""
                        name="price"
                        placeholder="Enter price"
                    />
                    <div v-if="form.errors.price" class="text-red-600">
                        {{ form.errors.price }}
                    </div>
                </div>

            </div>

            <div class="flex justify-center">
                <button
                    type="submit"
                    class="w-[80%] mt-6 px-5 py-2.5 bg-green-600 text-white rounded"
                >
                    Create Product
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import NavBar from "../layout/navbar.vue";

const form = useForm({
    name: "",
    type: "",
    price: "",
    description: "",
});

function create() {
    form.post("/products");
}
</script>
