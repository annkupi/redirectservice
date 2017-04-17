<html>
<head>
    <title> ShortLink </title>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="style.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        function getLink() {
            var longLink = $('input[name="input"]').val();
            $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: 'generated.php',
                    data: 'input=' + longLink,
                    success: function (result)
                    {
                        $('#output').html("new ajax link: " + result);
//                        $('#inputoutput').html("OLD ajax link: " + longLink);
                    }
            });
        }
    </script>

</head>
<body>

<!--    <form name="linkInput" method="post">-->
        <p class="labelForm"> Сокращение ссылок </p>
        <p>
            <input type="text" name="input" id="input" size="60" placeholder="Введите ссылку" />
        </p>
        <p>
            <input type="button" name="submit" id="submit" value="Сгенерировать" onClick="getLink()" />
        </p>
        <p>
            Короткая ссылка: <br>
            <!--
            <input type="text" name="output" id="output" size="60" placeholder="Здесь появится ссылка">
            -->
            <div id="output"></div>
            <!--
            Исходная: <br>
            <div id="inputoutput"></div>
            -->
        </p>
<!--    </form>-->

</body>
</html>