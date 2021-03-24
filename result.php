<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/other_style.css">
    <link rel="stylesheet" href="styles/rating.css">
    <link rel="stylesheet" href="styles/circle_stroke.css">
    <script src="js/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <script type="text/javascript">
        $(document).ready(function() {
            $("#pages").fancybox({
                'titlePosition': 'inside',
                'transitionIn': 'none',
                'transitionOut': 'none'
            });
        });
        $(document).ready(function() {
            $("#payment").fancybox({
                'titlePosition': 'inside',
                'transitionIn': 'none',
                'transitionOut': 'none'
            });
        });
        $(document).ready(function() {
            $("#price").fancybox({
                'titlePosition': 'inside',
                'transitionIn': 'none',
                'transitionOut': 'none'
            });
        });
        $(document).ready(function() {
            $("#sales").fancybox({
                'titlePosition': 'inside',
                'transitionIn': 'none',
                'transitionOut': 'none'
            });
        });
        $(document).ready(function() {
            $("#feedbacks").fancybox({
                'titlePosition': 'inside',
                'transitionIn': 'none',
                'transitionOut': 'none'
            });
        });
        $(document).ready(function() {
            $("#contacts").fancybox({
                'titlePosition': 'inside',
                'transitionIn': 'none',
                'transitionOut': 'none'
            });
        });
        $(document).ready(function() {
            $("#other").fancybox({
                'titlePosition': 'inside',
                'transitionIn': 'none',
                'transitionOut': 'none'
            });
        });
    </script>

    <script src="js/result.js"></script>
    <title>Сеошка - анализ SEO</title>
</head>

<body>
    <!-- контейнер для ширины контента на гридах -->
    <div class="container">
        <!-- шапка с лого -->
        <header>
            <div class="logo">
                <img src="img/logo.png" alt="logo">
            </div>
        </header>
        <main>
            <p style="margin-left:auto;margin-right:auto;" align="center">Анализ сайта: <?= $_GET['send_link'] ?></p><br>
            <!-- див для для размещения основного контента и кнопок навигации на гридах -->
            <div class="content">

                <div class="main_content">
                    <!-- круг, если хочешь обводку у круга, то добавляй класс stroke(цифра - количество набратых звезд) -->
                    <div class="circle" id="circle">
                    </div>
                    <!-- свойства которые выдаст сео программа -->
                    <div class="properties_seo">
                        <input type="text" value="<?= $_GET['send_link'] ?>" id="send_link" hidden>
                        <!-- класс row - каждый див одно свойство, можно влепить любое количество свойств, вид у сайта будет более менее приличный -->
                        <div class="row">
                            <!-- кнопка для будущего модального окна -->
                            <input type="button" value="Страницы" id="pages" href="#pages_window">
                            <!-- див с звездным рейтингом, тут в див тоже добавляй класс, сколько звезд нужно закрасить желтым checked_(количество звезд) -->
                            <div class="rating" id="rating1">
                                <!-- спаны и классы не трогать -->
                                <span class="not1">
                                    ★
                                </span>
                                <span class="not2">
                                    ★
                                </span>
                                <span class="not3">
                                    ★
                                </span>
                                <span class="not4">
                                    ★
                                </span>
                                <span class="not5">
                                    ★
                                </span>
                            </div>
                            <div style="display: none;">
                                <div id="pages_window" style="width:400px;height:250px;overflow:hidden;padding:20px;display:flex;">
                                    <p id = "page_html" style="overflow:auto">Модалка на страницы</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- кнопка для будущего модального окна -->
                            <input type="button" value="Оплата и доставка" id="payment" href="#payment_window">
                            <!-- див с звездным рейтингом, тут в див тоже добавляй класс, сколько звезд нужно закрасить желтым checked_(количество звезд) -->
                            <div class="rating" id="rating2">
                                <!-- спаны и классы не трогать -->
                                <span class="not1">
                                    ★
                                </span>
                                <span class="not2">
                                    ★
                                </span>
                                <span class="not3">
                                    ★
                                </span>
                                <span class="not4">
                                    ★
                                </span>
                                <span class="not5">
                                    ★
                                </span>
                            </div>
                            <div style="display: none;">
                                <div id="payment_window" style="width:400px;height:250px;overflow:hidden;padding:20px;display:flex;">
                                    <p id = "payment_html">Модалка на оплату и доставку</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="button" value="Цены" id="price" href="#price_window">
                            <div class="rating" id="rating3">
                                <span class="not1">
                                    ★
                                </span>
                                <span class="not2">
                                    ★
                                </span>
                                <span class="not3">
                                    ★
                                </span>
                                <span class="not4">
                                    ★
                                </span>
                                <span class="not5">
                                    ★
                                </span>
                            </div>
                            <div style="display: none;">
                                <div id="price_window" style="width:400px;height:250px;overflow:hidden;padding:20px;display:flex;">
                                    <p id = "price_html">Модалка на цены</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="button" value="Акции" id="sales" href="#sales_window">
                            <div class="rating" id="rating4">
                                <span class="not1">
                                    ★
                                </span>
                                <span class="not2">
                                    ★
                                </span>
                                <span class="not3">
                                    ★
                                </span>
                                <span class="not4">
                                    ★
                                </span>
                                <span class="not5">
                                    ★
                                </span>
                            </div>
                            <div style="display: none;">
                                <div id="sales_window" style="width:400px;height:250px;overflow:hidden;padding:20px;display:flex;">
                                    <p id = "sales_html">Модалка на акции</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="button" value="Отзывы" id="feedbacks" href="#feedbacks_window">
                            <div class="rating" id="rating5">
                                <span class="not1">
                                    ★
                                </span>
                                <span class="not2">
                                    ★
                                </span>
                                <span class="not3">
                                    ★
                                </span>
                                <span class="not4">
                                    ★
                                </span>
                                <span class="not5">
                                    ★
                                </span>
                            </div>
                            <div style="display: none;">
                                <div id="feedbacks_window" style="width:400px;height:250px;overflow:hidden;padding:20px;display:flex;">
                                    <p id = "feedbacks_html">Модалка на отзывы</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="button" value="Контакты" id="contacts" href="#contacts_window">
                            <div class="rating" id="rating6">
                                <span class="not1">
                                    ★
                                </span>
                                <span class="not2">
                                    ★
                                </span>
                                <span class="not3">
                                    ★
                                </span>
                                <span class="not4">
                                    ★
                                </span>
                                <span class="not5">
                                    ★
                                </span>
                            </div>
                            <div style="display: none;">
                                <div id="contacts_window" style="width:400px;height:250px;overflow:hidden;padding:20px;display:flex;">
                                    <p id = "contacts_html">Модалка на контакты</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="button" value="Другое" id="other" href="#other_window">
                            <div class="rating" id="rating7">
                                <span class="not1">
                                    ★
                                </span>
                                <span class="not2">
                                    ★
                                </span>
                                <span class="not3">
                                    ★
                                </span>
                                <span class="not4">
                                    ★
                                </span>
                                <span class="not5">
                                    ★
                                </span>
                            </div>
                            <div style="display: none;">
                                <div id="other_window" style="width:400px;height:250px;overflow:hidden;padding:20px;display:flex;">
                                    <p id = "other_html">Модалка на другое</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navigation">
                    <!-- кнопки навигации -->
                    <input type="button" value="Назад" class="nav_end" id="btn_back">
                    <input type="button" value="Обновить" id="btn_reset">
                </div>
            </div>
        </main>
        <!-- логотип TYZ который на прототипе влепил Дима -->
        <footer class="footer">
            <div class="logo_tyz">
                <p style="margin-left:auto;margin-right:auto;" align="center">Alt+3 Studio, Хакатон Вконтакте Белгород 2020</p>
            </div>
        </footer>
    </div>
</body>

</html>