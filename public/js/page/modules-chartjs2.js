"use strict";
var id = document.getElementById("data_id").value;
console.log(id);
var average_sales_per_day = [];

fetch("/detail-saham/" + id, {
    method: "GET",
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
})
    .then((response) => response.json())
    .then((data) => {
        let p = data.data;
        for (const key in p.average_sales_per_day) {
            const element = p.average_sales_per_day[key];
            average_sales_per_day.push(element);
        }

        console.log(p);
        console.log(p.average_sales_per_day);

        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                ],
                datasets: [
                    {
                        label: "Statistics",
                        data: average_sales_per_day,
                        borderWidth: 2,
                        backgroundColor: "#e3e649",
                        borderColor: "#e3e649",
                        borderWidth: 2.5,
                        pointBackgroundColor: "#ffffff",
                        pointRadius: 4,
                    },
                ],
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                drawBorder: false,
                                color: "#f2f2f2",
                            },
                            ticks: {
                                beginAtZero: false,
                                stepSize: 100,
                            },
                        },
                    ],
                    xAxes: [
                        {
                            ticks: {
                                display: false,
                            },
                            gridLines: {
                                display: false,
                            },
                        },
                    ],
                },
            },
        });

        // Update the chart's labels
        var today = new Date();

        var labels = [];
        for (var i = 0; i < 7; i++) {
            var label = getDayName(today.getDay()) + " " + formatDate(today);
            labels.unshift(label);
            today.setDate(today.getDate() - 1); // Subtract one day from the date
        }

        myChart.data.labels = labels;
        myChart.update();

        function getDayName(dayOfWeek) {
            switch (dayOfWeek) {
                case 0:
                    return "Minggu";
                case 1:
                    return "Senin";
                case 2:
                    return "Selasa";
                case 3:
                    return "Rabu";
                case 4:
                    return "Kamis";
                case 5:
                    return "Jumat";
                case 6:
                    return "Sabtu";
            }
        }

        function formatDate(date) {
            var monthNames = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];

            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();

            return day + ", " + monthNames[monthIndex] + " " + year;
        }
    })
    .catch((error) => {
        console.error("Error:", error);
    });

fetch("/dashboard-company", {
    method: "GET",
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
})
    .then((response) => response.json())
    .then((data) => {
        let p = data.data;
        for (const key in p.average_sales_per_day) {
            const element = p.average_sales_per_day[key];
            average_sales_per_day.push(element);
        }

        console.log(p);
        console.log(p.average_sales_per_day);

        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                ],
                datasets: [
                    {
                        label: "Statistics",
                        data: average_sales_per_day,
                        borderWidth: 2,
                        backgroundColor: "#e3e649",
                        borderColor: "#e3e649",
                        borderWidth: 2.5,
                        pointBackgroundColor: "#ffffff",
                        pointRadius: 4,
                    },
                ],
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                drawBorder: false,
                                color: "#f2f2f2",
                            },
                            ticks: {
                                beginAtZero: false,
                                stepSize: 100,
                            },
                        },
                    ],
                    xAxes: [
                        {
                            ticks: {
                                display: false,
                            },
                            gridLines: {
                                display: false,
                            },
                        },
                    ],
                },
            },
        });

        // Update the chart's labels
        var today = new Date();

        var labels = [];
        for (var i = 0; i < 7; i++) {
            var label = getDayName(today.getDay()) + " " + formatDate(today);
            labels.unshift(label);
            today.setDate(today.getDate() - 1); // Subtract one day from the date
        }

        myChart.data.labels = labels;
        myChart.update();

        function getDayName(dayOfWeek) {
            switch (dayOfWeek) {
                case 0:
                    return "Minggu";
                case 1:
                    return "Senin";
                case 2:
                    return "Selasa";
                case 3:
                    return "Rabu";
                case 4:
                    return "Kamis";
                case 5:
                    return "Jumat";
                case 6:
                    return "Sabtu";
            }
        }

        function formatDate(date) {
            var monthNames = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];

            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();

            return day + ", " + monthNames[monthIndex] + " " + year;
        }
    })
    .catch((error) => {
        console.error("Error:", error);
    });
