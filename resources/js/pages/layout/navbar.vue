<template>
  <div
    class="bg-black text-white border border-gray-300 p-4 flex items-center justify-between"
  >
    <div>
      <h1 class="font-bold text-lg">Mini Invoice Manager</h1>
    </div>

    <div class="flex items-center gap-5 mr-5">
      <Link
        href="/dashboard"
        :class="
          $page.url === '/dashboard'
            ? 'bg-gray-600 text-white'
            : 'text-gray-300 hover:bg-gray-700 hover:text-white'
        "
        class="px-4 py-2 rounded-lg transition duration-200"
      >
        Dashboard
      </Link>

      <Link
        href="/invoice"
        :class="
          $page.url.startsWith('/invoice')
            ? 'bg-gray-600 text-white'
            : 'text-gray-300 hover:bg-gray-700 hover:text-white'
        "
        class="px-4 py-2 rounded-lg transition duration-200"
      >
        Invoices
      </Link>

      <Link
        href="/customers"
        :class="
          $page.url.startsWith('/customers')
            ? 'bg-gray-600 text-white'
            : 'text-gray-300 hover:bg-gray-700 hover:text-white'
        "
        class="px-4 py-2 rounded-lg transition duration-200"
      >
        Customers
      </Link>

      <Link
        href="/products"
        :class="
          $page.url.startsWith('/products')
            ? 'bg-gray-600 text-white'
            : 'text-gray-300 hover:bg-gray-700 hover:text-white'
        "
        class="px-4 py-2 rounded-lg transition duration-200"
      >
        Products
      </Link>

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
