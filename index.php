
<?php
// this is my first change in this ticket
require_once "db.php";

// Create a new ticket
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if ($title != "") {

        $sql = "INSERT INTO tickets (title, description, priority)
        VALUES (:title, :description, :priority)";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ':title' => $title,
    ':description' => $description,
    ':priority' => $_POST['priority']
]);

        header("Location: index.php");
        exit;
    }
}

// Fetch all tickets
$sql = "SELECT * FROM tickets ORDER BY id DESC";
$stmt = $conn->query($sql);

$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini Issue Tracker</title>
</head>

<body>

    <h1>Mini Issue Tracker</h1>

    <h2>Create New Ticket</h2>

    <form method="POST">

        <label>Ticket Title:</label><br>
        <input type="text" name="title" required>
        <br><br>

        <label>Description:</label><br>
        <textarea name="description"></textarea>
        <br><br>

        <label>Priority:</label><br>

        <select name="priority">
         <option value="Low">Low</option>
         <option value="Medium" selected>Medium</option>
         <option value="High">High</option>
        </select>
         <br><br>

        <button type="submit">Create Ticket</button>

    </form>

    <hr>

    <h2>All Tickets</h2>

    <?php foreach ($tickets as $ticket): ?>

        <div>

            <h3>
                <?php echo htmlspecialchars($ticket['title']); ?>
            </h3>

            <p>
                <?php echo htmlspecialchars($ticket['description'] ?? ''); ?>
            </p>

            <p>
    Status:
    <?php echo htmlspecialchars($ticket['status']); ?>
</p>

<p>
    Priority:
    <?php echo htmlspecialchars($ticket['priority']); ?>
</p>

<form method="POST" action="update.php">

    <input type="hidden" name="id"
           value="<?php echo $ticket['id']; ?>">

    <select name="status">
        <option value="Open">Open</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
        <option value="On Hold">On Hold</option>
    </select>

     <select name="priority">
    <option value="Low"
        <?php if ($ticket['priority'] == 'Low') echo 'selected'; ?>>
        Low
    </option>

    <option value="Medium"
        <?php if ($ticket['priority'] == 'Medium') echo 'selected'; ?>>
        Medium
    </option>

    <option value="High"
        <?php if ($ticket['priority'] == 'High') echo 'selected'; ?>>
        High
    </option>
</select>

    <button type="submit">Update Status</button>

</form>

            <p>
                Created:
                <?php echo htmlspecialchars($ticket['created_at']); ?>
            </p>

            <hr>

        </div>
        
        

    <?php endforeach; ?>

</body>
</html>
