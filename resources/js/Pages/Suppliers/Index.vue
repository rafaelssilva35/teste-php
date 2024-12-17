<template>
  <supplier-list-section :suppliers="suppliers.data" :pagination="suppliers.meta"></supplier-list-section>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
//   import Pagination from '@/Shared/Pagination.vue'; // Componente de paginação
import { Head, Link } from '@inertiajs/inertia-vue3';
import Header from '../../Components/organisms/Header.vue'
import SupplierListSection from '../../Components/organisms/SupplierListSection.vue';
  export default {
  props: {
    suppliers: Object,
    filters: Object,
  },
  components: {
    Head,
    Link,
    Header,
    SupplierListSection
  },
  methods: {
    deleteSupplier(id) {
      if (confirm('Are you sure you want to delete this supplier?')) {
        Inertia.delete(`/suppliers/${id}`);
      }
    },
  },
};
</script>

<style scoped>
/* Seus estilos aqui */
</style>