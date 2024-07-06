<script setup lang="ts">
defineProps<{
    number: string;
    description: string;
    numberPrefix?: string;
    numberSuffix?: string;
}>();
</script>

<template>
    <v-card
        class="d-flex flex-column justify-center align-center elevation-3"
        height="150"
        variant="tonal"
    >
        <v-card-title class="text-deep-purple-accent-2">
            {{ numberPrefix }}
            <span class="text-h3 font-weight-black">{{ number }}</span>
            {{ numberSuffix }}
        </v-card-title>
        <v-card-subtitle class="deep-purple-lighten-5">{{
            description
        }}</v-card-subtitle>
    </v-card>
</template>
