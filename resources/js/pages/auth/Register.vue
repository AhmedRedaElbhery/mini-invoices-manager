<template>
    <div class="w-[500px] mx-auto mt-20 p-6 border border-gray-300 rounded-lg">
        <h1 class="text-center text-2xl font-bold mb-8">Register</h1>

        <form class="w-full" @submit.prevent="register">
            <div class="mb-5">
                <label class="block mb-2 font-semibold"> Name </label>

                <input
                    v-model="form.name"
                    class="w-full p-3 border border-gray-300 rounded-md"
                    type="text"
                    placeholder="Enter Your Name"
                />

                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                    {{ form.errors.name }}
                </div>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-semibold"> Email </label>

                <input
                    v-model="form.email"
                    class="w-full p-3 border border-gray-300 rounded-md"
                    type="email"
                    placeholder="Enter Your Email"
                />
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                    {{ form.errors.email }}
                </div>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-semibold"> Password </label>

                <input
                    v-model="form.password"
                    class="w-full p-3 border border-gray-300 rounded-md"
                    type="password"
                    placeholder="Enter Your Password"
                />
                <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                    {{ form.errors.password }}
                </div>
            </div>

            <button
                class="px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                type="submit"
            >
                Register
            </button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
});

function register() {
    form.post("/register");
}
</script>
