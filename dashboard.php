<?php
require_once 'includes/functions.php';
startSessionIfNotStarted();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$totalBottles = getUserTotalBottles($userId);
$totalAmount = $totalBottles * 2; // Calculate total amount (2 BDT per bottle)

// Handle bottle submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bottle_count'])) {
    $bottleCount = (int)$_POST['bottle_count'];
    
    if ($bottleCount > 0) {
        if (addRecyclingRecord($userId, $bottleCount)) {
            $message = "Thank you for recycling $bottleCount bottles!";
            $totalBottles = getUserTotalBottles($userId); // Refresh total
            $totalAmount = $totalBottles * 2; // Recalculate amount after update
        } else {
            $message = "Failed to record your recycling. Please try again.";
        }
    } else {
        $message = "Please enter a valid number of bottles.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="dashboard-page">
    <div class="container">
        <h1>Welcome back, <?php echo htmlspecialchars($userName); ?>!</h1>
        
        <?php if ($message): ?>
            <div class="alert success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="bottle_count">How many bottles are you recycling today?</label>
                <input type="number" id="bottle_count" name="bottle_count" min="1" value="1" required>
                <small>Price per bottle: 2 BDT</small>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
        
        <div class="stats">
            <p>Your total recycled bottles: <strong><?php echo $totalBottles; ?></strong></p>
            <p>Total recycled amount: <strong><?php echo $totalAmount; ?> BDT</strong></p>
        </div>
        
        <a href="logout.php" class="btn logout">Logout</a>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>