var Graph = {

    data: [
        ['Тип', 'Процент']
    ],

    options: {
        title: ''
    },

    chart: null,

    Init: function (id, dataUrl) {

        Graph.chart = new google.visualization.PieChart(document.getElementById(id));

        $.ajax({
            url: dataUrl,
            dataType: 'json',
            success: function (data) {
                $.each(data, function (i, site) {
                    Graph.data.push(site);
                });
                console.log(Graph,data);
                Graph.Draw();
            }
        });
    },

    Draw: function () {
        var data = google.visualization.arrayToDataTable(Graph.data);
        Graph.chart.draw(data, Graph.options);
    }
}