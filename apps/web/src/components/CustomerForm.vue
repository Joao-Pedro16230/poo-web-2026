
<template>
  <q-form class="q-gutter-y-md">
    <q-input
      outlined
      stack-label
      required
      label="Nome"
      v-model="customer.name"
    />

    <q-input
      outlined
      stack-label
      required
      type="email"
      label="E-mail"
      v-model="customer.email"
    />

    <q-input
      outlined
      stack-label
      label="Telefone"
      v-model="customer.phone"
    />

    <q-input
      outlined
      stack-label
      type="date"
      label="Data de nascimento"
      v-model="customer.birth_date"
    />

    <div class="full-width bg-grey-1 q-py-md">
      <q-btn-group spread flat>
        <q-btn
          flat
          no-caps
          :loading="customer.saving"
          type="submit"
          label="Salvar"
          icon="save"
          color="positive"
        />
      </q-btn-group>
    </div>
  </q-form>
</template>

<script setup>
const customer = defineModel({
  default: () => ({
    id: null,
    name: '',
    email: '',
    phone: '',
    birth_date: '',
    saving: false,
  }),
});
</script>
