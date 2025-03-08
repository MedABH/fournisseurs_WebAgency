'use strict';

/* Chart.js docs: https://www.chartjs.org/ */

window.chartColors = {
    green: '#75c181',
    gray: '#a9b5c9',
    text: '#252930',
    border: '#e7e9ed'
};

/* Random number generator for demo purpose */
var randomDataPoint = function () { return Math.round(Math.random() * 10000) };

// Chart.js Line Chart Example 

var lineChartConfig = {
    type: 'line',
    data: {
        labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
        datasets: [{
            label: 'Current week',
            fill: false,
            backgroundColor: window.chartColors.green,
            borderColor: window.chartColors.green,
            data: [500, 700, 650, 800, 900, 750, 850], // Static data for "Cette semaine"
        }, {
            label: 'Previous week',
            borderDash: [3, 5],
            backgroundColor: window.chartColors.gray,
            borderColor: window.chartColors.gray,
            data: [400, 550, 600, 650, 700, 750, 800], // Static data for "Previous week"
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

// Generate charts on load
window.addEventListener('load', function () {
    // Initialize Line Chart
    var lineChart = document.getElementById('canvas-linechart').getContext('2d');
    window.myLine = new Chart(lineChart, lineChartConfig);

    // Initialize Bar Chart
    var barChart = document.getElementById('canvas-barchart').getContext('2d');
    window.myBar = new Chart(barChart, barChartConfig);

    // Set default value for "Cette semaine" (dropdown)
    var lineSelect = document.querySelector('.line-chart-select');
    lineSelect.value = "1"; // This sets the dropdown to "Cette semaine" by default

    var barSelect = document.querySelector('.bar-chart-select');
    barSelect.value = "1"; // Set "Cette semaine" for bar chart dropdown too.

    // Trigger the change event to update the charts
    lineSelect.dispatchEvent(new Event('change'));
    barSelect.dispatchEvent(new Event('change'));
});

// Function to update charts based on the selected time range
function updateCharts(timeRange, chartType) {
    var newLineData1, newLineData2, newBarData, newLineLabels, newBarLabels;

    // Define the labels and data for each time range
    if (timeRange == "1") { // Cette semaine
        newLineLabels = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'];
        newBarLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        newLineData1 = [500, 700, 650, 800, 900, 750, 850];  // Current Week
        newLineData2 = [400, 550, 600, 650, 700, 750, 800];  // Previous Week

        newBarData = [23, 45, 76, 75, 62, 37, 83];
    } else if (timeRange == "2") { // Aujourd'hui
        newLineLabels = ['Hour 1', 'Hour 2', 'Hour 3', 'Hour 4', 'Hour 5', 'Hour 6', 'Hour 7'];
        newBarLabels = ['Hour 1', 'Hour 2', 'Hour 3', 'Hour 4', 'Hour 5', 'Hour 6', 'Hour 7'];

        newLineData1 = [200, 250, 300, 350, 400, 450, 500];
        newLineData2 = [150, 180, 220, 250, 300, 330, 400];

        newBarData = [10, 15, 20, 18, 22, 25, 30];
    } else if (timeRange == "3") { // Ce mois-ci
        newLineLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'];
        newBarLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'];

        newLineData1 = [1500, 1600, 1700, 1800, 1900, 2000, 2100];
        newLineData2 = [1400, 1550, 1650, 1750, 1850, 1950, 2050];

        newBarData = [80, 90, 100, 110, 120, 130, 140];
    } else if (timeRange == "4") { // Cette année
        newLineLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
        newBarLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];

        newLineData1 = [20000, 22000, 24000, 2600, 28000, 30000, 32000];
        newLineData2 = [18000, 19000, 21000, 23000, 25000, 2700, 29000];

        newBarData = [600, 700, 800, 900, 1000, 1100, 1200];
    }

    // Update the Line Chart labels and data (for both lines)
    if (chartType === 'line') {
        if (window.myLine) {
            window.myLine.data.labels = newLineLabels; // Update labels for Line Chart
            window.myLine.data.datasets[0].data = newLineData1; // Update data for Line 1 (Current)
            window.myLine.data.datasets[1].data = newLineData2; // Update data for Line 2 (Previous)
            window.myLine.update();
        }
    }

    // Update the Bar Chart labels and data
    if (chartType === 'bar') {
        if (window.myBar) {
            window.myBar.data.labels = newBarLabels; // Update labels for Bar Chart
            window.myBar.data.datasets[0].data = newBarData; // Update data for Bar Chart
            window.myBar.update();
        }
    }


    // Update Line Chart dataset labels (key) based on timeRange
    if (chartType === 'line' && window.myLine) {
        if (timeRange == "1") {
            window.myLine.data.datasets[0].label = 'Les Fournisseurs';
            window.myLine.data.datasets[1].label = 'Fournisseurs et Clients';
        } else if (timeRange == "2") {
            window.myLine.data.datasets[0].label = 'Les Fournisseurs';
            window.myLine.data.datasets[1].label = 'Fournisseurs et Clients';
        } else if (timeRange == "3") {
            window.myLine.data.datasets[0].label = 'Les Fournisseurs';
            window.myLine.data.datasets[1].label = 'Fournisseurs et Clients';
        } else if (timeRange == "4") {
            window.myLine.data.datasets[0].label = 'Les Fournisseurs';
            window.myLine.data.datasets[1].label = 'Fournisseurs et Clients';
        }

        window.myLine.update();
    }

    if (chartType === 'line' && window.myBar) {
        if (timeRange == "1") {
            window.myBar.data.datasets[0].label = 'Parties Prenantes';

        } else if (timeRange == "2") {
            window.myBar.data.datasets[0].label = 'Parties Prenantes';

        } else if (timeRange == "3") {
            window.myBar.data.datasets[0].label = 'Parties Prenantes';

        } else if (timeRange == "4") {
            window.myBar.data.datasets[0].label = 'Parties Prenantes';

        }

        window.myBar.update();
    }
}

// Event Listener for line-chart-select dropdown
document.querySelector('.line-chart-select').addEventListener("change", function () {
    var timeRange = this.value;
    console.log("Line Chart - Selected Time Range:", timeRange);
    updateCharts(timeRange, 'line'); // Only update the line chart
});

// Chart.js Bar Chart Example 




fetch('/data-for-charts-by-date')
    .then(response => response.json())
    .then(data => {
        const labels = Object.keys(data);  // Dates as labels
        const counts = Object.values(data); // Corresponding counts for each day

        // Calculate the min and max values for the Y-axis
        const minValue = Math.min(...counts);
        const maxValue = Math.max(...counts);

        // Ensure Y-axis starts from 0 and adjust the max value with a buffer
        const adjustedMaxValue = maxValue + 1;  // Add 1 to give some space at the top
        const stepSize = adjustedMaxValue > 10 ? 1 : 0.5;  // Step size adjustment

        var barChartConfig = {
            type: 'bar',
            data: {
                labels: labels,  // Dates as labels
                datasets: [{
                    label: 'Parties Prenantes',
                    data: counts,  // Corresponding counts for each day
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    borderWidth: 1,
                    maxBarThickness: 16
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 1.5,
                legend: {
                    position: 'bottom',
                    align: 'end',
                },
                title: {
                    display: true,
                    text: 'Nombre de Parties Prenantes ajoutées'
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
                },
                scales: {
                    x: {
                        display: true,
                        grid: {
                            drawBorder: false,
                            color: window.chartColors.border,
                        },
                    },
                    y: {
                        display: true,
                        grid: {
                            drawBorder: false,
                            color: window.chartColors.border,
                        },
                        ticks: {
                            beginAtZero: true,  // Force Y-axis to start at zero
                            min: 0,  // Ensure minimum value is 0
                            max: adjustedMaxValue, // Dynamically adjusted max value
                            stepSize: stepSize, // Adjust step size dynamically
                            callback: function (value) {
                                return Number.isInteger(value) ? value : '';  // Show only whole numbers
                            }
                        }
                    }
                }
            }
        };

        // Initialize the chart with the config
        const myChart = new Chart(
            document.getElementById('canvas-barchart'),
            barChartConfig
        );
    });










// Event Listener for bar-chart-select dropdown
document.querySelector('.bar-chart-select').addEventListener("change", function () {
    var timeRange = this.value;
    console.log("Bar Chart - Selected Time Range:", timeRange);
    updateCharts(timeRange, 'bar'); // Only update the bar chart
});