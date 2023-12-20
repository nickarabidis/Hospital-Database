<?php
include("database.php");

// Function to generate HTML table for a given database table
function generateTable($conn, $tableName)
{
    $result = mysqli_query($conn, "SELECT * FROM $tableName");

    ob_start();

    echo "<div id='$tableName' class='tabcontent' styles= 'display: block'>";
    echo "<table class='styleTable'><tr class='TableHead'>";

    // Get column names
    $columns = mysqli_fetch_fields($result);
    foreach ($columns as $column) {
        echo "<th>{$column->name}</th>";
    }

    echo "<th>Delete</th></tr>";

    // Display table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "<td><a class='trash' href='delete.php?formType={$tableName}&id=" . urlencode(json_encode($row)) . "'><i class='bi bi-trash' style='font-size:2rem;'></i></a></td></tr>";
    }

    echo "</table>";
    echo "<button class='open-button' onclick='openForm(\"{$tableName}Insert\")'>Insert</button>";

    // Add form for inserting records
    echo "<div class='form-popup' id='{$tableName}Insert'>";
    echo "<form action='insert.php' method='post' class='form-container'>";
    echo "<input type='hidden' name='formType' value='{$tableName}'>"; // Hidden input for form type
    echo "<h2 class='form-h2'>Create new $tableName!</h2>";

    // Input fields based on columns
    foreach ($columns as $column) {
        echo "<label for='{$column->name}' class='form-label'><b>{$column->name}</b></label>";
        echo "<input type='text' name='{$column->name}' id='{$column->name}'>";
    }

    echo "<button type='submit' class='btn'>Insert/Update</button>";
    echo "<button type='button' class='btn cancel' onclick='closeForm(\"{$tableName}Insert\")'>Close</button>";
    echo "</form></div></div>";

    $html = ob_get_clean();
    return $html;
}

// Check if the tableName parameter is set
if (isset($_GET['tableName'])) {
    $tableName = $_GET['tableName'];

    // Call the generateTable function and echo the result
    echo generateTable($conn, $tableName);
} else {
    // Handle the case where tableName is not set
    echo "Table name is not provided.";
}
?>