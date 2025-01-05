<?php

if (!isset($_POST['submit']) || !isset ($_POST['level'])) {
    echo "<p> Request is not valid! </p>";
    exit();
}

function move_file($current_path, $final_path) {
    if(move_uploaded_file($current_path, $final_path)) {
        echo "<p> Succesfully uploaded to: '" . $final_path . "' </p>";
    } else {
        echo "<p> Could not uploaded to: '" . $final_path . "' </p>";
    }
}

echo "<p> file info: '" . var_dump($_FILES['filename']) . "' </p>";
echo "<p> level: " . $_POST['level'] . "</p>";
echo "<p> tmp_path: '" . $_FILES['filename']['tmp_name'] . "' </p>";
echo "<p> file_name: '" . basename($_FILES['filename']['name']) . "' </p>";
echo "<p> file_size: '" . $_FILES['filename']['size'] . "' </p>";

// ------------------------------------------

// First level, no check whatsoever!
if ($_POST['level'] == "1") {
    $basename = basename($_FILES['filename']['name']);
    $target_path = "./uploads/level1-thumbnail." . pathinfo($basename, PATHINFO_EXTENSION);
    move_file($_FILES['filename']['tmp_name'], $target_path);
    header('Location: /index.html');
}

// ----

// Second level, check Content-Type 
if ($_POST['level'] == "2") {
    $basename = basename($_FILES['filename']['name']);
    $type = $_FILES['filename']['type'];

    if ($type == "image/png" or $type == "image/jpeg") {
        $target_path = "./uploads/level2-thumbnail." . pathinfo($basename, PATHINFO_EXTENSION);
        move_file($_FILES['filename']['tmp_name'], $target_path);
        // header('Location: /index.html');
    } else {
        echo "<p> Error: invalid type! </p>";
    }
}

// ----

// Third level, check bytes of the files too
if ($_POST['level'] == "3") {
    $basename = basename($_FILES['filename']['name']);
    
    $tmp_name = $_FILES['filename']['tmp_name'];
    if (getimagesize($tmp_name)) {
        $target_path = "./uploads/level3-thumbnail." . pathinfo($basename, PATHINFO_EXTENSION);
        move_file($_FILES['filename']['tmp_name'], $target_path);
        // header('Location: /index.html');        
    } else {
        echo "<p> Error: not an image! </p>";
    }
}

?>
