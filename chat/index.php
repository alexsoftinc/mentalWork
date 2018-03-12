<?php
include_once 'libs/SomeDB.php';

$db = DataB::run();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat integration</title>
    <script src="libs/jquery.js"></script>

    <script>
        $(document).ready(function() {
            var button = $("#sended_mess");
            // Именно через массив data и передаём нужные праметры серверу
            button.click(function() {
                var text = $("#chat_mess").val();
                // Пошли AJax запросы
                if(text == "") {
                    alert("Введите текст");
                } else {
                    $.ajax({
                        url: "someAction.php",
                        type: "POST",
                        data: {text: text},
                        success: function(){
                            $("textarea").val("");
                        }
                    });
                }

            });
            // Создаётся тут динамическая подгрузка данных тобишь нечто автообновления
            window.setInterval(function () {
                var id = $("li:first").attr("id");

                // Пошли AJax запросы только на Интервал
                $.ajax({
                    url: "someAction_interval.php",
                    type: "POST",
                    data: {id:id},
                    success: function(data) {
                        // првоерка результата на новое сообщение в чате
                        if(data == 1)
                        {

                        }
                        else
                        {
                            $(".chat_null").remove();
                            $("ul").prepend(data);
                        }
                    }
                });
            }, 1000);

        });
    </script>
    <style>
        #wrap_chat_box
        {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 0 auto;
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="wrap_chat_box">
        <div style="height: 250px; overflow: auto;">
            <ul>
                <?php
                    $getMessage = $db->query("SELECT * FROM chat_message ORDER BY id DESC");

                    $message = $getMessage->fetchAll(PDO::FETCH_OBJ);

                    if($getMessage->rowCount() > 0)
                    {
                        foreach ($message as $itemMessage):
                            echo '<li id="'. $itemMessage->id .'">' . $itemMessage->text_m . '</li>';
                        endforeach;
                    }
                    else
                    {
                        echo '<span class="chat_null">Chat is clear</span>';
                    }
                ?>
            </ul>
        </div>

        <div id="wrap_textarea">
            <textarea style="width: 290px;" id="chat_mess"></textarea>
            <button id="sended_mess">Send</button>
        </div>
    </div>
</div>
</body>
</html>
