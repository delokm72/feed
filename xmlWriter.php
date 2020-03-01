<?php
$rss =  simplexml_load_file('feedback.xml');
$id =  $rss->r1->total;           //значення ІД, з кожним постом воно зростає

$name = $_POST['user_name'];
$surname = $_POST['surname'];
$text = $_POST['text_comment'];
$email = $_POST['user_email'];
$phone = $_POST['phone'];

$sxe = new SimpleXMLElement('feedback.xml', NULL, TRUE);
$feed = $sxe->addChild('feed');
$feed->addChild('id', $id+1);
$feed->addChild('name', $name);
$feed->addChild('email', $email);
$feed->addChild('phone', $phone);
$feed->addChild('surname', $surname);
$feed->addChild('text', $text);

$sxe->r1[0]->total = $id+1;           //формуємо унікальну ІД

$uploads_dir = 'uploads';  
$types = array('image/gif', 'image/png', 'image/jpeg');
$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);

function imageResize($src, $dst, $width, $height, $crop=0){
  if(!($info = @getimagesize($src)))
      {return false;}
      $w = $info[0];
      $h = $info[1];

  $type = substr($info['mime'], 6);
  $func = 'imagecreatefrom' . $type;

  if(!function_exists($func))
     { return false;}
  $img = $func($src);
  $new = imagecreatetruecolor($width, $height);
  imagecopyresampled($new, $img, 0, 0, 0, 0, $width, $height, $w, $h);
  $save = 'image' . $type;
  return $save($new, $dst);
}

if (is_uploaded_file($_FILES['userfile']['tmp_name']))
{
  if (!in_array($_FILES['userfile']['type'], $types))
   { 
    echo "<h3>Прикріплений файл не відповідає вимогам до формату! Завантаження не виконане!! </h3>";
         }
      else {
        $tmp_name = $_FILES["userfile"]["tmp_name"];
         $name2 = $uploads_dir . DIRECTORY_SEPARATOR . $id . '.' . $ext;
           move_uploaded_file($tmp_name, $name2);
           imageResize($name2, $name2, 300,300);
           echo "<h3>Прикріплений файл залишено та змінено до розміру 300*300! </h3> . </br>" ;
          }
}
else {echo "<h3>Увага! Файл не прикріплювався! </h3>";}

$sxe->asXML('feedback.xml');

echo "<h3> Відгук залишено! Вас буде повернуто на попередню сторінку </h3>";
header( 'Refresh:4; URL=index.php' );



?>