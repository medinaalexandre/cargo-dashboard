<script lang="ts" setup>
import BigNumberCard from '@/components/BigNumberCard.vue';
import { Container } from '@/entities/Container';
import { useQuery } from '@tanstack/vue-query';
import { inject } from 'vue';
import { TreemapConfig } from '@/components/charts/TreemapConfig';
import barCustomDataLabelConfig from '@/components/charts/BarCustomDataLabelConfig';
import lineChartConfig from '@/components/charts/LineChartConfig';
import { FilterOptions } from '@/types';

const filters: FilterOptions = inject('filters') as FilterOptions;

const fetchData = async () => await Container.dashboardData(filters);
const { data } = useQuery({
    queryKey: ['dashboard', filters],
    queryFn: fetchData,
    staleTime: 30 * 1000,
    gcTime: 30 * 1000,
});
</script>

<template>
    <v-container>
        <v-responsive v-if="data">
            <v-row>
                <v-col sm="12" md="4">
                    <big-number-card
                        :number="data?.stopped_containers"
                        description="containers parados"
                    />
                </v-col>
                <v-col sm="12" md="4">
                    <big-number-card
                        number-prefix="R$"
                        :number="data?.contents_price"
                        description="valor em mercadorias"
                    />
                </v-col>
                <v-col sm="12" md="4">
                    <big-number-card
                        :number="data?.usage_percentage"
                        number-suffix="%"
                        description="espaço em uso"
                    />
                </v-col>
            </v-row>
            <v-row>
                <v-col sm="12" md="6">
                    <v-card title="Média de containers parados por empresa">
                        <apexchart
                            type="bar"
                            :options="
                                barCustomDataLabelConfig(
                                    data.companies_container_avg_day.map(
                                        (i) => i.company
                                    )
                                )
                            "
                            :series="[
                                {
                                    data: data.companies_container_avg_day.map(
                                        (i) => i.avgDay
                                    ),
                                },
                            ]"
                        ></apexchart>
                    </v-card>
                </v-col>
                <v-col sm="12" md="6">
                    <v-card title="Uso do pátio nos últimos 30 dias">
                        <apexchart
                            type="line"
                            :options="
                                lineChartConfig(
                                    data.usage_history.map((i) => i.date)
                                )
                            "
                            :series="[
                                {
                                    name: 'percentual de uso',
                                    data: data.usage_history.map(
                                        (i) => i.usage
                                    ),
                                },
                            ]"
                        />
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col sm="12" lg="6">
                    <v-card title="Origens">
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
                <v-col sm="12" md="12" lg="6">
                    <v-card title="Destinos">
                        <v-card-item>
                            <apexchart
                                :options="TreemapConfig"
                                typ="treemap"
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
