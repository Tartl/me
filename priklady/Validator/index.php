<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Kontaktní formulář</title>
</head>
<body>
<?php
    $errors = [];
    $successMessage = '';
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        function sanitizeInput($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        function validateField($value, $regex, $emptyMessage, $invalidMessage) {
            if (empty($value)) {
                return $emptyMessage;
            }
            if (!preg_match($regex, $value)) {
                return $invalidMessage;
            }
            return true;
        }

        $name = sanitizeInput($_POST['ffname'] ?? '');
        $surname = sanitizeInput($_POST['fsname'] ?? '');
        $email = sanitizeInput($_POST['femail'] ?? '');
        $phone = sanitizeInput($_POST['fphone'] ?? '');
        $address = sanitizeInput($_POST['fadres'] ?? '');
        $message = sanitizeInput($_POST['fmes'] ?? '');

        $nameValidation = validateField($name, '/^[A-Za-zÁ-Žá-ž\s]+$/u', 'Nevyplňil jsi jméno!', 'Ve jméně použij jenom písmena.');
        $surnameValidation = validateField($surname, '/^[A-Za-zÁ-Žá-ž\s]+$/u', 'Nevyplňil jsi příjmení!', 'Ve příjmení použij jenom písmena.');
        $emailValidation = validateField($email, '/^[^\s@]+@[^\s@]+\.[^\s@]+$/', 'Nevyplňil jsi email!', 'Zadej správný formát emailu.');
        $phoneValidation = strlen(preg_replace('/\D/', '', $phone)) >= 9 ? true : 'Zadej správný formát telefonu s minimálně 9 číslicemi.';
        $addressValidation = validateField($address, '/\d+/', 'Nevyplňil jsi adresu!', 'Adresa musí obsahovat číslo popisné.');
        $messageValidation = strlen($message) <= 255 ? true : 'Zpráva může mít maximálně 255 znaků.';

        foreach ([$nameValidation, $surnameValidation, $emailValidation, $phoneValidation, $addressValidation, $messageValidation] as $validation) {
            if ($validation !== true) {
                $errors[] = $validation;
            }
        }

        if (empty($errors)) {
            $successMessage = "Formulář byl úspěšně odeslán! Data pro debug: Jméno: $name, Příjmení: $surname, Email: $email, Telefon: $phone, Adresa: $address, Zpráva: $message";
        }
    }
    ?>
    <div class="content-wrapper">
        <img src="SpilkaNicolas.jpg" alt="Profilový obrázek" class="background-image">
    <div class="form-container">
        <form id="myForm" method="POST" onsubmit="return validateForm();">
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
    <?php elseif (!empty($successMessage)): ?>
        <div id="phpSuccess"><?= htmlspecialchars($successMessage) ?></div>
    <?php endif; ?>
    </div>
</div>
    <div id="alertBox" class="alert hidden"></div>
    <script src="index.js" defer></script>
</body>
</html>
