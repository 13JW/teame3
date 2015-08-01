<?php
require_once('hfactsdb.php');

// call database
try {
    $db = new PDO("mysql:host=localhost;dbname=hfactsdb","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql ='CREATE TABLE IF NOT EXISTS htopics (
        htopic_id TINYINT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        htopic VARCHAR( 50 ) NOT NULL, 
        topic_id SMALLINT(6) NOT NULL,
        description TEXT NOT NULL, 
        desc_type CHAR( 1 ), 
        htopic_s CHAR( 1 ), 
        related VARCHAR( 50 ),
        other CHAR( 1 ),
        awareact_id CHAR( 1 ))';
    $db->exec($sql);
    
    echo "Created DB Table.\n";
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

?> 