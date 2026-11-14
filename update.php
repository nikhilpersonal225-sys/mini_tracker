<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $status = $_POST["status"];
    $priority = $_POST["priority"];

    $allowedStatuses = [
        "Open",
        "In Progress",
        "Completed",
        "on Hold"
    ];

    $allowedPriorities = [
    "Low",
    "Medium",
    "High"
];

    if (
    in_array($status, $allowedStatuses) &&
    in_array($priority, $allowedPriorities)
) {

    $sql = "UPDATE tickets
            SET status = :status,
                priority = :priority
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':status' => $status,
        ':priority' => $priority,
        ':id' => $id
    ]);
    }
    header("Location: index.php");
    exit;
}

?>