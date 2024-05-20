<?php
require "connection.php";
if(isset($_POST['province_id'])){
    $prov_id = $_POST['province_id'];
}
if(isset($_POST['district_id'])){
    $dis_id = $_POST['district_id'];

}

function proviceLoad($prov_id){
    $rs = Database::search("SELECT * FROM `district` WHERE `province_province_id`='".$prov_id."' ");
    $n = $rs->num_rows;
    for ($x = 0; $x < $n; $x++) {
        $d = $rs->fetch_assoc();



?>
        <option value="<?php echo ($d['district_id']); ?>" ><?php echo ($d['district_name']); ?></option>

<?php
    }
}
function disload( $dis_id){
    $rs1 = Database::search("SELECT * FROM `city` WHERE `district_district_id`='".$dis_id."' ");
    $n1 = $rs1->num_rows;
for ($x = 0; $x < $n1; $x++) {
    $d1 = $rs1->fetch_assoc();



?>
    <option value="<?php echo ($d1['city_id']); ?>" ><?php echo ($d1['city_name']); ?></option>

<?php
}

}



if (isset($prov_id)) {
    
    proviceLoad( $prov_id);
}


if (isset($dis_id)) {
    disload( $dis_id);
}

?>