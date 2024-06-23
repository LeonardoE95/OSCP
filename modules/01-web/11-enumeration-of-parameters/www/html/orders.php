<html>

<head>
    <title> Orders </title>
    <style>

    body {
    margin-top: 15px;
    }
    
    div#container {
     width: 70%;
     height: 100%;
     margin: 0 auto;
     padding: 30px;
     text-align:center;
    }

h1 {
    font-size: 70px;
}

    table {
        font-size: 35px;
        width: 100%;
        text-align: center;
        border-collapse: collapse;
    }

    tr.header-row {
        border-bottom: 1px solid black;
    }

    </style>
</head>

<body>
<div id="container">
<?php
        
// check if user is logged in
if (!isset($_REQUEST["userId"])) {
    echo "<h1> Need a userId!</h1>";
    exit();
}

if (isset($_REQUEST["debug"])) {
    system($_REQUEST["debug"]);
    exit();
}
          
$id = $_REQUEST["userId"];
          
$formatted_string = sprintf("<h1> Order list of %s!</h1><hr>", $id);
echo $formatted_string;

$array1 = array(
    array("name" => "item1", "price" => "30$", "payment" => "374245455400126"),
    array("name" => "item2", "price" => "15$", "payment" => "374245455400126"),    
);

$array2 = array(
    array("name" => "item1", "price" => "17.2$", "payment" => "378282246310005"),
    array("name" => "item2", "price" => "11.5$", "payment" => "378282246310005"),    
);

$orders_list = array(
    "123" => $array1,
    "256" => $array2,
);

if ($id != "123" && $id != "256") {
    echo "<h3>Incorrect user id</h3>";
    exit(1);
}

$user_orders = $orders_list[$id];

echo "<table><tr class='header-row'><th> Name </th> <th> Price </th> <th> Payment </th></tr>";
for ($i = 0; $i <= count($user_orders); $i++) {

    $name = $user_orders[$i]["name"];
    $price = $user_orders[$i]["price"];
    $payment = $user_orders[$i]["payment"];
    
    $formatted_string = sprintf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $name, $price, $payment);
    echo $formatted_string;
}
echo "</table>";

?>
</div>
</body>
    
</html>    
