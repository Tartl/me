<?php
        session_start();
        include ('Db.php');
        Db::connect('localhost', 'form_validator', 'root', '');

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Kontaktní formulář</title>
    
</head>
<body>
    <div class="content-wrapper">
        <div class="top-section">
            <div class="background-image">
                <img src="SpilkaNicolas.jpg" alt="Profilový obrázek" class="background-image">
            </div>
            <div class="form-container">
                <form id="myForm" method="POST" action="add_to_db.php" onsubmit="return validateForm();">
                    <label for="ffname">Jméno:</label>
                    <input type="text" id="ffname" name="ffname">
                    
                    <label for="fsname">Příjmení:</label>
                    <input type="text" id="fsname" name="fsname">
                    
                    <label for="femail">Email:</label>
                    <input type="email" id="femail" name="femail">
                    
                    <label for="fphone">Telefon:</label>
                    <input type="text" id="fphone" name="fphone">
                    
                    <label for="fadres">Adresa:</label>
                    <input type="text" id="fadres" name="fadres">
                    
                    <label for="fmes">Zpráva:</label>
                    <textarea id="fmes" name="fmes" maxlength="255"></textarea>
                    
                    <button type="submit" id="btn">Odeslat</button>
                </form>
                <?php if (!empty($errors)): ?>
                <div id="phpErrors">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php
                    if (isset($_SESSION['successMessage'])) {
                    echo '<div id="phpSuccess">' . htmlspecialchars($_SESSION['successMessage']) . '</div>';
                    unset($_SESSION['successMessage']);
                    }
                ?>
            </div>
        </div>
        <section class="message-history">
            <h2>Historie zpráv</h2>
            <?php 
                $messages = Db::queryAll('SELECT * FROM messages');
                foreach ($messages as $message) {
                    echo "<div class='message'>";
                        echo "<div class='message__name'>Jméno: " . htmlspecialchars($message['first_name']) . "</div>";
                        echo "<div class='message__surname'>Příjmení: " . htmlspecialchars($message['last_name']) . "</div>";
                        echo "<div class='message__email'>Email: " . htmlspecialchars($message['email']) . "</div>";
                        echo "<div class='message__phone'>Telefon: " . htmlspecialchars($message['phone']) . "</div>";
                        echo "<div class='message__address'>Adresa: " . htmlspecialchars($message['address']) . "</div>";
                        echo "<div class='message__message'>Zpráva: " . htmlspecialchars($message['message']) . "</div>";
                        echo "<div class='message__date'>Datum: " . date("d.m.Y", strtotime($message['timestamp'])) . "</div>";
                    echo "</div>";
                }
            ?>
        </section>
    </div>
    <div id="alertBox" class="alert hidden"></div>
    <script src="index.js" defer></script>
</body>
</html>
