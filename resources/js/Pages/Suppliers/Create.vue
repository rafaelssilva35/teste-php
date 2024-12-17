<template>
  <div class="p-6 bg-white dark:bg-gray-900 rounded-lg shadow-md mx-auto max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Cadastrar Fornecedor</h1>

    <!-- Formulário -->
    <form @submit.prevent="validateAndSubmit" class="space-y-6">
      <!-- Nome -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
        <input
          id="name"
          v-model="form.name"
          type="text"
          placeholder="Digite o nome do fornecedor"
          class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
          required
        />
      </div>

      <!-- Documentos -->
      <div class="border-t pt-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Documentos</h2>
        <div v-for="(document, index) in form.documents" :key="index" class="flex items-center space-x-4 mb-2">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo</label>
            <select
              v-model="document.type"
              class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
              required
            >
              <option value="CPF">CPF</option>
              <option value="CNPJ">CNPJ</option>
            </select>
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número</label>
            <input
              v-model="document.document_number"
              type="text"
              placeholder="Número do documento"
              class="w-full mt-1 p-2 border rounded-md focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
              required
            />
          </div>
          <button
            type="button"
            @click="removeDocument(index)"
            v-if="form.documents.length > 1"
            class="text-red-500 hover:text-red-700 text-sm"
          >
            Remover
          </button>
        </div>
        <button
          type="button"
          @click="addDocument"
          v-if="form.documents.length < 2"
          class="text-blue-500 text-sm mt-2"
        >
          + Adicionar Documento
        </button>
        <p v-if="form.documents.length >= 2" class="text-sm text-red-500 mt-1">
          Limite de 2 documentos atingido.
        </p>
      </div>

      <!-- Endereços -->
      <div class="border-t pt-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Endereços</h2>
        <AddressForm
          v-for="(address, index) in form.addresses"
          :key="index"
          :address="address"
          :index="index"
          :canRemove="form.addresses.length > 1"
          @remove-address="removeAddress"
          @update:address="updateAddress(index, $event)"
        />
        <button
          type="button"
          @click="addAddress"
          v-if="form.addresses.length < 2"
          class="text-blue-500 text-sm mt-2"
        >
          + Adicionar Endereço
        </button>
        <p v-if="form.addresses.length >= 2" class="text-sm text-red-500 mt-1">
          Limite de 2 endereços atingido.
        </p>
      </div>

      <!-- Contatos -->
      <div class="border-t pt-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Contatos</h2>
        <ContactForm
          v-for="(contact, index) in form.contacts"
          :key="index"
          :contact="contact"
          :index="index"
          :canRemove="form.contacts.length > 1"
          @remove-contact="removeContact"
          @update:contact="updateContact(index, $event)"
        />
        <button
          type="button"
          @click="addContact"
          class="text-blue-500 text-sm mt-2"
        >
          + Adicionar Contato
        </button>
      </div>

      <!-- Botão de Envio -->
      <div class="flex justify-end">
        <button
          type="submit"
          class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-md"
        >
          Salvar Fornecedor
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AddressForm from '../../Components/molecules/form/AddressForm.vue';
import ContactForm from '../../Components/molecules/form/ContactForm.vue';

const form = useForm({
  name: '',
  addresses: [
    { type: 'residencial', street: '', number: '', complement: '', neighborhood: '', city: '', state: '', zip_code: '' }
  ],
  contacts: [{ name: '', email: '', phone: '' }],
  documents: [{ type: 'CPF', document_number: '' }]
});

// Endereços
const addAddress = () => form.addresses.push({ type: '', street: '', number: '', complement: '', neighborhood: '', city: '', state: '', zip_code: '' });
const removeAddress = (index) => form.addresses.splice(index, 1);
const updateAddress = (index, newAddress) => form.addresses.splice(index, 1, newAddress);

// Contatos
const addContact = () => form.contacts.push({ name: '', email: '', phone: '' });
const removeContact = (index) => form.contacts.splice(index, 1);
const updateContact = (index, newContact) => form.contacts.splice(index, 1, newContact);

// Documentos
const addDocument = () => form.documents.push({ type: 'CPF', document_number: '' });
const removeDocument = (index) => form.documents.splice(index, 1);

// Submissão
const validateAndSubmit = () => form.post('/suppliers');
</script>
