"use strict";
var count_transaction = [];
var slug = [];
var price = [];
var total_saham = [];
var on_sale = [];

fetch("/dashboard-manager", {
    method: "GET",
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
})
    .then((response) => response.json())
    .then((data) => {
        // Create the chart
        let p = data.data;
        for (const key in p) {
            const element = p[key];
            total_saham.push(element.total_saham);
            price.push(element.price_average);
            slug.push(element.slug);
            on_sale.push(element.on_sale);
        }

        let c = data.data_transaction;
        for (const date in c) {
            const count = c[date];
            count_transaction.push(count);
        }
        console.log(c);
        console.log(count_transaction);

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
                        data: count_transaction,
                        borderWidth: 2,
                        backgroundColor: "#6777ef",
                        borderColor: "#6777ef",
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
                                stepSize: 1,
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

        var ctx = document.getElementById("myChart3").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                datasets: [
                    {
                        data: on_sale,
                        backgroundColor: [
                            "#191d21",
                            "#63ed7a",
                            "#ffa426",
                            "#fc544b",
                            "#6777ef",
                        ],
                        label: "Dataset 1",
                    },
                ],
                labels: slug,
            },
            options: {
                responsive: true,
                legend: {
                    position: "bottom",
                },
            },
        });
    })
    .catch((error) => {
        console.error("Error:", error);
    });
