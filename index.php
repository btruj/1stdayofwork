<?php

function pp($txt)
{
    echo '<pre>';
    print_r($txt);
    echo '</pre>';
}

$cars = file_get_contents("cars.json"); //gets entire contents of "cars.json"

$cars = json_decode($cars);

//pp($cars); displays car data

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Car List</title>
    <style>
        body,
        html {
            letter-spacing: 2px;
            background-color: #181818;
            color: #F5F5F5;
            font-family: 'Roboto', sans-serif;
        }

        .card {
            box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-flow: row wrap;
            width: 90%;
            padding: 30px;
            max-width: 1200px;
            margin: 50px auto;
            border-radius: 15px;
            background-color: #303030;
            gap: 40px;
            justify-content: space-around;
            }

        .card h1 {
            text-decoration: underline;
        }

        .data {
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.2);
            background-color: #404040;
            width: 100%;
            max-width: 280px;
            padding: 20px;
            border: 1px solid #444;
            border-radius: 15px;
            margin: 10px auto;

        }

        .data span {
            font-weight: bold;
            font-size: 1.1em;
            font-family: sans-serif, Arial, Helvetica;
            display: inline-block;
            margin: 5px 0;
        }

        .mpg-1 {
            color: #E53935;
        }

        .mpg-2 {
            color: #FB8C00;
        }

        .mpg-3 {
            color: #1E88E5;
        }

        .mpg-4 {
            color: #8E24AA;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Car List</h1>
    </div>
    <div class="card">
        <?php foreach ($cars as $car) {

            // Determine MPG color group
            if ($car->Miles_per_Gallon < 15) {
                $mpg_color_class = 'mpg-1';
            } elseif ($car->Miles_per_Gallon >= 15 && $car->Miles_per_Gallon < 19) {
                $mpg_color_class = 'mpg-2';
            } elseif ($car->Miles_per_Gallon >= 19 && $car->Miles_per_Gallon < 20) {
                $mpg_color_class = 'mpg-3';
            } else {
                $mpg_color_class = 'mpg-4';
            }

            // Determine flag emoji
            switch ($car->Origin) {
                case "USA":
                    $flag = "🇺🇸";
                    break;
                case "Europe":
                    $flag = "🇪🇺";
                    break;
                case "Japan":
                    $flag = "🇯🇵";
                    break;
                default:
                    $flag = "";
            }

            echo '<div class="data">';
            echo '<span>Name: ' . $car->Name . '</span>';
            echo '<span>HorsePower to Weight Ratio: ' . round($car->Horsepower / $car->Weight_in_lbs, 4) . '</span>';

            echo '<span>HorsePower: ' . $car->Horsepower . '</span>';
            echo '<br>';
            echo '<span class="' . $mpg_color_class . '">Miles Per Gallon: ' . $car->Miles_per_Gallon . '</span>';
            echo '<br>';
            echo '<span >Origin: ' . $flag . ' ' . $car->Origin . '</span>';
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>