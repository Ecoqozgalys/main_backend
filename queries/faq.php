<?php
  session_start();

  // echo $_SESSION['user_id'];

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    $_SESSION['user_id'] = 'None';
  }
  if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = "None";
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    $_SESSION['user_id'] = 'None';
    header("location: login.php");
  }
?>
<!DOCTYPE php>
<php>
<head>
  <title>FAQ</title>
  <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo rand(111,999)?>">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Главная</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="locations.php">Пункты</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="blog.php">Блог</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="faq.php">FAQ</a>
      </li>
        <!-- logged in user information -->
        <?php
          if (isset($_SESSION['email'])) {
            echo "<li class='nav-item'><a class='nav-link' href='profile.php?user_id=".$_SESSION['user_id']."'>".$_SESSION['email']."</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='index.php?logout='1'' style='color: red;'>logout</a></li>";
          }
          else{
            echo "<a class='nav-link' href='login.php'>Войти</a></li>";
          }
        ?>
    </ul>
  </nav>
  <center >
    <section class="back2">
    <h5 class="l-heading" style="margin-bottom: 5vh;">Ответы на популярные вопросы</h5>
      <div class="faq-block">
        <img src="images/1.jpg">
        <div class="faq-div">
            <h4>1.  Зачем нужна сортировка мусора?</h4>
            <p style="margin-top: 5vh; color: rgb(33,92,34);">- уменьшить количество мусора, которое не идёт на переработку и вторичное использование, а закапывается на специальных полигонах для «захоронения» мусора. <br>- снизить расходы на вывоз мусора. <br>- экономить энергию и природные ресурсы. <br>Подробнее можете почитать об этом на странице <a href="">link</a></p>
        </div>
      </div>
      <div class="faq-block">
        <div class="faq-div">
              <h4>2.  Куда уезжает ваш отсортированный мусор?</h4>
              <p style="margin-top: 5vh; color: rgb(33,92,34);">Как только вы сдаете отсортированный мусор, от отправляется на переработку. Из переработанного пластика получают вторичный полиэстер, который входит в состав футболок, джинсов и другой повседневной одежды. Переработанный пластик найдется практически в любом доме и офисе. В частности, степлеры, дыроколы, линейки, контейнеры для ручек — все это может быть изготовлено из вторсырья. Также в некоторых странах, переработанный пластик используют для производства мебели, велосипедов и даже асфальта.</p>
        </div>
        <img src="images/2.jpg">
      </div>
      <div class="faq-block">
        <img src="images/3.jpg">
        <div class="faq-div">
              <h4>3.  Куда можно сдать старые вещи?</h4>
              <p style="margin-top: 5vh; color: rgb(33,92,34);">Ненужные вещи можно сдать в благотворительные проекты в помощь нуждающимся или магазины, использующие их для переработки. В H&M вы можете получить скидку 15%, сдав старый текстиль на переработку. Можете посмотреть локации таких центров и магазинов, перейдя по <a href="">link</a></p>
        </div>
      </div>
      <div class="faq-block">
        <div class="faq-div">
              <h4>4.  С чего мне начинать свой эко-путь?</h4>
              <p style="margin-top: 5vh; color: rgb(33,92,34);">Если вы совсем новичок в сортировке отходов, начните с чего-то одного — собирайте отдельно пластик, стекло или макулатуру. Как только освоитесь, добавляйте другой вид отходов. <br>
              Следующий шаг — установите дома второй контейнер для вторсырья. В него вы будете складывать все, что дальше можно отправить на переработку. А в свой привычный — отходы, которые нельзя переработать. <br>Подробнее можно почитать <a href = "">здесь</a>.
              Начинайте с малого, не бойтесь совершать ошибки и не забывайте себя хвалить. Мы верим, что вместе мы сможем справиться!</p>
        </div>
        <img src="images/44.jpg">
      </div>


      <?php

        $db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");
        // Altynay sql query
        // SELECT * FROM FAQ;
        // Get all data from FAQ
        
        $sql_query = " SELECT * from users";

        $result = oci_parse($db, $sql_query);
        oci_execute($result);

        $cnt = 1;

        while (($row = oci_fetch_array($result, OCI_BOTH)) != false) {
            echo "<div class='faq-block'>\n";

            if( $cnt % 2 == 1 ){
              $img_cnt = $cnt % 10;
              if( $img_cnt == 0 ){
                $img_cnt = 10;
              }
              echo "<img src='images/".strval($img_cnt) .".jpg'>";
            }

            echo "  <div class='faq-div'>\n";

            echo "<h4>".strval($cnt)." ".$row['FIRST_NAME']."</h4>\n"; // question
            echo "<p style='margin-top: 5vh; color: rgb(33,92,34);'>".$row['SECOND_NAME']."</p>"; // answer, problem with <br>

            echo "</div>";

            if( $cnt % 2 == 0 ){
              $img_cnt = $cnt % 10;
              if( $img_cnt == 0 ){
                $img_cnt = 10;
              }
              echo "<img src='images/".strval($img_cnt) .".jpg'>";
            }

            echo "</div>";
            $cnt ++;

        }

      ?>

      <h5 class="l-heading" style="margin-top: 5vh;">Задайте свой вопрос здесь</h5>
      <form class = "login" method="post" action="ask_question.php">
          <div class="rectangle">
            <img src = "images/logoo.png" >
            <h3>Задать вопрос</h3>
            <input class="form-control mr-sm-2 email" style="margin-top: 10px;" type="search" placeholder="Тема вопроса" name="topic" aria-label="Search">
            <input class="form-control mr-sm-2 email" style="margin-top: 10px;" type="search" placeholder="Вопрос" name="question" aria-label="Search">

            <button class="p" type="submit" name="ask_question">Отправить вопрос</button>
        </div>
      </section>

    </section>
  </center>
</body>
</php>
