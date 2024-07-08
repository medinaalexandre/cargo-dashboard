<script setup lang="ts">
import { Container } from '@/entities/Container';
import { useQuery } from '@tanstack/vue-query';
import { inject, reactive, ref, watch } from 'vue';
import { ContainerListRequest } from '@/entities/Containers.types';
import { FilterOptions } from '@/types';

const sideBarFilters: FilterOptions = inject('filters') as FilterOptions;
const pagination: ContainerListRequest = reactive<ContainerListRequest>({
    per_page: 10,
    page: 1,
});

const fetchData = async () =>
    await Container.list({ ...pagination, ...sideBarFilters });
const { isLoading, data } = useQuery({
    queryKey: ['container', [sideBarFilters, pagination]],
    queryFn: fetchData,
    staleTime: 30 * 1000,
    gcTime: 30 * 1000,
});

const selectedPackingList = ref('');
const showSelectedPackingListModal = ref(false);

const openPackingListModal = (content: string) => {
    selectedPackingList.value = content;
    showSelectedPackingListModal.value = true;
};

watch(sideBarFilters, () => {
    pagination.page = 1;
});

const headers = [
    { title: 'ID', value: 'id' },
    { title: 'Etiqueta', value: 'label' },
    { title: 'Origem', value: 'origin' },
    { title: 'Destino', value: 'destination' },
    { title: 'Status', value: 'inspection_status' },
    { title: 'Empresa', value: 'company' },
    { title: 'Itens', value: 'items_count' },
    { title: 'Chegada', value: 'arrival_at' },
    { title: 'Saída', value: 'departure_at' },
    { title: 'Tamanho', value: 'capacity' },
    { title: 'Peso', value: 'weight' },
    { title: 'Romaneio', value: 'packing_list' },
];

const getStatusColor = (status: string) => {
    const map: Record<string, string> = {
        Aprovado: 'green-accent-1',
        Pendente: 'light-blue-accent-1',
        Rejeitado: 'red-accent-1',
    };

    return map[status] ?? 'grey-lighten-1';
};
</script>

<template>
    <v-container fluid>
        <h1>Containers</h1>
        <v-data-table-server
            :page="pagination.page"
            :items-length="data?.total ?? 0"
            :items-per-page-options="[10, 25, 30, 50, 100]"
            :headers="headers"
            :items="data?.data ?? []"
            :loading="isLoading"
            @update:items-per-page="
                (per_page) => (pagination.per_page = per_page)
            "
            @update:page="(page) => (pagination.page = page)"
            no-filter
            disable-sort
            fixed-header
        >
            <template #[`item.inspection_status`]="{ item }">
                <v-chip
                    size="small"
                    :color="getStatusColor(item.inspection_status)"
                    >{{ item.inspection_status }}</v-chip
                >
            </template>
            <template #[`item.packing_list`]="{ item }">
                <v-btn
                    icon="mdi-file-document"
                    @click="openPackingListModal(item.packing_list)"
                />
            </template>
        </v-data-table-server>
        <v-dialog v-model="showSelectedPackingListModal">
            <v-card title="Romaneio" :text="selectedPackingList">
                <template #actions>
                    <v-btn
                        text="Fechar"
                        @click="showSelectedPackingListModal = false"
                    />
                </template>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<style scoped></style>
