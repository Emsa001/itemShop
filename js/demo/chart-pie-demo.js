var items = { item: [] };
function piechart(servername) {
  let url = `http://localhost:5555/purchasesAccepted?server=${servername}`;
  var dd = [];

  let labels = [];
  let data = [];
  let colors = [];

  fetch(url)
    .then((res) => res.json())
    .then((out) => {
      var x = 0;
      for (var i = 0; i < out.length; i++) {
        if (!dd.includes(out[i].item)) {
          dd.push(out[i].item);
          items.item.push({ item: out[i].item });
          items.item[x].quantity = 1;
          items.item[x].color =
            "#" +
            Math.floor(Math.random() * (0xffffff + 1))
              .toString(16)
              .padStart(6, "0");
          x++;
        } else {
          items.item.some((e) =>
            e.item === out[i].item ? e.quantity++ : false
          );
        }
      }
      //console.log(items.item);
      items.item.forEach((e) => {
        labels.push(e.item);
        data.push(e.quantity);
        colors.push(e.color);
      });
      //console.log(labels);
      // Set new default font family and font color to mimic Bootstrap's default styling
      (Chart.defaults.global.defaultFontFamily = "Nunito"),
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = "#858796";

      // Pie Chart Example
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: labels,
          datasets: [
            {
              data: data,
              backgroundColor: colors,
              hoverBackgroundColor: colors,
              hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: false,
          },
          cutoutPercentage: 80,
        },
      });
    })
    .catch((err) => {
      throw err;
    });
}
