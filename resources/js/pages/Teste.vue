<template>
  <div class="p-10 text-center">
    <h1 class="text-3xl font-bold text-green-600">{{ mensagem }}</h1>
  </div>
</template>

<script setup>
defineProps({
  mensagem: String
})
</script>
