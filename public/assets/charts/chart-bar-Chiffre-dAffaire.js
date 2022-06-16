// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Bar Chart Example
var ctx = document.getElementById("myBarChart").getContext("2d");
var myLineChart = new Chart(ctx, {
    type: "bar",

    data: {
        labels: [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septmebre",
            "Octobre",
            "Novembre",
            "Décembre",
        ],
        datasets: [
            {
                label: "Chiffre d'Affaire (DZD)",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: x_data,
            },
        ],
    },
    options: {
        animation: {
            duration: 1000 * 1.5,
            easing: "linear",
        },
        scales: {
            xAxes: [
                {
                    time: {
                        unit: "month",
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
                        max: x_max * 1.5,
                        maxTicksLimit: 6,
                        callback: function (value) {
                            return value + " DA";
                        },
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
    },
});
