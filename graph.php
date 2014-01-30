<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Graph</title>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>

    <link rel="stylesheet" href="web/css/graph.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript" src="web/js/graph.js"></script>

    <script type="text/javascript">

        google.load("visualization", "1", {packages: ["corechart"]});

        google.setOnLoadCallback(function () {
            Graph.Init('piechart', 'graph-ajax.php');
        });

    </script>

</head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Graph</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                </ul>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="starter-template">
            <h1>Pie chart.</h1>

            <p class="lead">Статистика проиндексированных сайтов.</p>

            <div id="piechart" style="width: 900px; height: 500px;"></div>
        </div>

    </div>

</body>
</html>