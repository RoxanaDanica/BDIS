<script setup lang="ts">
import DeleteButton from '@/components/DeleteButton.vue';
import MainButton from '@/components/MainButton.vue';
import PatientsSearch from '@/components/PatientsSearch.vue';
import AppLayout from '@/layouts/AppLayout.vue';

import Button from 'primevue/button'

</script>

<template>
    <AppLayout>
        <div>
            <PatientsSearch />
            <p>Gestionare pacienti</p>
        </div>
        <div>
            <p>Lista pacientilor</p>
            <MainButton>Adauga pacient</MainButton>
            <DeleteButton>Sterge pacient</DeleteButton>
        </div>
        <div>
            <Button label="Click me" />
            <DataTable  stripedRows tableStyle="min-width: 50rem">
                <Column field="code" header="Code"></Column>
                <Column field="name" header="Name"></Column>
                <Column field="category" header="Category"></Column>
                <Column field="quantity" header="Quantity"></Column>
            </DataTable>
        </div>
    </AppLayout>
</template>