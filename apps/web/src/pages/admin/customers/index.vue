
<template>
  <q-page padding>
    <q-list separator>
      <q-item class="row">
        <q-item-section avatar>
          <q-avatar icon="people" />
        </q-item-section>

        <q-item-section>
          <q-input
            stack-label
            v-model="search"
            :label="`Clientes (${paging?.total ?? '..'})`"
            placeholder="Pesquisar"
            clearable
            @keyup.enter="fetchCustomers"
          />
        </q-item-section>

        <q-item-section side>
          <q-btn
            round
            flat
            color="secondary"
            icon="add"
            to="/admin/customers/create"
          />
        </q-item-section>
      </q-item>

      <q-item
        v-for="customer in paging.data"
        :key="customer.id"
      >
        <q-item-section>
          <q-item-label>
            {{ customer.name }}
          </q-item-label>

          <q-item-label caption>
            E-mail: {{ customer.email }}
          </q-item-label>

          <q-item-label caption>
            Telefone: {{ customer.phone || 'Não informado' }}
          </q-item-label>

          <q-item-label caption>
            Data de nascimento:
            {{ customer.birth_date || 'Não informada' }}
          </q-item-label>
        </q-item-section>

        <q-item-section side>
          <q-btn-group rounded flat>
            <q-btn
              flat
              color="primary"
              icon="edit"
              :to="`/admin/customers/${customer.id}`"
            />

            <q-btn
              flat
              color="negative"
              icon="delete"
              @click="confirmToDelete(customer)"
            />
          </q-btn-group>
        </q-item-section>
      </q-item>

      <q-item v-if="!paging.data.length">
        <q-item-section class="text-center text-grey">
          Nenhum cliente encontrado.
        </q-item-section>
      </q-item>

      <q-item>
        <q-item-section class="flex flex-center">
          <q-pagination
            v-model="paging.current_page"
            :max="paging.last_page"
            @update:model-value="fetchCustomers"
          />
        </q-item-section>
      </q-item>
    </q-list>
  </q-page>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { deleteCustomer, getCustomers } from './_api';
import { Dialog, Notify } from 'quasar';

const search = ref('');

const paging = ref({
  data: [],
  total: 0,
  current_page: 1,
  last_page: 1,
});

const fetchCustomers = () => {
  getCustomers({
    page: paging.value.current_page,
    search: search.value,
  })
    .then((data) => {
      paging.value = data;
    })
    .catch((e) => {
      Notify.create({
        type: 'negative',
        message: 'Erro ao carregar clientes',
        caption: e?.response?.data?.message ?? 'Verifique a API',
      });
    });
};

const confirmToDelete = (customer) => {
  Dialog.create({
    title: 'Excluir cliente',
    message: `Confirma a exclusão de ${customer.name}?`,
    cancel: true,
    persistent: true,
  }).onOk(() => {
    deleteCustomer(customer.id)
      .then(() => {
        Notify.create({
          type: 'positive',
          message: 'Cliente excluído com sucesso!',
        });
        fetchCustomers();
      })
      .catch((e) => {
        Notify.create({
          type: 'negative',
          message: 'Falha ao excluir cliente',
          caption: e?.response?.data?.message ?? 'Verifique os logs',
        });
      });
  });
};

onMounted(() => {
  fetchCustomers();
});
</script>
