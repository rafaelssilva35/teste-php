<template>
    <div class="sm:p-7 p-4">
        <div class="flex w-full items-center mb-7">
            <button
                class="inline-flex mr-3 items-center h-8 pl-2.5 pr-2 rounded-md shadow text-gray-700 dark:text-gray-400 dark:border-gray-800 border border-gray-200 leading-none py-0">
                <svg viewBox="0 0 24 24" class="w-4 mr-2 text-gray-400 dark:text-gray-600" stroke="currentColor"
                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Last 30 days
                <svg viewBox="0 0 24 24" class="w-4 ml-1.5 text-gray-400 dark:text-gray-600" stroke="currentColor"
                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
        </div>

        <table class="w-full text-left">
            <thead>
                <tr class="text-gray-400">
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">Tipo Documento
                    </th>
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">Documento</th>
                    <th
                        class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                        Nome fantasia</th>
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">Contato</th>
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">Ação</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-100">
                <tr v-for="supplier in props.suppliers" :key="supplier.id">
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{ supplier.documents[0]?.type || '-' }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{ supplier.documents[0]?.document_number || '-' }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                        {{ supplier.name }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{ supplier.contacts[0]?.email || '-' }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 flex space-x-2">
                        <!-- Botão Editar -->
                        <a :href="`suppliers/${supplier.id}/edit`" class="text-blue-500 hover:underline">
                            Editar
                        </a>
                        <!-- Botão Deletar -->
                        <button @click="deleteSupplier(supplier.id)" class="text-red-500 hover:underline">
                            Deletar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>


        <div class="flex w-full mt-5 space-x-2 justify-end">
            <a :href="previusButton.url"
                class="inline-flex items-center h-8 w-8 justify-center text-gray-400 rounded-md shadow border border-gray-200 dark:border-gray-800 leading-none">
                <svg class="w-4" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </a>
            <div v-for="(link, i) in props.pagination.links" :href="link.url">
                <a v-if="i > 0 && i != props.pagination.links.length - 1" :href="link.url"
                    class="inline-flex items-center h-8 w-8 justify-center text-gray-500 rounded-md shadow border border-gray-200 dark:border-gray-800 leading-none"
                    :class="{
                        'leading-none': !link.url,
                        'bg-gray-100 dark:bg-gray-800 dark:text-white leading-none': link.active,
                    }">
                    <span>
                        {{ link.label }}
                    </span>
                </a>
            </div>
            <a :href="nextButton.url"
                class="inline-flex items-center h-8 w-8 justify-center text-gray-400 rounded-md shadow border border-gray-200 dark:border-gray-800 leading-none">
                <svg class="w-4" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </div>
    </div>
</template>

<script setup>
import { defineProps, onMounted, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';


const props = defineProps({
    suppliers: {
        type: Array,
        required: true
    },
    pagination: {
        type: Object,
        required: true
    }
});
const suppliers = ref([]);
const pagination = ref(Object);

const previusButton = ref({ url: null, label: "&laquo; Previous" });
const nextButton = ref({ url: null, label: "Next &raquo;" });

onMounted(() => {
    const previousLink = props.pagination.links.find(
        (link) => link.label.includes("&laquo;")
    );

    const nextLink = props.pagination.links.find(
        (link) => link.label.includes("&raquo;")
    );

    if (nextLink) {
        nextButton.value = nextLink;
    }

    if (previousLink) {
        previusButton.value = previousLink;
    }
});

// Função para deletar o fornecedor
const deleteSupplier = async (id) => {
    if (confirm('Tem certeza que deseja deletar este fornecedor?')) {
        const retorno = await Inertia.delete(`/suppliers/${id}`);
        window.location.reload();
    }
};
</script>