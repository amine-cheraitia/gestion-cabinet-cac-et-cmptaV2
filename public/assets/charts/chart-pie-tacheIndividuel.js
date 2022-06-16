// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Pie Chart Example
var ctx = document.getElementById("myPieCharttask").getContext("2d");
var chart = new Chart(ctx, {
    type: "pie",
    data: {
        labels: ["Tâche(s) Achevée(s) ", "Tâche(s) En cours"],
        datasets: [
            {
                data: [tachesAchevé, tachesEncours],
                backgroundColor: [
                    "#ecb94a",
                    "#87b4f0",
                    " rgb(255, 205, 86)",
                    "#dc3545",
                ],
            },
        ],
    },
    options: {
        animation: {
            duration: 1000 * 1.5,
            easing: "linear",
        },
    },
    hoverOffset: 4,
});
