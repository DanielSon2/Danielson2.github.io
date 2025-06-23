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
$phone = $_POST['phone'];
$cargo_type = $_POST['cargo_type'];
$city = $_POST['city'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$width = $_POST['width'];
$length = $_POST['length'];
$service = $_POST['service'];

// Подготовка SQL-запроса для вставки данных
$sql = "INSERT INTO requests (name, email, phone, cargo_type, city, weight, height, width, length, service)
        VALUES ('$name', '$email', '$phone', '$cargo_type', '$city', '$weight', '$height', '$width', '$length', '$service')";

// Выполнение запроса и проверка на успех
if ($conn->query($sql) === TRUE) {
    echo "Ваш запрос был успешно отправлен!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения
$conn->close();
?>