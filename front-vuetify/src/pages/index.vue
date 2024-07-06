<script lang="ts" setup>
import BigNumberCard from '@/components/BigNumberCard.vue';
import { Container } from '@/entities/Container';
import { useQuery } from '@tanstack/vue-query';
import { DashboardRequest } from '@/entities/Containers.types';
import { reactive } from 'vue';
import { TreemapConfig } from '@/components/charts/TreemapConfig';

const filters: DashboardRequest = reactive<DashboardRequest>({});
const fetchData = async () => await Container.dashboardData(filters);
const { data } = useQuery({
    queryKey: ['dashboard', filters],
    queryFn: fetchData,
});
</script>

<template>
    <v-container>
        <v-responsive v-if="data">
            <v-row>
                <v-col cols="12">
                    <h4 class="text-h4">Estado do pátio</h4>
                </v-col>
                <v-col cols="4">
                    <big-number-card
                        :number="data?.stopped_containers"
                        description="containers parados"
                    />
                </v-col>
                <v-col cols="4">
                    <big-number-card
                        number-prefix="R$"
                        :number="data?.contents_price"
                        description="valor em mercadorias"
                    />
                </v-col>
                <v-col cols="4">
                    <big-number-card
                        :number="data?.usage_percentage"
                        number-suffix="%"
                        description="espaço em uso"
                    />
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="6">
                    <v-card>
                        <v-card-title>Origens</v-card-title>
                        <v-card-item>
                            <apexchart
                                :options="TreemapConfig"
                                type="treemap"
                                :series="[
                                    {
                                        data: data.origins.map((i) => ({
                                            x: i.location,
                                            y: i.count,
                                        })),
                                    },
                                ]"
                            />
                        </v-card-item>
                    </v-card>
                </v-col>
                <v-col cols="6">
                    <v-card>
                        <v-card-title>Destinos</v-card-title>
                        <v-card-item>
                            <apexchart
                                :options="TreemapConfig"
                                type="treemap"
                                :series="[
                                    {
                                        data: data.destinations.map((i) => ({
                                            x: i.location,
                                            y: i.count,
                                        })),
                                    },
                                ]"
                            />
                        </v-card-item>
                    </v-card>
                </v-col>
            </v-row>
        </v-responsive>
    </v-container>
</template>
