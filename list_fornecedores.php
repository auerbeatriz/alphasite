<?php
$result = $post->getFornecedoresName();

foreach ($result as $row) {
    echo "<option value=".$row['id'].">".$row['id']. " - " . utf8_encode($row["razao_social"])."</option>";
}
?>