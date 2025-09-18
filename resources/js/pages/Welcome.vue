<template>
  <div class="text-center p-10">
    <h1 class="text-4xl font-bold text-blue-600">Bem-vindo ao {{ appName }}</h1>
  </div>
</template>

<script setup>
defineProps({
  appName: String
})
</script>
