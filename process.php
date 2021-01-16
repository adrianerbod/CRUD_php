<?php
$conn = new mysqli("localhost", "root", "", "phpbudget");

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

$total = 0;
$update = false;
$id = 0;
$name = "";
$amount = "";

//add data to db
if (isset($_POST["save"])) {
    $name = $_POST["name"];
    $amount = $_POST["amount"];
    $query = mysqli_query($conn, "INSERT INTO budget (budget_name, budget_amount) VALUES ('$name', '$amount')");
    header("Location: index.php?added=success");
}

//delete
if (isset($_GET['delete'])) {
    $id = $_GET["delete"];
    $delete = mysqli_query($conn, "DELETE FROM budget WHERE budget_id=$id");
    header("Location: index.php?deleted=success");
}

//edit 
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $edit = mysqli_query($conn, "SELECT * FROM budget WHERE budget_id=$id");

    if (mysqli_num_rows($edit) == 1) {
        $row = $edit->fetch_assoc();
        $name = $row['budget_name'];
        $amount = $row['budget_amount'];
    }
}

//update (won't work without the edit above)
if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $update = mysqli_query($conn, "UPDATE budget SET budget_name='$name', budget_amount='$amount' WHERE budget_id='$id'");
}

//total
$totalQ = mysqli_query($conn, "SELECT * FROM budget");
while ($row = $totalQ->fetch_assoc()) {
    $total = $total + $row['budget_amount'];
}
