// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Pie Chart Example
var ctx = document.getElementById("myPieChart2").getContext("2d");
var myPieChart = new Chart(ctx, {
    type: "pie",
    data: {
        labels: prestationLabel,
        datasets: [
            {
                data: prestationNbr,
                backgroundColor: [
                    "#5eb5a9",
                    "#9999ff",
                    "#ffff99",
                    "#990099",
                    "FF3333",
                    "#dc3545",
                ],
            },
        ],
    },

    options: {
        plugins: {
            title: {
                display: true,
                text: "Etat des missions",
            },
        },

        animation: {
            duration: 1000 * 1.5,
            easing: "linear",
        },
    },
    hoverOffset: 4,
});
