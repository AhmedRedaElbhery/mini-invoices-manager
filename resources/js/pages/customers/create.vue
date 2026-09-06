<template>
    <NavBar></NavBar>

    <div class="w-[75%] container mx-auto justify-items-center">
        <div class="my-5">
            <h1 class="text-xl font-bold">create New customer</h1>
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
                        placeholder="Enter Customer Name"
                    />
                    <div v-if="form.errors.name" class="text-red-600" >{{ form.errors.name }}</div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold"> Email </label>

                    <input
                    v-model="form.email"
                        class="w-[100%] p-2"
                        type="email"
                        name="email"
                        placeholder="Enter Customer Email (Optional)"
                    />
                    <div v-if="form.errors.email" class="text-red-600" >{{ form.errors.email }}</div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold"> Phone </label>

                    <input
                    v-model="form.phone"
                       class="w-[100%] p-2"
                        type="phone"
                        name="phone"
                        placeholder="Enter Customer Phone"
                    />
                    <div v-if="form.errors.phone" class="text-red-600" >{{ form.errors.phone }}</div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold"> City </label>

                    <input
                    v-model="form.city"
                        class="w-[100%] p-2"
                        type="text"
                        name="city"
                        placeholder="Enter Customer City"
                    />
                    <div v-if="form.errors.name" class="text-red-600" >{{ form.errors.name }}</div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold"> Country </label>

                    <input
                    v-model="form.country"
                        class="w-[100%] p-2"
                        type="text"
                        name="country"
                        placeholder="Enter Customer Country"
                    />
                    <div v-if="form.errors.country" class="text-red-600" >{{ form.errors.country }}</div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold"> Address </label>

                    <input
                    v-model="form.address"
                       class="w-[100%] p-2"
                        type="text"
                        name="address"
                        placeholder="Enter Customer Address"
                    />
                    <div v-if="form.errors.address" class="text-red-600" >{{ form.errors.address }}</div>
                </div>
            </div>

            <div class="flex justify-center">
                <button
                    type="submit"
                    class="w-[80%] mt-6 px-5 py-2.5 bg-green-600 text-white rounded"
                >
                    Create Customer
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import NavBar from "../layout/navbar.vue";


const form = useForm({
    name: '',
    email: '',
    phone: '',
    city: '',
    country: '',
    address: '',
});

function create(){
    form.post('/customers');
}

</script>
