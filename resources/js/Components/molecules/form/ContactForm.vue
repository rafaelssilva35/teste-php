<template>
    <div class="flex items-center space-x-4 mb-2 border-b pb-2">
      <!-- Nome -->
      <div class="flex-1">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
        <input
          v-model="contact.name"
          type="text"
          placeholder="Nome do contato"
          class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
          required
        />
      </div>
  
      <!-- Email -->
      <div class="flex-1">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
        <input
          v-model="contact.email"
          type="email"
          placeholder="Email"
          class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
        />
      </div>
  
      <!-- Telefone -->
      <div class="flex-1">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telefone</label>
        <input
          v-model="contact.phone"
          type="tel"
          placeholder="Telefone"
          class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
        />
      </div>
  
      <!-- Botão de Remover -->
      <button
        type="button"
        @click="removeContact"
        v-if="canRemove"
        class="text-red-500 hover:text-red-700 text-sm"
      >
        Remover
      </button>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    contact: {
      type: Object,
      required: true
    },
    index: {
      type: Number,
      required: true
    },
    canRemove: {
      type: Boolean,
      default: true
    }
  });
  
  const emit = defineEmits(['remove-contact', 'update:contact']);
  
  const removeContact = () => emit('remove-contact', props.index);
  </script>
  