<?php


require_once('hfactsdb.php');
// var_dump($db);
// die();
// for testing that PDO statement is rendering


try {
  $results = $db->query('select * from htopics');
  // echo '<pre>';
  // var_dump($results->fetchAll(PDO::FETCH_ASSOC));
  // echo '</pre>';
  // die();
} catch(Exception $e) {
  echo $e->getMessage();
  die();
}


$h_topics = $results->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">
  <title>Team E3 Heart Facts: Food for Thought | source www.heart.org; table developed in PHP with MySql by JWilliams for E3</title>
  <link rel="stylesheet" href="style.css">

</head>

<body id="home">

  <h2>Heart Facts: Food for Thought*</h2>

  <p>*Composed from data in AHA's Heart and Stroke Encyclopedia.  
    Table designed and developed by JWilliams for E3.</p>

  <ol>
    <?php
      foreach($h_topics as $h_topic) {
      echo '<li><i class="lens"></i><a href="food.php?id='.$h_topic["htopic_id"].'">'.$h_topic["title"].'</li>';
}
    ?>
   <!-- 
      <li><i class="lens"></i>Heart Topic Two, etc</li> -->
  </ol>

</body>

</html>
