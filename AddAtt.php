<?php
require "connection.php";
$data=$_POST['att_data'];
$type=$_POST['type'];
if($type=="cat"){
    $table="category";
    $col_name="cat_name";
    $col_id="cat_id";
}
if($type=="mod"){
    $table="model";
    $col_name="model_name";
    $col_id="model_id";
}if($type=="con"){
    $table="condition";
    $col_name="condition_name";
    $col_id="condition_id";
}if($type=="clr"){
    $table="color";
    $col_name="clr_name";
    $col_id="clr_id";
   
}
if($type=="brand"){
    $table="brand";
    $col_name="brand_name";
    $col_id="brand_id";
}
if(empty($data)){
    echo("Enter the New ".$table);
}else {

    Database::iud("INSERT INTO $table($col_name) VALUES ('".$data."') ");
    echo("success%%");
    $rs4 = Database::search("SELECT * FROM $table ");
    $num_row4 = $rs4->num_rows;
    if ($num_row4 > 0) {
        for ($x = 0; $x < $num_row4; $x++) {
            $data4 = $rs4->fetch_assoc();
    ?>
            <option value="<?php echo ($data4[$col_id]) ?>" <?php if($data==$data4[$col_name]){echo("selected");}?>><?php echo ($data4[$col_name]) ?></option>
    <?php

        }
    }
    echo(Database::$connection->error);
}

?>