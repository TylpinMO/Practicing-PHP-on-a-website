<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MobileShop</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="menu.js"></script>
  </head>
  <body onload="allClose('mainmenu')">
    <div id="mainWrapper">
      <header>
        <div id="logo">
          <img src="images/MobileShop.jpg" alt="MobileShop" width="165px" />
        </div>
        <div id="HeaderLinks">
          <a href="#" title="Вход/Регистрация">Вход/Регистрация</a>
          <a href="#" title="Корзина">Корзина</a>
        </div>
      </header>
      <section id="offer" class="offertext">
        <h2>Время покупок!</h2>
        <p>Большие скидки на все товары!</p>
      </section>
      <div>
        <marquee scrollamount="5" scrolldelay="100">
          Добро пожаловать на главную страницу магазина!</marquee>
      </div>
      <div id="content">
        <section class="sidebar">
          <input type="text" id="search" value="поиск" />
          <div id="menubar">
            <nav class="menu">
              <h2>Навигация</h2>
              <hr />
              <ul id="mainmenu">
                <li><a href="index.html">Главная</a></li>
                <li>
                  <a href="#" onclick="openMenu(this);return false">Каталог товаров</a>
                  <ul>
                    <li><a href="pages/Smartphones.html">Смартфоны</a></li>
                    <li><a href="pages/Phones.html">Кнопочные телефоны</a></li>
                    <li><a href="pages/Accessories.html">Аксессуары</a></li>
                  </ul>
                </li>
                <li><a href="pages/company.html">О компании</a></li>
                <li><a href="pages/contacts.html">Контакты</a></li>
                <li><a href="pages/gallery.html">Галерея</a></li>
              </ul>
              <hr />
            </nav>
            <form action="vote.php" method="POST">
              <p class="vote">Как вы оцениваете наш<br>магазин?</p>
              <p class="vote">
                  <input type="radio" name="vote" value="5" checked>&nbsp;отлично<br>
                  <input type="radio" name="vote" value="4" >&nbsp;хорошо<br>
                  <input type="radio" name="vote" value="3" >&nbsp;удовлетворительно<br>
                  <input type="radio" name="vote" value="2" >&nbsp;плохо<br>
              </p>
              <input type="submit" value="Отдать голос" class="buttonvote">
          </form>
          </div>
        </section>
        <section class="mainContent">
<?php
if (@$_POST['vote']){
    $file=$_POST['vote'].".txt";
    $f=@fopen($file,"r");
    $votes=fread($f,100);
    fclose($f);
    $votes++;
    $f=@fopen($file,"w");
    fwrite($f,$votes);
    fclose($f);
}
echo "<p class='voteres'>Результаты голосования:<br/>";
$max=0;
for ($i=2; $i<=5; $i++){
    $f=@fopen($i.".txt","r");
    $v[$i-2]=fread($f,100);
    fclose($f);
    if (empty($v[$i-2])) $v[$i-2]=0;
    if ($v[$i-2] > $max) $max=$v[$i-2];
}
echo "<table>";
for ($i=3; $i>=0; $i--) {
    echo "<tr><td class='vote'>" . ($i+2) . " - " . $v[$i] ." чел.</td>";
    $w=floor($v[$i]/$max*100);
    ?><td>
        <hr align="left" color="red" size="20" width="<?=$w?>">
</td></tr>
<? } ?>
</table>
<hr align="left" width="200">
<p class="voteres"> Максимум = <?=$max?></p>
</section>
      </div>
      <footer>
        <div>
          <p>
            MobileShop &copy;
            <script>
              d = new Date();
              document.write(d.getFullYear());
            </script>
            Все права защищены
          </p>
        </div>
        <div><p></p></div>
        <div>
          <p>
            За получением дополнительной информации пишите на электронную почту
            info@mydomain.ru
          </p>
        </div>
      </footer>
    </div>
  </body>
</html>