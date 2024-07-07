<script setup lang="ts"></script>

<template>
    <v-list>
        <v-list-item title="Filtros" prepend-icon="mdi-filter"></v-list-item>
        <v-list-item>
            <v-select
                prepend-icon="mdi-airplane-takeoff"
                label="Origem"
                :items="['poa', 'sg']"
                density="comfortable"
                variant="solo"
                multiple
                chips
                clearable
            />
        </v-list-item>
        <v-list-item>
            <v-select
                prepend-icon="mdi-airplane-landing"
                label="Destino"
                :items="['poa', 'sg']"
                density="comfortable"
                variant="solo"
                multiple
                chips
                clearable
            />
        </v-list-item>
        <v-list-item>
            <v-select
                prepend-icon="mdi-stamper"
                label="Status da inspeção"
                :items="['Aprovado', 'Pendente', 'Recusado']"
                density="comfortable"
                variant="solo"
                multiple
                chips
                clearable
            />
        </v-list-item>
        <v-list-item>
            <v-text-field
                density="comfortable"
                variant="solo"
                label="Romaneio"
                prepend-icon="mdi-clipboard-list"
            />
        </v-list-item>
        <v-list-item>
            <v-text-field
                density="comfortable"
                variant="solo"
                label="Quantidade de itens"
                prepend-icon="mdi-package"
                type="number"
        /></v-list-item>
    </v-list>
</template>
