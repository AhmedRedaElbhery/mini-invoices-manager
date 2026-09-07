<template>
    <NavBar></NavBar>

    <div class="w-[75%] container mx-auto justify-items-center">
        <div class="my-5">
            <h1 class="text-xl font-bold">Edit Product</h1>
        </div>
        <form
            class="w-[80%] mx-auto mt-10 p-6 border border-gray-300 rounded-lg"
            @submit.prevent="update"
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
                    <div v-if="form.errors.name" class="text-red-600" >{{ form.errors.name }}</div>
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
                        placeholder="Enter unit price"
                    />
                    <div v-if="form.errors.price" class="text-red-600">
                        {{ form.errors.price }}
                    </div>
                </div>
            </div>

            <div class="flex">

                <button
                    type="submit"
                    class="w-[45%] mt-6 px-5 py-2.5 bg-green-600 text-white rounded"
                >
                    Update Product
                </button>
                <Link href="/products/" class="w-[45%] mt-6 px-5 py-2.5 ml-3 bg-gray-600 text-white rounded text-center">Cancel</Link>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import NavBar from "../layout/navbar.vue";
import { Link } from "@inertiajs/vue3";

const page = usePage()

const form = useForm({
    name: page.props.product.name,
    type: page.props.product.type,
    price: page.props.product.unit_price / 100,
    description: page.props.product.description,
});

function update(){
    form.put(`/products/${page.props.product.id}`);
}

</script>
