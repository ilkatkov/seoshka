window.onload = function() {

    var send_link = document.getElementById("send_link").value;
    var btn_back = document.getElementById("btn_back");
    var btn_reset = document.getElementById("btn_reset");
    let payment_points = 0;
    let price_points = 0;
    let sales_points = 0;
    let feedbacks_points = 0;
    let contacts_points = 0;
    let other_points = 0;
    let total = 0;


    $.ajax({
        async: true,
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "about_us", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(Object.getOwnPropertyNames(data).length + " - о компании"); // выводим количество найденных слов о компании
                if (Object.getOwnPropertyNames(data).length == 1 || Object.getOwnPropertyNames(data).length == 2) {
                    contacts_points = 1;
                } else if (Object.getOwnPropertyNames(data).length == 2 || Object.getOwnPropertyNames(data).length == 3) {
                    contacts_points = 3;
                } else if (Object.getOwnPropertyNames(data).length == 4) {
                    contacts_points = 4;
                } else if (Object.getOwnPropertyNames(data).length >= 5) {
                    contacts_points = 5;
                }
                total = total + 1;
            } catch (error) {
                console.log("О компании - не найдено");
            }
        }
    });



    $.ajax({
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "delivery", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(Object.getOwnPropertyNames(data).length + " - о доставке"); // выводим количество найденных слов о доставке
                if (Object.getOwnPropertyNames(data).length == 1 || Object.getOwnPropertyNames(data).length == 2) {
                    payment_points = 1;
                } else if (Object.getOwnPropertyNames(data).length == 2 || Object.getOwnPropertyNames(data).length == 3) {
                    payment_points = 3;
                } else if (Object.getOwnPropertyNames(data).length == 4) {
                    payment_points = 4;
                } else if (Object.getOwnPropertyNames(data).length >= 5) {
                    payment_points = 5;
                }
                total = total + 1;
            } catch (error) {
                console.log("О доставке - не найдено")
            }
        },
    });


    $.ajax({
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "payment", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(Object.getOwnPropertyNames(data).length + " - об оплате"); // выводим количество найденных слов об оплате
                if (Object.getOwnPropertyNames(data).length == 1 || Object.getOwnPropertyNames(data).length == 2) {
                    payment_points = 1;
                } else if (Object.getOwnPropertyNames(data).length == 2 || Object.getOwnPropertyNames(data).length == 3) {
                    payment_points = 3;
                } else if (Object.getOwnPropertyNames(data).length == 4) {
                    payment_points = 4;
                } else if (Object.getOwnPropertyNames(data).length >= 5) {
                    payment_points = 5;
                }
                total = total + 1;
            } catch (error) {
                console.log("Об оплате - не найдено")
            }
        },
    });

    $.ajax({
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "warranty", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(Object.getOwnPropertyNames(data).length + " - о гарантии"); // выводим количество найденных слов о гарантии
                if (Object.getOwnPropertyNames(data).length == 1 || Object.getOwnPropertyNames(data).length == 2) {
                    price_points = 1;
                } else if (Object.getOwnPropertyNames(data).length == 2 || Object.getOwnPropertyNames(data).length == 3) {
                    price_points = 3;
                } else if (Object.getOwnPropertyNames(data).length == 4) {
                    price_points = 4;
                } else if (Object.getOwnPropertyNames(data).length >= 5) {
                    price_points = 5;
                }
                total = total + 1;
            } catch (error) {
                console.log("О гарантии - не найдено");
            }
        },
    });

    $.ajax({
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "return", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(Object.getOwnPropertyNames(data).length + " - о возврате"); // выводим количество найденных слов о возврате
                if (Object.getOwnPropertyNames(data).length == 1 || Object.getOwnPropertyNames(data).length == 2) {
                    price_points = 1;
                } else if (Object.getOwnPropertyNames(data).length == 2 || Object.getOwnPropertyNames(data).length == 3) {
                    price_points = 3;
                } else if (Object.getOwnPropertyNames(data).length == 4) {
                    price_points = 4;
                } else if (Object.getOwnPropertyNames(data).length >= 5) {
                    price_points = 5;
                }
                total = total + 1;
            } catch (error) {
                console.log("О возврате - не найдено");
            }
        },
    });


    $.ajax({
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "sales", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(Object.getOwnPropertyNames(data).length + " - об акциях"); // выводим количество найденных слов об акциях
                if (Object.getOwnPropertyNames(data).length == 1 || Object.getOwnPropertyNames(data).length == 2) {
                    sales_points = 1;
                } else if (Object.getOwnPropertyNames(data).length == 2 || Object.getOwnPropertyNames(data).length == 3) {
                    sales_points = 3;
                } else if (Object.getOwnPropertyNames(data).length == 4) {
                    sales_points = 4;
                } else if (Object.getOwnPropertyNames(data).length >= 5) {
                    sales_points = 5;
                }
                total = total + 1;
            } catch (error) {
                console.log("Об акциях - не найдено");
            }
        },
    });


    $.ajax({
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "prices", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(Object.getOwnPropertyNames(data).length + " - о ценах"); // выводим количество найденных слов о ценах
                if (Object.getOwnPropertyNames(data).length == 1 || Object.getOwnPropertyNames(data).length == 2) {
                    price_points = 1;
                } else if (Object.getOwnPropertyNames(data).length == 2 || Object.getOwnPropertyNames(data).length == 3) {
                    price_points = 3;
                } else if (Object.getOwnPropertyNames(data).length == 4) {
                    price_points = 4;
                } else if (Object.getOwnPropertyNames(data).length >= 5) {
                    price_points = 5;
                }
                total = total + 1;
            } catch (error) {
                console.log("О ценах - не найдено");
            }
        },
    });

    $.ajax({
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "feedbacks", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(Object.getOwnPropertyNames(data).length + " - об отзывах"); // выводим количество найденных слов об отзывах
                if (Object.getOwnPropertyNames(data).length == 1 || Object.getOwnPropertyNames(data).length == 2) {
                    feedbacks_points = 1;
                } else if (Object.getOwnPropertyNames(data).length == 2 || Object.getOwnPropertyNames(data).length == 3) {
                    feedbacks_points = 3;
                } else if (Object.getOwnPropertyNames(data).length == 4) {
                    feedbacks_points = 4;
                } else if (Object.getOwnPropertyNames(data).length >= 5) {
                    feedbacks_points = 5;
                }
                total = total + 1;
            } catch (error) {
                console.log("Об отзывах - не найдено");
            }
        },
    });

    $.ajax({
        type: 'post',
        url: '../functions/seo.php',
        data: { part: "other", link: send_link },
        async: false,
        success: function(about_us) {
            try {
                data = JSON.parse(about_us);
                console.log(parseInt(data[0], 10) + " - об другом"); // выводим количество найденных слов о другом
                other_points = parseInt(data[0], 10);
                total = total + 1;
            } catch (error) {
                console.log("Об отзывах - не найдено");
            }
        },
    });

    btn_back.onclick = function() {
        location.href = "index.php";
    }
    btn_reset.onclick = function() {
        location.href = "result.php?send_link=" + send_link;
    }
    if (total >= 5) {
        total = 5;
    }

    btn_page = document.getElementById("pages");
    btn_page.onclick = function() {
        if (total <= 1) {
            document.getElementById("page_html").innerHTML = "Вам срочно следует подумать над исправлением данной ситуации, требуется добавить дополнительные страницы.";
        } else if (total == 2) {
            document.getElementById("page_html").innerHTML = "Может быть лучше, подумайте над этим, требуется больше дополнительных страниц.";
        } else if (total == 3) {
            document.getElementById("page_html").innerHTML = "Средний результат, стремитесь к более лучшему, необходимо еще немного добавить информативных страниц.";
        } else if (total == 4) {
            document.getElementById("page_html").innerHTML = "Почти отлично, пара поправок все исправят.";
        } else if (total == 5) {
            document.getElementById("page_html").innerHTML = "Отличный результат, так держать!";
        }
    }

    btn_payment = document.getElementById("payment");
    btn_payment.onclick = function() {
        if (payment_points <= 1) {
            document.getElementById("payment_html").innerHTML = "Вам срочно следует подумать над исправлением данной ситуации, информации об оплате либо отсутствует, либо раскрыта чрезвычайно плохо.";
        } else if (payment_points == 2) {
            document.getElementById("payment_html").innerHTML = "Может быть лучше, подумайте над этим, информации об оплате мало, необходимо дополнить страницу контентом.";
        } else if (payment_points == 3) {
            document.getElementById("payment_html").innerHTML = "Средний результат, стремитесь к более лучшему, информации об оплате среднее количество, для более успешного продвижения необходимо дополнить ключевыми словами";
        } else if (payment_points == 4) {
            document.getElementById("payment_html").innerHTML = "Информации об оплате почти достаточно, поисковые роботы будут хорошо понимать суть страницы.";
        } else if (payment_points == 5) {
            document.getElementById("payment_html").innerHTML = "Отличный результат, так держать! Информация об оплате на отличном уровне, поисковые роботы будут прекрасно понимать суть страницы.";
        }
    }

    btn_price = document.getElementById("price");
    btn_price.onclick = function() {
        if (price_points <= 1) {
            document.getElementById("price_html").innerHTML = "Вам срочно следует подумать над исправлением данной ситуации, информации о ценах либо отсутствует, либо раскрыта чрезвычайно плохо.";
        } else if (price_points == 2) {
            document.getElementById("price_html").innerHTML = "Может быть лучше, подумайте над этим, информации о ценах мало, необходимо дополнить страницу контентом.";
        } else if (price_points == 3) {
            document.getElementById("price_html").innerHTML = "Средний результат, стремитесь к более лучшему, информации о ценах среднее количество, для более успешного продвижения необходимо дополнить ключевыми словами";
        } else if (price_points == 4) {
            document.getElementById("price_html").innerHTML = "Информации о ценах почти достаточно, поисковые роботы будут хорошо понимать суть страницы.";
        } else if (price_points == 5) {
            document.getElementById("price_html").innerHTML = "Отличный результат, так держать! Информация о ценах на отличном уровне, поисковые роботы будут прекрасно понимать суть страницы.";
        }
    }

    btn_sales = document.getElementById("sales");
    btn_sales.onclick = function() {
        if (sales_points <= 1) {
            document.getElementById("sales_html").innerHTML = "Вам срочно следует подумать над исправлением данной ситуации, информации об акциях либо отсутствует, либо раскрыта чрезвычайно плохо.";
        } else if (sales_points == 2) {
            document.getElementById("sales_html").innerHTML = "Может быть лучше, подумайте над этим, информации об акциях мало, необходимо дополнить страницу контентом.";
        } else if (sales_points == 3) {
            document.getElementById("sales_html").innerHTML = "Средний результат, стремитесь к более лучшему, информации об акциях среднее количество, для более успешного продвижения необходимо дополнить ключевыми словами";
        } else if (sales_points == 4) {
            document.getElementById("sales_html").innerHTML = "Информации об акциях почти достаточно, поисковые роботы будут хорошо понимать суть страницы.";
        } else if (sales_points == 5) {
            document.getElementById("sales_html").innerHTML = "Отличный результат, так держать! Информация об акциях на отличном уровне, поисковые роботы будут прекрасно понимать суть страницы.";
        }
    }

    btn_feedbacks = document.getElementById("feedbacks");
    btn_feedbacks.onclick = function() {
        if (feedbacks_points <= 1) {
            document.getElementById("feedbacks_html").innerHTML = "Вам срочно следует подумать над исправлением данной ситуации, информации об отзывах либо отсутствует, либо раскрыта чрезвычайно плохо.";
        } else if (feedbacks_points == 2) {
            document.getElementById("feedbacks_html").innerHTML = "Может быть лучше, подумайте над этим, информации об отзывах мало, необходимо дополнить страницу контентом.";
        } else if (feedbacks_points == 3) {
            document.getElementById("feedbacks_html").innerHTML = "Средний результат, стремитесь к более лучшему, информации об отзывах среднее количество, для более успешного продвижения необходимо дополнить ключевыми словами";
        } else if (feedbacks_points == 4) {
            document.getElementById("feedbacks_html").innerHTML = "Информации об отзывах почти достаточно, поисковые роботы будут хорошо понимать суть страницы.";
        } else if (feedbacks_points == 5) {
            document.getElementById("feedbacks_html").innerHTML = "Отличный результат, так держать! Информация об отзывах на отличном уровне, поисковые роботы будут прекрасно понимать суть страницы.";
        }
    }

    btn_contacts = document.getElementById("contacts");
    btn_contacts.onclick = function() {
        if (contacts_points <= 1) {
            document.getElementById("contacts_html").innerHTML = "Вам срочно следует подумать над исправлением данной ситуации, информации о контактах либо отсутствует, либо раскрыта чрезвычайно плохо.";
        } else if (contacts_points == 2) {
            document.getElementById("contacts_html").innerHTML = "Может быть лучше, подумайте над этим, информации о контактах мало, необходимо дополнить страницу контентом.";
        } else if (contacts_points == 3) {
            document.getElementById("contacts_html").innerHTML = "Средний результат, стремитесь к более лучшему, информации о контактах среднее количество, для более успешного продвижения необходимо дополнить ключевыми словами";
        } else if (contacts_points == 4) {
            document.getElementById("contacts_html").innerHTML = "Информации о контактах почти достаточно, поисковые роботы будут хорошо понимать суть страницы.";
        } else if (contacts_points == 5) {
            document.getElementById("contacts_html").innerHTML = "Отличный результат, так держать! Информация о контактах на отличном уровне, поисковые роботы будут прекрасно понимать суть страницы.";
        }
    }

    btn_other = document.getElementById("other");
    btn_other.onclick = function() {
        if (other_points <= 1) {
            document.getElementById("other_html").innerHTML = "Вам срочно следует подумать над исправлением данной ситуации, информации о другом либо отсутствует, либо раскрыта чрезвычайно плохо.";
        } else if (other_points == 2) {
            document.getElementById("other_html").innerHTML = "Может быть лучше, подумайте над этим, информации о другом мало, необходимо дополнить страницу контентом.";
        } else if (other_points == 3) {
            document.getElementById("other_html").innerHTML = "Средний результат, стремитесь к более лучшему, информации о другом среднее количество, для более успешного продвижения необходимо дополнить ключевыми словами";
        } else if (other_points == 4) {
            document.getElementById("other_html").innerHTML = "Информации о другом почти достаточно, поисковые роботы будут хорошо понимать суть страницы.";
        } else if (other_points == 5) {
            document.getElementById("other_html").innerHTML = "Отличный результат, так держать! Информация о другом на отличном уровне, поисковые роботы будут прекрасно понимать суть страницы.";
        }
    }




    document.getElementById("rating2").className += " checked_" + payment_points;
    document.getElementById("rating3").className += " checked_" + price_points;
    document.getElementById("rating4").className += " checked_" + sales_points;
    document.getElementById("rating5").className += " checked_" + feedbacks_points;
    document.getElementById("rating6").className += " checked_" + contacts_points;
    document.getElementById("rating7").className += " checked_" + other_points;
    document.getElementById("circle").className += " stroke" + (total + payment_points + price_points + sales_points + feedbacks_points + contacts_points + other_points);
    document.getElementById("rating1").className += " checked_" + total;

    console.log("Оплата и доставка - " + payment_points);
    console.log("Цены - " + price_points);
    console.log("Акции - " + sales_points);
    console.log("Отзывы - " + feedbacks_points);
    console.log("Контакты - " + contacts_points);
    console.log("Другое - " + other_points);
    console.log("Общее по разделам - " + total);
    console.log("Итоговая оценка - " + (total + payment_points + price_points + sales_points + feedbacks_points + contacts_points + other_points));
}