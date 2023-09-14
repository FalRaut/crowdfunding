<?php

    $name = $_GET['name'];
    $s_name = $_GET['s_name'];
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

    $sql = "INSERT INTO users (name, s_name, number, pass) VALUES ('$name', '$s_name', '$num', '$pass')";

    mysqli_query($link, $sql);

    echo "Вы пока не создавали и не финансировали ни одного проекта, поэтому пользование сервисом пока недоступно. 
        Создайте или профинансируйте проект чтобы разблокировать создание и финансирование проектов";

