// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Bar Chart Example
var ctx = document.getElementById("myBarChart2").getContext("2d");
var myLineChart = new Chart(ctx, {
    type: "bar",

    data: {
        labels: prestationCaLabel,
        datasets: [
            {
                label: "Chiffre d'Affaire (DZD)",
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 205, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(201, 203, 207, 0.2)",
                ],
                borderColor: [
                    "rgb(255, 99, 132)",
                    "rgb(255, 159, 64)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                    "rgb(54, 162, 235)",
                    "rgb(153, 102, 255)",
                    "rgb(201, 203, 207)",
                ],
                borderWidth: 1,
                data: prestationCaMontant,
            },
        ],
    },
    options: {
        scales: {
            xAxes: [
                {
                    time: {
                        unit: "DZD",
                    },
                    gridLines: {
                        display: false,
                    },
                    ticks: {
                        maxTicksLimit: 12,
                    },
                },
            ],
            yAxes: [
                {
                    ticks: {
                        min: 0,
                        max: max_montant * 1.5,
                        maxTicksLimit: 10,
                    },
                    gridLines: {
                        display: true,
                    },
                },
            ],
        },
        legend: {
            display: true,
        },

        animation: {
            duration: 1000 * 1.5,
            easing: "linear",
        },
    },
});
