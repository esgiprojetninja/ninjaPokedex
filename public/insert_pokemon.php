<?php
$filename = "../data/pokemon/pokemon_g1.csv";
$dbh = new PDO('mysql:host=localhost;dbname=zf3', 'homestead', 'secret', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));

if (($handle = fopen($filename, "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $name = $data[8];
    $type1 = $data[4];
    $description = $data[3];
    $id_national = $data[0];
    $image = "http://romainlambot.fr/pokemons/images/".$id_national.".png";
    $id_pokemon = $id_national;

    if(strlen($data[6]) > 0 ){
      $id_parent = $data[6];
    }else{
      $id_parent = NULL;
    }
    var_dump($data);
    $countType = 1;
    if(strlen($data[5]) > 0 ){
      $type2 = $data[5];
      $stmt = $dbh->prepare("INSERT INTO pokemon_has_type (id_pokemon, id_type, type_number) VALUES (:id_pokemon, :id_type, :type_number)");
      $stmt->bindParam(':id_pokemon', $id_pokemon);
      $stmt->bindParam(':id_type', $type1);
      $stmt->bindParam(':type_number', $countType);
      $stmt->execute();

      $countType++;
      $stmt = $dbh->prepare("INSERT INTO pokemon_has_type (id_pokemon, id_type, type_number) VALUES (:id_pokemon, :id_type, :type_number)");
      $stmt->bindParam(':id_pokemon', $id_pokemon);
      $stmt->bindParam(':id_type', $type2);
      $stmt->bindParam(':type_number', $countType);
      $stmt->execute();
    }else{
      $stmt = $dbh->prepare("INSERT INTO pokemon_has_type (id_pokemon, id_type, type_number) VALUES (:id_pokemon, :id_type, :type_number)");
      $stmt->bindParam(':id_pokemon', $id_pokemon);
      $stmt->bindParam(':id_type', $type1);
      $stmt->bindParam(':type_number', $countType);
      $stmt->execute();
    }
    $stmt = $dbh->prepare("INSERT INTO pokemon (name, id_national, description, id_parent, image, id_pokemon) VALUES (:name, :id_national, :description, :id_parent, :image, :id_pokemon)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id_national', $id_national);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id_parent', $id_parent);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id_pokemon', $id_pokemon);
    $stmt->execute();
    print_r($dbh->errorInfo());
  }
  fclose($handle);
}
?>
