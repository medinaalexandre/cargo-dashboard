<script setup lang="ts">
import { inject } from 'vue';
import { FilterOptions } from '@/types';
import { Container } from '@/entities/Container';
const filters: FilterOptions = inject('filters') as FilterOptions;
const { origin, destination } = await Container.originAndDestinationsOptions();

const inspectionStatusOptions = [
    { title: 'Aprovado', value: 'A' },
    { title: 'Pendente', value: 'P' },
    { title: 'Recusado', value: 'R' },
];
</script>

<template>
    <v-list>
        <v-list-item title="Filtros" prepend-icon="mdi-filter"></v-list-item>
        <v-list-item>
            <v-autocomplete
                v-model="filters.origin"
                prepend-icon="mdi-airplane-takeoff"
                label="Origem"
                :items="origin ?? []"
                density="comfortable"
                variant="solo"
                multiple
                chips
                clearable
            />
        </v-list-item>
        <v-list-item>
            <v-autocomplete
                v-model="filters.destination"
                prepend-icon="mdi-airplane-landing"
                label="Destino"
                :items="destination ?? []"
                density="comfortable"
                variant="solo"
                multiple
                chips
                clearable
            />
        </v-list-item>
        <v-list-item>
            <v-select
                v-model="filters.inspection_status"
                prepend-icon="mdi-stamper"
                label="Status da inspeção"
                :items="inspectionStatusOptions"
                density="comfortable"
                variant="solo"
                multiple
                chips
                clearable
            />
        </v-list-item>
        <v-list-item>
            <v-text-field
                v-model="filters.packing_list"
                prepend-icon="mdi-clipboard-list"
                label="Romaneio"
                density="comfortable"
                variant="solo"
            />
        </v-list-item>
        <v-list-item>
            <v-text-field
                v-model="filters.items_count"
                label="Quantidade de itens"
                prepend-icon="mdi-package"
                density="comfortable"
                variant="solo"
                type="number"
        /></v-list-item>
    </v-list>
</template>
