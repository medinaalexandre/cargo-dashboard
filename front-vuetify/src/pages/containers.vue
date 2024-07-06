<script setup lang="ts">
import { Container } from '@/entities/Container';
import { useQuery } from '@tanstack/vue-query';
import { reactive, ref } from 'vue';
import { ContainerListRequest } from '@/entities/Containers.types';

const filters: ContainerListRequest = reactive<ContainerListRequest>({
    per_page: 10,
    page: 1,
});

const fetchData = async () => await Container.list(filters);
const { data } = useQuery({
    queryKey: ['container', filters],
    queryFn: fetchData,
});
const openCards = reactive<Array<number>>([]);

const expandedCards = ref(new Set<number>());
const toggleExpandCard = (index: number) => {
    if (expandedCards.value.has(index)) {
        expandedCards.value.delete(index);
    } else {
        expandedCards.value.add(index);
    }
};
</script>

<template>
    <h1>Containers</h1>
    <v-container fluid>
        <v-row dense>
            <v-col v-for="(item, idx) in data?.data" :key="item.id">
                <v-card variant="tonal">
                    <v-card-title class="text-h5">
                        {{ item.label }}
                    </v-card-title>
                    <v-card-item>
                        <v-icon
                            color="deep-purple-accent-2"
                            icon="mdi-domain"
                        />
                        {{ item.company }}
                    </v-card-item>
                    <v-card-item>
                        <v-icon
                            color="deep-purple-accent-2"
                            icon="mdi-airplane-takeoff"
                        />
                        {{ item.origin }}
                    </v-card-item>
                    <v-card-item>
                        <v-icon
                            color="deep-purple-accent-2"
                            icon="mdi-airplane-landing"
                        />
                        {{ item.destination }}
                    </v-card-item>
                    <v-card-item>
                        <v-icon
                            color="deep-purple-accent-2"
                            icon="mdi-weight"
                        />
                        {{ item.weight }}
                        <v-icon
                            color="deep-purple-accent-2"
                            icon="mdi-package"
                        />
                        {{ item.items_count }}</v-card-item
                    >
                    <v-card-actions>
                        <v-btn
                            size="md"
                            variant="plain"
                            :icon="
                                expandedCards.has(idx)
                                    ? 'mdi-chevron-up'
                                    : 'mdi-chevron-down'
                            "
                            @click="toggleExpandCard(idx)"
                        />
                    </v-card-actions>
                    <v-expand-transition>
                        <div v-show="expandedCards.has(idx)">
                            <v-divider />
                            <v-card-text>
                                <b>Packing List:</b>
                                {{ item.packing_list }}
                            </v-card-text>
                        </div>
                    </v-expand-transition>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<style scoped></style>
