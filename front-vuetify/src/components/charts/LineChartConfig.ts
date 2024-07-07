const lineChartConfig = (categories: string[]): any => ({
    chart: {
        height: 450,
        type: 'line',
        zoom: {
            enabled: true,
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: 'straight',
    },
    xaxis: {
        categories,
    },
    yaxis: {
        min: 0,
        max: 100,
    },
    colors: ['#8C63FF'],
    annotations: {
        yaxis: [
            {
                y: 75,
                label: {
                    style: {
                        color: '#fff',
                        background: '#6A3DFF',
                    },
                    text: 'Limite máximo recomendado',
                },
            },
        ],
    },
});

export default lineChartConfig;
