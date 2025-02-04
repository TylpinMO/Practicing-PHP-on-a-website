<!DOCTYPE html>
<html>
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
    <div id="menu">
      <div class="menu-item"><a href="index.html">Главная</a></div>
      <div class="menu-item"
      onmouseover='document.getElementById("sm").style.display="block"'
      onmouseout='document.getElementById("sm").style.display="none"'>
        <a href="#">Каталог товаров</a>
        <div id="sm" class="submenu">
          <a href="pages/Smartphones.html">Смартфоны</a>
          <a href="pages/Phones.html">Кнопочные телефоны</a>
          <a href="pages/Accessories.html">Аксессуары</a>
        </div>
      </div>
      <div class="menu-item"><a href="pages/company.html">О компании</a></div>
      <div class="menu-item"><a href="pages/contacts.html">Контакты</a></div>
      <div class="menu-item"><a href="pages/gallery.html">Галерея</a></div>
    </div>
    <div id="db_res">
      <?
      function display_form() {
        $submit_msg = "Добавить запись";
        ?>
      <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>">
        <?
        if ($_REQUEST["id"]){
          $sql = "SELECT * FROM товары WHERE id=".$_REQUEST["id"];
          $tr = mysql_fetch_array(mysql_query($sql));
          ?>
        <input type="hidden" name="id" value="<? echo $tr["id"] ?>">
        <?
          $submit_msg = "Изменить запись";
        }
        ?>
        <table border="0">
          <tr>
            <td>Название товара:</td>
            <td><input type="text" name="name" size="30" maxlength="30"
             value="<? echo $tr["товар"]; ?>"></td>
          </tr>
          <tr>
            <td>Категория товара:</td>
            <td><select name="categoria">
                <option <? if ($tr["категория"]=='Смартфоны' ) echo 'selected' ; ?>>Смартфоны</option>
                <option <? if ($tr["категория"]=='Телефоны' ) echo 'selected' ; ?>>Телефоны</option>
                <option <? if ($tr["категория"]=='Аксессуары' ) echo 'selected' ; ?>>Аксессуары</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Описание товара:</td>
            <td><textarea name="description" rows="5" cols="40" maxlength="255"><? echo $tr["описание"] ?></textarea></td>
          </tr>
          <tr>
            <td>Цена:</td>
            <td><input type="number" name="price" min="0" max="9999.99" value="<? echo $tr["цена"]; ?>"></td>
          </tr>
          <tr>
            <td>Количество:</td>
            <td><input type="number" name="qty" min="1" max="65000" value="<? echo $tr["количество"]; ?>"></td>
          </tr>
          <tr>
            <td>Дата поставки:</td>
            <td><input type="date" name="date" value="<? echo $tr["дата"]; ?>"></td>
          </tr>
          <tr>
            <td>Поставщик:</td>
            <td><select name="firma">
                <option <? if ($tr["поставщик"]=='apple' )
                echo 'selected' ; ?>>apple</option>
                <option <? if ($tr["поставщик"]=='samsung' )
                echo 'selected' ; ?>>samsung</option>
                <option <? if ($tr["поставщик"]=='honor' )
                echo 'selected' ; ?>>honor</option>
                <option <? if ($tr["поставщик"]=='xiaomi' )
                echo 'selected' ; ?>>xiaomi</option>
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="sumbit" value="<? echo $submit_msg; ?>"></td>
          </tr>
        </table>
      </form>
      <? } ?>
      <? 
      function change_db() {
        if (($_REQUEST['name'] && $_REQUEST['categoria'] && $_REQUEST['description'] &&
        $_REQUEST['price'] && $_REQUEST['qty'] && $_REQUEST['date'] && $_REQUEST['firma']) ||
        ($_REQUEST['submit'] == 'delete')){
          $name = $_REQUEST['name'];
          $categoria = $_REQUEST['categoria'];
          $description = $_REQUEST['description'];
          $price = $_REQUEST['price'];
          $qty = $_REQUEST['qty'];
          $date = $_REQUEST['date'];
          $firma = $_REQUEST['firma'];
          if (!$_REQUEST["id"]) {
            $sql = "INSERT INTO товары (товар, категория, описание, цена, количество, дата, поставщик)
            VALUES  ('$name','$categoria','$description', $price, $qty,'$date','$firma')";
            $info_msg = "Запись добавлена";
          } else if ($_REQUEST["sumbit"] == 'delete'){
            $sql = "DELETE FROM товары WHERE id=".$_REQUEST['id'];
            $info_msg = "Запись №" . $_REQUEST['id'] . " удалена";
          } else {
            $sql = "UPDATE товары SET товар='$name', категория='$categoria', описание='$description',
            цена=$price, количество=$qty, дата='$date', поставщик='$firma'
            WHERE id=".$_REQUEST['id'];
            $info_msg = "Запись изменена";
          }
          mysql_query($sql);
          echo '<p class="info_msg">' . $info_msg . "</p>";
          }
      } ?>
      <? function print_list(){
        echo "<table id='res'>
        <tr bgcolor=#eeeeee>
        <th>id</th><th>Название</th><th>Категория</th><th>Описание</th>
        <th>Цена</th><th>Количество</th><th>Дата поставки</th><th>Поставщик</th>
        <th colspan=2>Редактирование</th></tr>";
        $result = mysql_query("SELECT * FROM товары");
        while ($tr = mysql_fetch_array($result)) {
          $d = explode("-",$tr['дата']);
          $strd = $d[2].".".$d[1].".".$d[0];
          printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td class='td'>%s</td>
          <td class='td'>%s</td><td class='td'>%s</td><td>%s</td>",
          $tr['id'], $tr['товар'], $tr['категория'], nl2br($tr['описание']),
          $tr['цена'], $tr['количество'], $strd, $tr['поставщик']);
          printf("<td><a href=\"%s?id=%s\"><img alt='(изменить)' src='#'></a></td>",
          $_SERVER['PHP_SELF'], $tr['id']);
          printf("<td><a href=\"%s?id=%s&submit=delete\"><img alt='(удалить)' src='#'></a></td></tr>",
          $_SERVER['PHP_SELF'], $tr['id']);
        }
        echo "</table><p></p>";
        echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">
        <img alt="Новая запись" src="#"></a></p>';
      }
      mysql_select_db("mobileshop", mysql_connect("localhost", "root"));
      if ($_REQUEST["sumbit"]) {change_db();}
      print_list();
      display_form();
      ?>
    </div>
   <footer>
        <div>
          <p>MobileShop &copy; <script> d = new Date(); document.write(d.getFullYear()); </script>
            Все права защищены</p>
        </div>
        <div><p></p></div>
        <div>
          <p> За получением дополнительной информации пишите на электронную почту info@mydomain.ru</p>
        </div>
      </footer>
    </div>
  </body>
</html>