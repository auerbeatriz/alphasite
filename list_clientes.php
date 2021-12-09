<?php
$result = $post->getClientsName();

foreach ($result as $row) {
    echo "<option value=".$row['id'].">".$row['id']. " - " . utf8_encode($row["nome"])."</option>";
}
?>