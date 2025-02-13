<?php
    session_start();
    include ('Db.php');
    Db::connect('localhost', 'form_validator', 'root', '');
    
    $errors = [];
    $successMessage = '';
    if (isset($_POST)) {
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
            Db::queryAll("INSERT INTO messages (first_name, last_name, email, phone, address, message) VALUES ('$name', '$surname', '$email', '$phone', '$address', '$message')");
            $_SESSION['successMessage'] = "Formulář byl úspěšně odeslán!"; /* Data pro debug: Jméno: $name, Příjmení: $surname, Email: $email, Telefon: $phone, Adresa: $address, Zpráva: $message"*/;

        }
    }
    header('Location: index.php');
    die();
?>