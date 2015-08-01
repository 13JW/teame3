<?php

require_once('hfactsdb.php');


if (!empty($_GET['id'])) {
  $htopic_id = intval($_GET['id']);

  try {
    $results = $db->prepare('select * from hfact where htopic_id = ?');
    $results->bindParam(1, $htopic_id);
    $results->execute();
  } catch(Exception $e) {
        echo $e->getMessage();
        die();
  }

  $htopic = $results->fetch(PDO::FETCH_ASSOC);
  // var_dump($htopic);
  if($htopic == FALSE){
    echo 'Sorry, no Heart Fact was found in the table with the provided ID.';
    die();
  }// testing
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">
  <title>Team E3: Food for Thought</title>
  <link rel="stylesheet" href="style.css">

</head>

<body id="home">

  <h1>Food for Thought: Heart Facts</h1>




  <h2> 
  <?php 
  // if (isset($htopic)) {
    echo $htopic['title'];
    print_r($htopic);
  // } 
    // else {echo 'Sorry, no Heart Fact was found in the table with the provided ID.';}
  ?>  
  </h2>

</body>

</html>