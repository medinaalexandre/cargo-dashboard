<script lang="ts" setup>
import BigNumberCard from '@/components/BigNumberCard.vue';
import { Bar } from 'vue-chartjs';
import {
    BarElement,
    CategoryScale,
    Chart as ChartJS,
    ChartData,
    ChartOptions,
    LinearScale,
    Title,
    Tooltip,
} from 'chart.js';
import { Container } from '@/entities/Container';
import { useQuery } from '@tanstack/vue-query';
import { DashboardRequest } from '@/entities/Containers.types';
import { reactive } from 'vue';

ChartJS.register(Title, Tooltip, BarElement, CategoryScale, LinearScale);
const filters: DashboardRequest = reactive<DashboardRequest>({});
const fetchData = async () => await Container.dashboardData(filters);
const { data } = useQuery({
    queryKey: ['dashboard', filters],
    queryFn: fetchData,
});

const barChartData: ChartData<'bar'> = {
    labels: ['Samsung', 'Apple', 'Sony', 'Microsoft', 'Nintendo'],
    datasets: [
        {
            backgroundColor: '#8C63FF',
            data: [10, 20, 30, 15, 30],
        },
    ],
};

const barChartOptions: ChartOptions<'bar'> = {
    responsive: true,
    plugins: {
        legend: {
            display: false,
        },
    },
};

const series = [
    {
        data: [
            {
                x: 'New Delhi',
                y: 218,
            },
            {
                x: 'Kolkata',
                y: 149,
            },
            {
                x: 'Mumbai',
                y: 184,
            },
            {
                x: 'Ahmedabad',
                y: 55,
            },
            {
                x: 'Bangaluru',
                y: 84,
            },
            {
                x: 'Pune',
                y: 31,
            },
            {
                x: 'Chennai',
                y: 70,
            },
            {
                x: 'Jaipur',
                y: 30,
            },
            {
                x: 'Surat',
                y: 44,
            },
            {
                x: 'Hyderabad',
                y: 68,
            },
            {
                x: 'Lucknow',
                y: 28,
            },
            {
                x: 'Indore',
                y: 19,
            },
            {
                x: 'Kanpur',
                y: 29,
            },
        ],
    },
];
const chartOptions = {
    legend: {
        show: false,
    },
    chart: {
        height: 350,
        type: 'treemap',
    },
    plotOptions: {
        treemap: {
            enableShades: true,
            shadeIntensity: 0.5,
            reverseNegativeShade: true,
            colorScale: {
                ranges: [
                    {
                        from: 0,
                        to: 218,
                        color: '#8C63FF',
                    },
                ],
            },
        },
    },
};
</script>

<template>
    <v-container>
        <v-responsive>
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
                        <v-card-title
                            >Containers parados em dias por
                            empresa</v-card-title
                        >
                        <v-card-item>
                            <bar
                                :options="barChartOptions"
                                :data="barChartData"
                            ></bar>
                        </v-card-item>
                    </v-card>
                </v-col>
                <v-col cols="6">
                    <v-card>
                        <v-card-title>Destinos</v-card-title>
                        <v-card-item>
                            <apexchart
                                type="treemap"
                                :options="chartOptions"
                                :series="series"
                            ></apexchart>
                        </v-card-item>
                    </v-card>
                </v-col>
            </v-row>
        </v-responsive>
    </v-container>
</template>
