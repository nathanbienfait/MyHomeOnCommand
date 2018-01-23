<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleConsommationAdmin.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        
        <title>MyHomeOnCommand</title>
    </head>

    <body>
        <?php include("header.php"); 
        ?>

        <div id="corps">

            <?php include("menuAdmin.php");  
            ?>


            <div id='graphes'>
                <p><strong>Bienvenue sur la page consommation. Ici, vous pouvez accèder aux statistiques de nos utilisateurs.</strong></p>
                <br/><br/><br/>

                <div id='lumière'>
                    <?php 
    //Partie lumière
                        $arrlum = adminGrapheConsommationlumiere();
                        if(empty($arrlum)) 
                            {
                                echo "Il n'y a pas de données à afficher concernant la lumière.";
                            }
                    ?>
           

                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        var tablum=<?php echo json_encode($arrlum);?>;

                        google.charts.load("current", {packages:['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable(tablum);

                            var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" }]);

                            var options = {
                                title: "Temps d'utilisation des lumières en heure par jour",
                                width: 700,
                                height: 400,
                                bar: {groupWidth: "95%"},
                                legend: { position: "none" },
                            };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                        chart.draw(view, options);
                        }
                    </script>
                    <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
                </div>

                <br/>
                <div id='humidité'>
                    <?php 
    //Partie humidité
                        $arrhum = adminGrapheConsommationhumidite();
                        if(empty($arrhum)) 
                            {
                                echo "Il n'y a pas de données à afficher concernant l'humidité.";
                            }
                    ?>

                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                    var tabhum=<?php echo json_encode($arrhum);?>;
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable(tabhum);

                        var options = {
                            title: 'Humidité relative en pourcentage par jour',
                            curveType: 'function',
                            width: 700,
                            height: 400,
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                        chart.draw(data, options);
                    }
                    </script>
                    <div id="curve_chart" style="width: 900px; height: 500px"></div>

                </div>

                <br/><br/><br/>
                <div id='température'> <br/>
                    <?php 
    //Partie température
                        $arrtem = adminGrapheConsommationtemperature();
                        if(empty($arrtem)) 
                        {
                            echo "Il n'y a pas de données à afficher concernant la température.";
                        }
                    ?>

                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                    var tabtem=<?php echo json_encode($arrtem);?>;
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable(tabtem);

                        var options = {
                            title: 'Température en degré celsius par jour',
                            width: 700,
                            height: 400,
                            hAxis: {titleTextStyle: {color: '#333'}},
                            vAxis: {minValue: 0}
                        };

                        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                    }
                    </script>
                    <div id="chart_div" style="width: 100%; height: 500px;"></div>
                </div>

     
            </div>
        </div>

 <?php include("footer.php"); ?>

</body>
</html>
