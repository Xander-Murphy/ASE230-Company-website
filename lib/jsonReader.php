<?php
  function echoFieldFromTeams($jsonFile, $index, $field) {
    if(!file_exists($jsonFile)) {
      echo "File not found";
      return;
    }

    $jsonData = file_get_contents($jsonFile);
    $data = json_decode($jsonData, true);

    if(isset($data[$index][$field])) {
      echo $data[$index][$field];
    }
  }
?>