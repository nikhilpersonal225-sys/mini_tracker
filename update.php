<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $status = $_POST["status"];

    $allowedStatuses = [
        "Open",
        "In Progress",
        "Completed"
    ];

    if (in_array($status, $allowedStatuses)) {

        $sql = "UPDATE tickets
                SET status = :status
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }

    header("Location: index.php");
    exit;
}

?>