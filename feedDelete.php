<?php

$rss =  simplexml_load_file('feedback.xml');
$id =  $rss->r1->total;
$id_delete=0;
for ($i=0; $i<=$id;$i++)
{
    if (!empty($_POST[$i]))
    {
    $id_delete = $i;
    }
}

$xml = new DOMDocument();
$xml->load('feedback.xml');

$xpathXml = new DOMXPath($xml);
$elements = $xpathXml->query("//feed[id=$id_delete]");

foreach ($elements as $element) 
  {  
      $element->parentNode->removeChild($element);
    }

  $test1 = $xml->save('feedback.xml');
  
echo "<h3> Відгук видалено! Вас буде повернуто на попередню сторінку </h3>";
header( 'Refresh:4; URL=index.php' );