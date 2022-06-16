// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Pie Chart Example
var ctx = document.getElementById("myPieChart").getContext("2d");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Mission Achevé ", "Mission En cours"],
        datasets: [
            {
                data: [missionAchevé, missionEncours],
                backgroundColor: [
                    "#53c5a9",
                    "#6f42c1",
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
