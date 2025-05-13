<?php
include 'fizzActions.php';
?>
<h2>FizzBuzz!</h2>
<h3 id="greeting">
<?php
    $fullName = trim($firstName . ' ' . ($middleInitial ? $middleInitial . '. ' : '') . $lastName);

    if ($fullName) {
        echo "Let's Play, $fullName!";
    } else {
        echo "Let's Play!";
    }
?>
</h3>

<form id="fizzbuzz-form" method="POST">
    <fieldset>
        <legend>Tell me more about you:</legend>
        <div class="form-row">
            <label for="first-name">First Name:</label>
            <input id="first-name" type="text" name="first-name" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="First Name" required>
            <label for="middle-initial">Middle Initial:</label>
            <input id="middle-initial" type="text" name="middle-initial" maxlength="1" value="<?php echo htmlspecialchars($middleInitial); ?>" pattern="[A-Za-z]">
            <label for="last-name">Last Name:</label>
            <input id="last-name" type="text" name="last-name" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Last Name" required>
        </div>
    </fieldset>

    <fieldset>
        <legend>FizzBuzz:</legend>
        <div class="form-row">
            <label for="default-word">Default Word:</label>
            <input id="default-word" type="text" name="default-word" value="<?php echo htmlspecialchars($defaultWord); ?>" placeholder="Optional Word">
            <label for="count">Count to:</label>
            <input id="count" type="number" name="count" value="<?php echo htmlspecialchars($countLimit); ?>" required>
        </div>
        <div class="form-row">
            <label for="word1">Word 1:</label>
            <input id="word1" type="text" name="word1" value="<?php echo htmlspecialchars($word1); ?>">
            <label for="word2">Word 2:</label>
            <input id="word2" type="text" name="word2" value="<?php echo htmlspecialchars($word2); ?>">
            <label for="word3">Word 3:</label>
            <input id="word3" type="text" name="word3" value="<?php echo htmlspecialchars($word3); ?>">
        </div>
        <div class="form-row">
            <label for="num1">Divisor 1:</label>
            <input id="num1" type="number" name="num1" value="<?php echo htmlspecialchars($num1); ?>">
            <label for="num2">Divisor 2:</label>
            <input id="num2" type="number" name="num2" value="<?php echo htmlspecialchars($num2); ?>">
            <label for="num3">Divisor 3:</label>
            <input id="num3" type="number" name="num3" value="<?php echo htmlspecialchars($num3); ?>">
        </div>
    </fieldset>

    <div class="buttons">
        <button type="submit">Generate</button>
        <button type="button" onclick="window.location.href = '?page=fizzbuzz';">Reset</button>
    </div>
</form>

<div id="fizz-output">
    <?php
    echo $fizzOutput;
    ?>
</div>
