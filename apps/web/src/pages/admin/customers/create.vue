
<template>
  <q-page padding>
    <q-card>
      <q-card-actions>
        <q-btn
          flat
          no-caps
          icon="arrow_back"
          to="/admin/customers"
          label="Cadastrar cliente"
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
import { ref } from 'vue';
import { createCustomer } from './_api';
import { Notify } from 'quasar';
import { useRouter } from 'vue-router';

const router = useRouter();

const customer = ref({
  name: '',
  email: '',
  phone: '',
  birth_date: '',
  saving: false,
});

const saveCustomer = () => {
  customer.value.saving = true;

  createCustomer({
    name: customer.value.name,
    email: customer.value.email,
    phone: customer.value.phone || null,
    birth_date: customer.value.birth_date || null,
  })
    .then((data) => {
      Notify.create({
        type: 'positive',
        message: 'Cliente cadastrado com sucesso!',
      });

      router.push(`/admin/customers/${data.id}`);
    })
    .catch((e) => {
      Notify.create({
        type: 'negative',
        message: 'Erro ao cadastrar cliente',
        caption: e?.response?.data?.message ?? 'Verifique os dados informados',
      });
    })
    .finally(() => {
      customer.value.saving = false;
    });
};
</script>
