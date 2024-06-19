// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Bar Chart Example

fetch('/count')
    .then(response => response.json())
    .then(data => {
        const labels = [];
        const counts = [];
        const colors = [
            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69', '#f8f9fc', '#e3e6f0', '#dddfeb'
        ];

        data.forEach(item => {
            labels.push(item.nama);          // Assuming 'nama' is the name of the extracurricular activity
            counts.push(item.siswas_count);  // Assuming 'siswas_count' is the count of participants
        });

        // Generate an array of colors to match the number of bars
        const backgroundColors = counts.map((_, index) => colors[index % colors.length]);
        const borderColors = counts.map((_, index) => colors[index % colors.length]);


        var ctx = document.getElementById("myBarChart").getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: labels,
                    data: counts,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }],
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: true
                },
            },
        });
    })
    .catch(error => console.error('Error fetching data:', error));
