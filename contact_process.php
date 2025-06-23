<?php

// Параметры подключения к базе данных
$servername = "localhost";
$username = "root";  // Имя пользователя базы данных
$password = "";      // Пароль
$dbname = "log-express";  // Имя вашей базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Защита от SQL-инъекций с использованием mysqli_real_escape_string
$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$subject = $conn->real_escape_string($subject);
$message = $conn->real_escape_string($message);

// Подготовка SQL-запроса для вставки данных
$sql = "INSERT INTO submissions (name, email, subject, message)
        VALUES ('$name', '$email', '$subject', '$message')";

// Выполнение запроса и проверка на успех
if ($conn->query($sql) === TRUE) {
    // После успешного сохранения данных, выводим сообщение об успешной отправке
    echo "<!DOCTYPE html>
    <html lang='ru'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Спасибо за ваше сообщение</title>
    </head>
    <body>
        <div style='text-align: center; padding: 50px;'>
            <h2>Спасибо за ваше сообщение!</h2>
            <p>Ваш запрос был успешно отправлен. Мы скоро с вами свяжемся.</p>
            <a href='index.php'>Вернуться на главную</a> <!-- Ссылка на главную страницу -->
        </div>
    </body>
    </html>";
} else {
    echo "Ошибка при сохранении данных в базе: " . $conn->error;
}

// Закрытие соединения
$conn->close();
?>