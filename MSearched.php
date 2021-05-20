<!DOCTYPE html>
<html lang="en">

<head>
    <title>10 Most Searched</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>

<body>
    <div class="row">
        <header class="col-lg-12 bg-info">
            <class="col-lg-2">
            <h1 class="col-lg-10 text-center">10 Most searched</h1>
        </header>
    </div>
    <div class="row">
        <nav class="col-lg-2">
            <h2 class="text-center">Navigation bar</h2>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="index.html">Search</a></li> 
            </ul>
        </nav>
        <main class="col-lg-10">
        <?php

        $host = 'localhost';
        $servername = "localhost";
        $username = "root";
        $password = "usbw";
        $dbname = "movies";     
        $porta = "3306";
        $charset = 'utf8mb4';

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$porta";
        try {
            $pdo = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $command = $pdo->prepare("SELECT * FROM `movie` ORDER BY `Searched` DESC LIMIT 10");
        $command -> execute();
        $results = $command->fetchAll();
        $dataPoints = array( 
            array("y" => $results[9]['Searched'],"label" => $results[9]['Title']),
            array("y" => $results[8]['Searched'],"label" => $results[8]['Title']),
            array("y" => $results[7]['Searched'],"label" => $results[7]['Title']),
            array("y" => $results[6]['Searched'],"label" => $results[6]['Title']),
            array("y" => $results[5]['Searched'],"label" => $results[5]['Title']),
            array("y" => $results[4]['Searched'],"label" => $results[4]['Title']),
            array("y" => $results[3]['Searched'],"label" => $results[3]['Title']),
            array("y" => $results[2]['Searched'],"label" => $results[2]['Title']),
            array("y" => $results[1]['Searched'],"label" => $results[1]['Title']),
            array("y" => $results[0]['Searched'],"label" => $results[0]['Title']),
        );
        ?><table cellspacing="10" cellpadding="10">
        <tr>
          <th>ID</th>
          <th>|Name</th>
          <th>|Studio</th>
          <th>|Status</th>
          <th>|Sound</th>
          <th>|Versions</th>
          <th>|RRP</th>
          <th>|Rating</th>
          <th>|Year</th>
          <th>|Genre</th>
          <th>|Aspect</th>
          <th>|Times Searched</th>
        </tr>
        <?php foreach ($results as $result) { ?>
            <tr>
                <td><?php echo $result['ID'] ?></td>
                <td><?php echo "|" . $result['Title'] ?></td>
                <td><?php echo "|" . $result['Studio'] ?></td>
                <td><?php echo "|" . $result['Status'] ?></td>
                <td><?php echo "|" . $result['Sound'] ?></td>
                <td><?php echo "|" . $result['Versions'] ?></td>
                <td><?php echo "|" . $result['RecRetPrice'] ?></td>
                <td><?php echo "|" . $result['Rating'] ?></td>
                <td><?php echo "|" . $result['Year'] ?></td>
                <td><?php echo "|" . $result['Genre'] ?></td>
                <td><?php echo "|" . $result['Aspect'] ?></td>
                <td><?php echo "|" . $result['Searched'] ?></td>
            </tr>
        <?php } ?>
        <div id="chartContainer" style="height: 370px; width: 80%;"></div>
        <script>
        window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title:{
                text: "10 most searched"
            },
            axisY: {
                title: "Amount of times searched",
                includeZero: true,
            },
            data: [{
                type: "bar",
                yValueFormatString: "###",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bolder",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        
        }
        </script>
        </main>
    </div>
</body>

</html>