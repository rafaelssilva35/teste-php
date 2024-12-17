<template>
    <div class="h-16 lg:flex w-full border-b border-gray-200 dark:border-gray-800 hidden px-10">
        <div class="flex h-full text-gray-600 dark:text-gray-400">
            <!-- Link Fornecedor -->
            <a 
                :href="'/suppliers'" 
                class="cursor-pointer h-full border-b-2 border-transparent inline-flex items-center mr-8"
                :class="{ 'border-blue-500 text-blue-500 dark:text-white dark:border-white': currentUrl === '/suppliers' }">
                Fornecedor
            </a>

            <!-- Link Adicionar Fornecedor -->
            <a 
                :href="'/suppliers/create'" 
                class="cursor-pointer h-full border-b-2 border-transparent inline-flex items-center mr-8"
                :class="{ 'border-blue-500 text-blue-500 dark:text-white dark:border-white': currentUrl === '/suppliers/create' }">
                Adicionar Fornecedor
            </a>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';

// Obtém a URL atual da página
const currentUrl = usePage().url;
</script>
