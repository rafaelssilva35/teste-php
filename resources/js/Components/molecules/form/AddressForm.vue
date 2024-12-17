<template>
    <div class="space-y-2 mb-2 border-b pb-2">
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">CEP</label>
          <input
            v-model="address.zip_code"
            @blur="fetchAddressByCEP"
            type="text"
            placeholder="CEP"
            class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
            required
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo</label>
          <select
            v-model="address.type"
            class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
            required
          >
            <option value="comercial">Comercial</option>
            <option value="residencial">Residencial</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número</label>
          <input
            v-model="address.number"
            type="text"
            placeholder="Número"
            class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
            required
          />
        </div>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rua</label>
        <input
          v-model="address.street"
          type="text"
          placeholder="Rua"
          class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
          required
        />
      </div>
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bairro</label>
          <input
            v-model="address.neighborhood"
            type="text"
            placeholder="Bairro"
            class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
            required
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cidade</label>
          <input
            v-model="address.city"
            type="text"
            placeholder="Cidade"
            class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
            required
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
          <input
            v-model="address.state"
            type="text"
            placeholder="UF"
            maxlength="2"
            class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
            required
          />
        </div>
      </div>
      <button
        type="button"
        @click="removeAddress"
        v-if="canRemove"
        class="text-red-500 hover:text-red-700 text-sm"
      >
        Remover Endereço
      </button>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    address: {
      type: Object,
      required: true
    },
    canRemove: {
      type: Boolean,
      default: true
    },
    index: {
      type: Number,
      required: true
    }
  });
  
  const emit = defineEmits(['remove-address', 'update:address']);
  
  const fetchAddressByCEP = async () => {
    const cep = props.address.zip_code.replace(/\D/g, '');
    if (cep.length === 8) {
      try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();
        if (!data.erro) {
          emit('update:address', {
            ...props.address,
            street: data.logradouro,
            neighborhood: data.bairro,
            city: data.localidade,
            state: data.uf
          });
        } else {
          alert('CEP não encontrado.');
        }
      } catch {
        alert('Erro ao buscar o CEP.');
      }
    }
  };
  
  const removeAddress = () => emit('remove-address', props.index);
  </script>
  