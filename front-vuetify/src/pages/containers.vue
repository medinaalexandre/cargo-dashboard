<script setup lang="ts">
import { Container } from '@/entities/Container';
import { useQuery } from '@tanstack/vue-query';
import { inject, reactive, watch } from 'vue';
import { ContainerListRequest } from '@/entities/Containers.types';
import { FilterOptions } from '@/types';

const sideBarFilters: FilterOptions = inject('filters') as FilterOptions;
const filters: ContainerListRequest = reactive<ContainerListRequest>({
    per_page: 10,
    page: 1,
});

const fetchData = async () =>
    await Container.list({ ...filters, ...sideBarFilters });
const { isLoading, data } = useQuery({
    queryKey: ['container', [sideBarFilters, filters]],
    queryFn: fetchData,
});

watch(sideBarFilters, () => {
    filters.page = 1;
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
    { title: 'Capacidade', value: 'capacity' },
    { title: 'Peso', value: 'weight' },
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
            :page="filters.page"
            :items-length="data?.total ?? 0"
            :items-per-page-options="[10, 25, 30, 50, 100]"
            :headers="headers"
            :items="data?.data ?? []"
            :loading="isLoading"
            @update:items-per-page="(per_page) => (filters.per_page = per_page)"
            @update:page="(page) => (filters.page = page)"
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
        </v-data-table-server>
    </v-container>
</template>

<style scoped></style>
