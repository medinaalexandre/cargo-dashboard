export const TreemapConfig = {
    chart: {
        height: 350,
        type: 'treemap',
    },
    legend: {
        show: true,
    },
    dataLabels: {
        enabled: true,
        formatter: function (text: string, op: Record<string, string>) {
            return [text, op.value];
        },
    },
    plotOptions: {
        treemap: {
            enableShades: true,
            shadeIntensity: 0.5,
        },
    },
    colors: ['#8C63FF'],
};
