'use strict';

window.chartColors = {
    green: '#75c181',
    gray: '#a9b5c9',
    text: '#252930',
    border: '#e7e9ed'
};

fetch('/data-for-charts-by-date')
    .then(response => response.json())
    .then(data => {
        // Convertir les clés (dates) en objets Date et trier les dates dans l'ordre chronologique
        const labels = Object.keys(data).map(date => {
            // S'assurer que la clé est bien une date au format 'YYYY-MM-DD'
            const parts = date.split('/');
            // Date de type MM/DD/YYYY (ou similaire), selon votre format
            return new Date(parts[2], parts[0] - 1, parts[1]); // mois est indexé à partir de 0
        });

        // Trier les dates dans l'ordre croissant
        labels.sort((a, b) => a - b);

        // Convertir les dates triées en chaînes de caractères formatées pour les labels
        const formattedLabels = labels.map(date => {
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${month}/${day}/${year}`;  // Format MM/DD/YYYY
        });

        // Extraire les valeurs des comptages en fonction des dates triées
        const counts = formattedLabels.map(date => data[date]);

        // Calculer les valeurs min et max
        const minValue = Math.min(...counts);
        const maxValue = Math.max(...counts);

        // Ajuster la valeur maximale et la taille des pas
        const adjustedMaxValue = maxValue + 1;
        const stepSize = adjustedMaxValue > 10 ? 1 : 0.5;

        var barChartConfig = {
            type: 'bar',
            data: {
                labels: formattedLabels,  // Dates triées et formatées
                datasets: [{
                    label: 'Parties Prenantes',
                    data: counts,
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
                            beginAtZero: true,
                            min: 0,
                            max: adjustedMaxValue,
                            stepSize: stepSize,
                            callback: function (value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('canvas-barchart'),
            barChartConfig
        );
    });
