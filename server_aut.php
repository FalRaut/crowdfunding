<?php
    $num = $_GET['num'];
    $pass = $_GET['pass'];

    /* Подключение к серверу MySQL */ 
    $link = mysqli_connect( 
        'localhost',            /* Хост, к которому мы подключаемся */ 
        'root',                 /* Имя пользователя */ 
        '',                     /* Используемый пароль */ 
        'ssd');     /* База данных для запросов по умолчанию */ 

    if (!$link) { 
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
    exit; 
    }

    $query = "SELECT * FROM users WHERE number='$num' AND pass='$pass'";
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) > 0){
        echo "Вы пока не создавали и не финансировали ни одного проекта, поэтому пользование сервисом пока недоступно. 
        Создайте или профинансируйте проект чтобы разблокировать создание и финансирование проектов";
    } else{
        echo "Такого пользователя не существует.";
    }