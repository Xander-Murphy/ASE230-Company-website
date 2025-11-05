<?php

$teamFile = '../../data/team.json';

//Delete Functions
function getAllMembers() {
  global $teamFile;
  return json_decode(file_get_contents($teamFile), true) ?? [];
}

function getMemberByName($name) {
  $members = getAllMembers();
  foreach ($members as $m) {
    if ($m['name'] === $name) return $m;
  }
  return null;
}

function deleteMember($name) {
  global $teamFile;
  $members = getAllMembers();
  $members = array_values(array_filter($members, fn($p) => $p['name'] !== $name));
  file_put_contents($teamFile, json_encode($members, JSON_PRETTY_PRINT));
}
//Create Functions
function addMember($data) {
  global $teamFile;
  $teamMembers = json_decode(file_get_contents($teamFile), true) ?? [];

  $teamMembers[] = $data;

  file_put_contents($teamFile, json_encode($teamMembers, JSON_PRETTY_PRINT));
}

//Edit Functions
function updateMember($oldName, $newData) {
    global $teamFile;
    $members = getAllMembers();

    foreach ($members as &$m) {
        if ($m['name'] === $oldName) {
            $m = $newData;
            break;
        }
    }
    file_put_contents($teamFile, json_encode($members, JSON_PRETTY_PRINT));
}
?>