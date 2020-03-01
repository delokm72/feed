<html xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Зворотній звязок</title>
</head>
<body>
<h3>Залиште відгук!</h3>

<form action="./xmlWriter.php" method="post" enctype="multipart/form-data">
<label>Ваше iмя:</label><br/>
<input type="text" name="user_name" value=" "; > <br/>
<label>Ваша фамілія:</label><br/>
<input type="text" name="surname" value=""; > <br/>

<label>Ваш номер телефону:</label><br/>
<input type="digit" name="phone" value=" "; > <br/>
<label>Ваша поштова скринька:</label><br/>
<input type="text" name="user_email" value=" "; > <br/>
<label>Текст повідомлення:</label><br/>
<input type="text" name="text_comment">
<br/>

<label for="userfile">Прикріпити картинку:</label><br/>
<input id="userfile" name="userfile" type="file" value=""><br/>
<input type="submit" value="Відправити" name="btn_submit" />
</form>

<h3>Наявні відгуки:</h3>

<form action = "feedDelete.php" method = "POST">
    <?php
    $rss =  simplexml_load_file('feedback.xml');
    
    $json = json_encode($rss);
    $array = json_decode($json,TRUE);
  
    $feeds = array();
    foreach ($rss->feed as $item) {
      
      echo "<p> Name: ". $name = $item->name. "</p>";
      echo "<p>  Surname:  ". $surname = $item->surname. "</p>";
      echo "<p>  Phone:  ". $phone = $item->phone. "</p>";
      echo "<p>  e-mail:". $email = $item->email. "</p>";
      echo "<p> Feedback:   ". $text = $item->text. "</p>";
      $id = $item->id;    
     
      echo "<input name = \"$id\" type = \"submit\" value = \"delete this feedback (id=$id) \" />";
      }
   
    ?>
</form>

</body>
</html>