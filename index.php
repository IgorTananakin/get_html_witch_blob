<?php
//index.php vendor composer.json composer.lock
// Автозагрузка зависимостей 
require  'vendor/autoload.php' ;


class BD extends PDO{
    
}
$connection = new BD('mysql:host=localhost;dbname=test_blob;charset=utf8', 'root', '');
$res = $connection->query("SELECT * FROM cache_dynamic_page_cache")->fetchAll(PDO::FETCH_ASSOC);

// включаем вывод заголовков HTTP 
$options = new  ZipStream\Option\Archive();
$options->setSendHttpHeaders(true);

// создать новый объект zipstream 
$zip = new  ZipStream\ZipStream ('example.zip',$options );

// создать файл с именем 'hello.txt' 
$zip->addFile('hello.html',serialize($res));

// добавить файл с именем 'some_image.jpg' из локального файла 'path/to/image.jpg' 
//$zip->addFileFromPath('some_image.jpg','path/to/image.jpg');

// добавить файл с именем 'goodbye.txt' из ресурса открытого потока 
// $fp = tmpfile();
// fwrite( $fp , 'Быстрая коричневая лиса перепрыгнула через ленивую собаку.' );
// rewind($fp);
// $zip->addFileFromStream ( 'goodbye.txt' , $fp );
fclose($fp);

// завершаем zip-поток 
$zip->finish();