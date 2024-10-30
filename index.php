<?php
session_start();

// Initialize the random number and attempts if not already set
if (!isset($_SESSION['target'])) {
    $_SESSION['target'] = rand(1, 100);  // Random number between 1 and 100
    $_SESSION['attempts'] = 0;           // Count the number of attempts
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['attempts']++;
    $guess = (int)$_POST['guess'];
    $target = $_SESSION['target'];

    if ($guess > $target) {
        $message = "Too high! Try again.";
    } elseif ($guess < $target) {
        $message = "Too low! Try again.";
    } else {
        $message = "Congratulations! You guessed the number in " . $_SESSION['attempts'] . " attempts.";
        session_unset(); // Reset the game
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guess the Number Game</title>
</head>
<body>
    <h1>Guess the Number Game</h1>
    <p>I'm thinking of a number between 1 and 100. Can you guess it?</p>

    <?php if (isset($message)): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label for="guess">Your Guess:</label>
        <input type="number" name="guess" id="guess" min="1" max="100" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
