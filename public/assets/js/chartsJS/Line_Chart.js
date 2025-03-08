'use strict';

window.chartColors = {
    green: '#75c181',
    gray: '#a9b5c9',
    text: '#252930',
    border: '#e7e9ed'
};

var lineChartConfig = {
    type: 'line',
    data: {
        labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
        datasets: [{
            label: 'Current week',
            fill: false,
            backgroundColor: window.chartColors.green,
            borderColor: window.chartColors.green,
            data: [500, 700, 650, 800, 900, 750, 850],
        }, {
            label: 'Previous week',
            borderDash: [3, 5],
            backgroundColor: window.chartColors.gray,
            borderColor: window.chartColors.gray,
            data: [400, 550, 600, 650, 700, 750, 800],
            fill: false,
        }]
    },
    options: {
        responsive: true,
        aspectRatio: 1.5,
        legend: {
            display: true,
            position: 'bottom',
            align: 'end',
        },
        title: {
            display: true,
            text: 'Nombre de Fournisseurs ajoutés',
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            titleMarginBottom: 10,
            bodySpacing: 10,
            xPadding: 16,
            yPadding: 16,
            borderColor: window.chartColors.border,
            borderWidth: 1,
            backgroundColor: '#fff',
            bodyFontColor: window.chartColors.text,
            titleFontColor: window.chartColors.text,
            callbacks: {
                label: function (tooltipItem, data) {
                    if (parseInt(tooltipItem.value) >= 1000) {
                        return tooltipItem.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "");
                    } else {
                        return tooltipItem.value;
                    }
                }
            },
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.border,
                },
                scaleLabel: {
                    display: false,
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.border,
                },
                scaleLabel: {
                    display: false,
                },
                ticks: {
                    beginAtZero: true,
                    userCallback: function (value) {
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "");
                    }
                },
            }]
        }
    }
};

window.addEventListener('load', function () {
    var lineChart = document.getElementById('canvas-linechart').getContext('2d');
    window.myLine = new Chart(lineChart, lineChartConfig);
});
