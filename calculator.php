<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .calculator {
            width: 400px;
            margin: 0 auto;
            text-align: center;
        }

        input[type="number"] {
            width: 90%;
            height: 10px;
            padding: 20px;
            font-size: 36px;
            text-align: center;
            background-color: #eee;
            border: none;
            box-shadow: inset 0 0 10px #ccc;
            margin-bottom: 10px;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            margin-bottom: 50px;
        }

        input {
            padding: 20px 0;
            font-size: 24px;
            background-color: #fff;
            border: 1px solid #ccc;
            width: 100%;
            box-shadow: 0 0 10px #ccc;
            cursor: pointer;
        }

        input#equals {
            display: block;
            width: 100%;
            height: 40px;
            margin-top: 15px;
            border: none;
        }

        button:hover {
            background-color: #ddd;
        }

        div#result {
            width: 90px;
            background-color: #ddd;
        }

    </style>
</head>
<body>
    <form method="POST">
        <div class="calculator">
            <h3>Insira o primeiro número:</h3>
            <input type="number" id="num1" name="num1" />
            <h3>Insira o segundo número:</h3>
            <input type="number" id="num2" name="num2" />
            <div class="buttons">
                <input type="submit" id="divide" name="getValue" value="/" />
                <input type="submit" id="multiply" name="getValue" value="*" />
                <input type="submit" id="substract" name="getValue" value="-" />
                <input type="submit" id="add" name="getValue" value="+" />
            </div>
            <?php

            require "nusoap.php";

            $clientcalc = new nusoap_client("http://www.dneonline.com/calculator.asmx?WSDL", 'wsdl');

            $a = 0;
            $b = 0;
            $op = '';
            if ($_POST) {
                $a = $_POST["num1"];
                $b = $_POST["num2"];

                if ($_POST["getValue"] == "/") {
                    $op = "Divide";
                } else if ($_POST["getValue"] == "*") {
                    $op = "Multiply"; 
                } else if ($_POST["getValue"] == "-") {
                    $op = "Subtract";
                } else {
                    $op = "Add";
                }
            }

            $resultado = $clientcalc->call($op, array("intA" => $a, "intB" => $b));
            echo "<h3> Resultado: </h3>";
            echo "<input type='number' disabled value='";
            print_r($resultado[$op."Result"]);
            echo "'/>";

        ?>
        </div>
    </form>
</body>
</html>