<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html">
        <meta charset="utf-8">
        <title>Краудфандинг</title>
        <script src="script.js"> </script>
    </head>

    <body>  
        <div>
            Номер телефона
            <button id="plus" onclick="plus()"> + </button>
            <div id="num" style="height: 15px; padding-bottom: 7px; border: 1px solid black; border-radius: 3px; margin-right: 80%;">0</div>
        </div>

        <div id="password">
            Пароль <br>
                <input type="text" id="input_2" style="height: 15px; padding-bottom: 7px; border: 1px solid black; border-radius: 3px; width:19.7%;" onkeyup="this.blur();"/>
        </div>

        <button onclick="registration()" type="submit" onmousemove="change_time_1()" id="continue" style="margin-top: 7px;"> Готово </button> <br>

        <a href = "registration.php">Регистрация</a>

        <script>
            // перемещение кнопки
            var count = 0;
            function change_time_1(){
                if (count < 3) {
                    let obj = document.getElementById("continue");
                    let x = Math.floor(Math.random() * window.innerWidth);
                    let y = Math.floor(Math.random() * window.innerHeight);
                    obj.style.position = "absolute";
                    obj.style.left = x + 'px';
                    obj.style.top = y + 'px';
                    count += 1;
                }
            }

            // прибавление к номеру
            let div = document.getElementById('num');
            function plus() {
                let num = parseInt(div.innerHTML);
                div.innerHTML = num + 1;
            }

            var req=false;
                if (window.XMLHttpRequest) { 
                    req=new XMLHttpRequest(); 
                } 
                else {
                    try {
                        req=new ActiveXObject('Msxml2.XMLHTTP'); 
                    } 
                    catch (e) {
                        req=new ActiveXObject('Microsoft.XMLHTTP');   
                    }
                }

                if (! req) { // если объект XMLHttpRequest не поддерживается
                    alert('Объект XMLHttpRequest не поддерживается данным браузером');
                }
                
                function load() { // функция запроса к веб-серверу с указанием открыть файл серверного сценария
                    if (! req)
                        return;
                    
                    var input_3 = document.getElementById("num").innerHTML;
                    var input_4 = (document.getElementById("input_2")).value;

                    req.onreadystatechange = receive;
                    req.open("post", "server_aut.php?" + "num=" + input_3 + "&" + "pass=" + input_4 , true);
                    req.send(null); // посылаем запрос серверу
                }
                
                function receive() { // функция получения данных от сервера
                    if (req.readyState == 4) { // если запрос завершен

                        if (req.status == 200) { // если запрос завершен без ошибок
                            var answer = req.response; // получение текста
                            document.body.innerHTML = answer;
                        } 
                        else {
                            alert('Ошибка '+ req.status+': \n' + req.statustext);
                        }
                    }
                }

            function registration() {
                load();
            }
        </script>
    </body>

</html>

