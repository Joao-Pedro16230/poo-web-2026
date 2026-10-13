
<template>
  <q-page padding>
    <q-card v-if="customer?.id">
      <q-card-actions>
        <q-btn
          flat
          no-caps
          icon="arrow_back"
          to="/admin/customers"
          label="Editar cliente"
        />
      </q-card-actions>

      <q-card-section>
        <customer-form
          v-model="customer"
          @submit="saveCustomer"
        />
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import CustomerForm from '@/components/CustomerForm.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { getCustomer, updateCustomer } from './_api';
import { Notify } from 'quasar';

const route = useRoute();

const customer = ref(null);

const saveCustomer = () => {
  if (!customer.value?.id) return;

  customer.value.saving = true;

  updateCustomer(customer.value.id, {
    name: customer.value.name,
    email: customer.value.email,
    phone: customer.value.phone || null,
    birth_date: customer.value.birth_date || null,
  })
    .then(() => {
      Notify.create({
        type: 'positive',
        message: 'Cliente atualizado com sucesso!',
      });
    })
    .catch((e) => {
      Notify.create({
        type: 'negative',
        message: 'Erro ao atualizar cliente',
        caption: e?.response?.data?.message ?? 'Verifique os dados informados',
      });
    })
    .finally(() => {
      customer.value.saving = false;
    });
};

onMounted(() => {
  getCustomer(route.params.id)
    .then((data) => {
      customer.value = {
        ...data,
        birth_date: data.birth_date
          ? String(data.birth_date).substring(0, 10)
          : '',
        saving: false,
      };
    })
    .catch((e) => {
      Notify.create({
        type: 'negative',
        message: 'Erro ao carregar cliente',
        caption: e?.response?.data?.message ?? 'Cliente não encontrado',
      });
    });
});
</script>
