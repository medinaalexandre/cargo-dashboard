const barCustomDataLabelConfig = (categories: string[]): any => ({
    chart: {
        type: 'bar',
        height: 450,
    },
    plotOptions: {
        bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            dataLabels: {
                position: 'bottom',
            },
        },
    },
    colors: ['#8C63FF'],
    dataLabels: {
        enabled: true,
        textAnchor: 'start',
        style: {
            colors: ['#fff'],
        },
        formatter: function (val: string, opt: any) {
            return opt.w.globals.labels[opt.dataPointIndex] + ':  ' + val;
        },
        offsetX: 0,
        dropShadow: {
            enabled: true,
        },
        tooltip: {
            x: {
                show: false,
            },
            y: {
                title: {
                    formatter: function () {
                        return '';
                    },
                },
            },
        },
        legend: {
            show: false,
        },
    },
    xaxis: {
        categories,
    },
    yaxis: {
        labels: {
            show: false,
        },
    },
    legend: {
        show: false,
    },
    stroke: {
        width: 1,
        colors: ['#fff'],
    },
});

export default barCustomDataLabelConfig;
