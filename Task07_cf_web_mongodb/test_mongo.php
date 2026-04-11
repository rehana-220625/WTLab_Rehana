<?php
require __DIR__ . '/vendor/autoload.php';

try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    echo "✅ MongoDB connected successfully!<br>";
    
    // Show databases
    $databases = $client->listDatabases();
    echo "<h3>Available Databases:</h3>";
    echo "<ul>";
    foreach ($databases as $database) {
        echo "<li>" . $database['name'] . "</li>";
    }
    echo "</ul>";
    
    // Show collections in i_mongoDB
    $db = $client->i_mongoDB;
    $collections = $db->listCollections();
    echo "<h3>Collections in i_mongoDB:</h3>";
    echo "<ul>";
    foreach ($collections as $collection) {
        echo "<li>" . $collection['name'] . "</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
