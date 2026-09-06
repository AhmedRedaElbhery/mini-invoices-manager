<template>
    <form
        @submit.prevent="login"
        class="w-[350px] justify-self-center mt-20 p-6 border border-gray-300 rounded-lg"
    >
        <h1 class="justify-self-center text-xl my-3 font-bold">Login</h1>

        <div class="my-5">
            <label class="font-bold"> Email </label>

            <input
                v-model="form.email"
                class="mt-3 p-3 w-[100%]"
                type="email"
                name="email"
                placeholder="Enter Your Email"
            />

            <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                <p>{{ form.errors.email }}</p>
            </div>

        </div>

        <div class="my-5">
            <label class="font-bold"> Password </label>

            <input
                v-model="form.password"
                class="mt-3 p-3 w-[100%]"
                type="password"
                name="password"
                placeholder="Enter Your password"
            />
        </div>

        <div class="flex items-center gap-4">
            <button
                type="submit"
                class="px-5 py-2.5 bg-blue-600 text-white rounded-md"
            >
                Login
            </button>

            <Link href="/register" class="text-blue-600"> Register </Link>
        </div>
    </form>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
});

function login() {
    form.post("/login");
}
</script>
