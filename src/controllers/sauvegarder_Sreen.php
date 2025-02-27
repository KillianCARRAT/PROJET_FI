<?php
$data = json_decode(file_get_contents("php://input"), true);

$imageData = $data["image"];
$nom = $data["idC"];

$imageData = str_replace("data:image/png;base64,", "", $imageData);
$imageData = str_replace(" ", "+", $imageData);

$decodedImage = base64_decode($imageData);

$fileName = __DIR__ . "/PDF/" . $nom . ".png";
file_put_contents($fileName, $decodedImage);
?>
