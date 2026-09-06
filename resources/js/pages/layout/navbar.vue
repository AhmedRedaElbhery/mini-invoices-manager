<template>
    <div
        class="bg-black text-white border border-gray-300 p-5 flex items-center justify-between"
    >
        <div>
            <h1 class="font-bold text-lg">Mini Invoice Manager</h1>
        </div>

        <div class="flex items-center gap-5 mr-5">
            <Link>Dashboard</Link>
            <Link>Invoices</Link>
            <Link href="/customers" >Customers</Link>
            <Link>Products</Link>

            <form @submit.prevent="logout">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

function logout() {
    router.post("/logout");
}
</script>
