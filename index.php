<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/index_style.css">
    <script src="js/index.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Сеошка - анализ SEO</title>
</head>

<body>
    <!-- обертка для ширины контента флексовый -->
    <div class="container_flex">
        <!-- шапка с логотипом -->
        <header>
            <div class="logo">
                <img src="img/logo.png" alt="logo">
            </div>
        </header>
        <main>
            <!-- форма для ввода домена -->
            <div class="form_get_url">
                <form action = "result.php" method = "GET">
                    <!-- тут вводится домен -->
                    <div class="url">
                        <input type="text" placeholder="Введите доменное имя" id = "send_link" name = "send_link">
                    </div>
                    <!-- кнопка отправки формы -->
                    <div class="button" id = "btn_go">
                        <input type="submit" value="Узнать SEO" >
                    </div>
                </form>
            </div>
        </main>
        <!-- логотип TYZ который на прототипе влепил Дима -->
        <footer>
        <div class="logo_tyz">
        <p style = "margin-left:auto;margin-right:auto;" align= "center">Alt+3 Studio, Хакатон Вконтакте Белгород 2020</p>
            </div>
        </footer>
    </div>
</body>

</html>