<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html">
        <meta charset="utf-8">
        <title>Краудфандинг</title>
        <script src="script.js"> </script>
    </head>

    <body>  
        <div id="name">
            Имя <br>
                <input type="text" id="input_1" style="height: 15px; padding-bottom: 7px; border: 1px solid black; border-radius: 3px; width:19.7%;"/>
        </div>

        <div>
            Фамилия <div id="su" style="height: 15px; padding-bottom: 7px; border: 1px solid black; border-radius: 3px; margin-right: 80%;"></div>
        </div>

        <div>
            Номер телефона
            <button id="plus" onclick="plus()"> + </button>
            <div id="num" style="height: 15px; padding-bottom: 7px; border: 1px solid black; border-radius: 3px; margin-right: 80%;">0</div>
        </div>

        <div id="password">
            Пароль <br>
                <input type="text" id="input_2" style="height: 15px; padding-bottom: 7px; border: 1px solid black; border-radius: 3px; width:19.7%;" onkeyup="this.blur();"/>
        </div>

        <button onclick="registration()" onmousemove="change_time_1()"  id="continue" style="margin-top: 7px;"> Готово </button>

        <div id="ans">answer</div>

        <script>
            // ввод имени
            function nextChar(c) {
                if (c === 'z') {
                    return 'a';
                } else if (c === 'Z') {
                    return 'A';
                } else if (c === 'я') {
                    return 'а';
                } else if (c === 'Я') {
                    return 'А';
                } else {
                    return String.fromCharCode(c.charCodeAt(0) + 1);
                }
            };
    
            let size = 0;
            let input = document.getElementById('input_1');
            input.addEventListener('input', function() {
                let value = input.value;
                if (size <= value.length) {
                    let lastChar = value[value.length - 1];
                    let newLastChar = nextChar(lastChar);
                    input.value = value.slice(0, -1) + newLastChar;
                    size += 1;
                } else {
                    size -= 1;
                }
            });
            
            // ввод фамилии
            let body = document.getElementsByTagName('body')[0];

            for (let i = 0; i < 33; i++) {
                let button = document.createElement('button');
                button.setAttribute('id', 'pb_' + i);
                button.innerHTML = String.fromCharCode(1040 + i);
                button.onclick = function() {
                    set_char(String.fromCharCode(1040 + i))
                };
                body.appendChild(button);
            }

            const elements = [];

            const x = [];
            const y = [];

            const speed_x = [];
            const speed_y = [];

            const x_tr = [];
            const y_tr = [];


            for (let i = 0; i < 33; i++) {
                elements[i] = document.getElementById("pb_" + i);
                elements[i].style.position = "absolute";

                x[i] = 0;
                y[i] = 0;

                speed_x[i] = 3 * (Math.random()* 0.3 + 0.3);
                speed_y[i] = 3 * (Math.random()* 0.3 + 0.3);

                x_tr[i] = 'r';
                y_tr[i] = 'b';
            }

            function move() {
                for (let i = 0; i < 33; i++) {
                    if (x_tr[i] === 'r') {
                        x[i] += speed_x[i];
                    } else {
                        x[i] -= speed_x[i];
                    }

                    if (y_tr[i] === 'b') {
                            y[i] += speed_y[i];
                    } else {
                            y[i] -= speed_y[i];
                    }

                    if (x[i] > window.innerWidth - 29) {
                        x[i] = window.innerWidth - 29;
                        x_tr[i] = 'l';    
                    }
                    if (x[i] < 0) {
                        x[i] = 0;
                        x_tr[i] = 'r';
                    } 

                    if (y[i] > window.innerHeight - 29) {
                        y[i] = window.innerHeight -29;
                        y_tr[i] = 't';
                    }
                    if (y[i] < 0) {
                        y[i] = 0;
                        y_tr[i] = 'b';
                    }
                }
            
                for (let i = 0; i < 33; i++) {
                    elements[i].style.left = x[i] +"px";
                    elements[i].style.top = y[i] + "px";
                }
                    
                requestAnimationFrame(move);
            }

            function set_char(c) {
                document.getElementById("su").innerHTML += c;
            }

            move();

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
                    
                    var input_1 = (document.getElementById("input_1")).value;
                    var input_2 = document.getElementById("su").innerHTML;
                    var input_3 = document.getElementById("num").innerHTML;
                    var input_4 = (document.getElementById("input_2")).value;

                    req.onreadystatechange = receive;
                    req.open("post", "server.php?" + "name=" + input_1 + "&" + "s_name=" + input_2 + "&" + "num=" + input_3 + "&" + "pass=" + input_4 , true);
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

