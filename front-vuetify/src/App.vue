<template>
    <v-responsive class="border rounded"> </v-responsive>
    <v-app :theme="theme">
        <v-app-bar title="Cargo Dashboard" class="px-3" compact>
            <v-btn
                :icon="
                    theme === 'light'
                        ? 'mdi-weather-sunny'
                        : 'mdi-weather-night'
                "
                @click="toggleTheme"
            />
            <v-app-bar-nav-icon
                class="d-lg-none"
                @click.stop="drawer = !drawer"
            />
        </v-app-bar>
        <v-navigation-drawer v-model="drawer" location="left">
            <Filters />
        </v-navigation-drawer>
        <v-main>
            <v-container>
                <router-view />
            </v-container>
        </v-main>
    </v-app>
</template>

<script lang="ts" setup>
import { provide, reactive, ref } from 'vue';
import Filters from '@/components/sidebar/Filters.vue';
import { FilterOptions } from '@/types';

const theme = ref(localStorage.getItem('theme') ?? 'dark');
const toggleTheme = () => {
    const newTheme = theme.value === 'light' ? 'dark' : 'light';
    localStorage.setItem('theme', newTheme);
    theme.value = newTheme;
};

const drawer = ref(true);
const filters = reactive<FilterOptions>({
    origin: [],
    destination: [],
    inspection_status: [],
    packing_list: null,
    items_count: null,
});

provide('filters', filters);
</script>
