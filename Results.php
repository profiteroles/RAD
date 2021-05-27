<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="row">
        <header class="col-lg-12 bg-info">
            <class="col-lg-2">
            <h1 class="col-lg-10 text-center">Homepage</h1>
        </header>
    </div>
    <div class="row">
        <nav class="col-lg-2">
            <h2 class="text-center">Navigation bar</h2>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="index.html">Search</a></li>
                <li><a href="MSearched.php">10 Most Searched</a></li> 
            </ul>
        </nav>
        <?php
        $genre = $_POST["genre"];
        $name = $_POST["name"];
        $rating = $_POST["rating"];
        $year = $_POST["year"];
        ?>
        <main class="col-lg-10">
        <?php
        $host = 'localhost';
        $username = "DBlink";
        $password = "P@ss";
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
        $command = $pdo->prepare("SELECT * FROM `movie` WHERE `Genre` LIKE ? AND `Rating` LIKE ? AND `Year` LIKE ? AND `Title` LIKE  ?");
        $command -> execute(['%'.$genre.'%','%'.$rating.'%','%'.$year.'%','%'.$name.'%']);
        $results = $command->fetchAll();
        if ($command->rowCount()<=0) {
            ?> <H1>Apologies. No Results found</H1><?php
        }
        else{
            $command2 = $pdo->prepare("UPDATE `movie` SET `Searched` = `Searched` + 1 WHERE `Genre` LIKE ? AND `Rating` LIKE ? AND `Year` LIKE ? AND `Title` LIKE  ?");
            $command2 -> execute(['%'.$genre.'%','%'.$rating.'%','%'.$year.'%','%'.$name.'%']);
            ?>
            <table cellspacing="10" cellpadding="10">
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
                </tr>
            <?php } 
        }?>
        </main>
    </div>
</body>

</html>
