<template>

     <div class="w-[80%] text-white p-2 mt-1 mx-auto bg-red-600" v-if="$page.props.flash.error">
      {{ $page.props.flash.error }}
    </div>

    <div class="my-5 w-[80%] mx-auto">

    <h1 class="w-[100%] font-bold text-xl text-center pt-5">payment</h1>
  </div>

  <div class="w-[50%] mx-auto border border-gray-600 rounded-xl p-3">
    <form @submit.prevent="submit($page.props.id)">
      <div class="w-[100%] mx-auto">
        <div class="flex w-[100%] p-4 mr-2">
          <label class="mt-1 mr-5 px-0 font-bold text-lg">Should be Paid</label>
          <input
            readonly
            :value="($page.props.should_be_paid / 100).toFixed(2)"
            type="text"
            class="w-[79%] p-1.5 border border-gray-400"
          />
        </div>

        <div class="flex w-[100%] p-4 mr-2">
          <label class="mr-5 mt-1 font-bold text-lg">Amount</label>
          <input
            v-model="form.amount"
            type="text"
            name="amount"
            min="1"
            class="w-[100%] p-1.5 border border-gray-400"
          />
        </div>
        <div
          class="w-[70%] text-red-600 mx-auto"
          v-if="$page.props.errors.amount"
        >
          {{ $page.props.errors.amount }}
        </div>

        <div class="flex w-[100%] p-4 mr-2">
          <label class="mr-8 ml-5 mt-2 font-bold text-lg">Date</label>
          <input
            v-model="form.date"
            type="date"
            name="date"
            class="w-[100%] p-1.5 border border-gray-400"
          />
        </div>
        <div
          class="w-[70%] text-red-600 mx-auto"
          v-if="$page.props.errors.date"
        >
          {{ $page.props.errors.date }}
        </div>
      </div>

      <div class="flex my-5">
        <button
          type="submit"
          class="w-[80%] mx-auto p-2.5 mt-4 rounded-lg bg-blue-600 text-white"
        >
          Pay
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { router, useForm } from "@inertiajs/vue3";

const form = useForm({
  amount: "",
  date: "",
});

function submit(id) {
  form.post(`/invoicepay/${id}`);
}
</script>