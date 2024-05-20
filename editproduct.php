<?php
require "connection.php";
$id=$_POST['id'];
$rsED=Database::search("SELECT * FROM `product` WHERE `id`='".$id."' ");
$numED=$rsED->num_rows;

if($numED=="1"){
    $dataED=$rsED->fetch_assoc();
    $price=$dataED['price'];
    $qty=$dataED['qty'];
    $des=$dataED['description'];
    $title=$dataED['title'];
    
    $DFC=$dataED['delivery_fee_colombo'];
    $DFO=$dataED['delivery_fee_other'];
    $cat=$dataED['category_cat_id'];
    $model_has=$dataED['model_has_brand_id'];
    $color=$dataED['color_clr_id'];
    $status=$dataED['status_status_id'];
    $condition=$dataED['condition_condition_id'];
    $image1=$dataED['image_1'];
    $image2=$dataED['image_2'];
   
    
    $rs2ED =Database::search("SELECT * FROM `model_has_brand` WHERE `id`='".$model_has."'");
    $num2ED=$rs2ED->num_rows;
    if ($num2ED=="1"){
        $data2ED=$rs2ED->fetch_assoc();
        $model=$data2ED['model_model_id'];
        $brand=$data2ED['brand_brand_id'];

    }



?>

<div class="row">
                        <div class="col-2 <?php if($image1){echo("d-none");}else{echo("d-flex");};?> justify-content-center align-items-center " id="productAddbtn-ed1">
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="file" id="product-pic-id-ed1" class="d-none " onchange="ProductPicAddED(1);" multiple>
                                <label for="product-pic-id1" class="btn "> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg></label>


                            </div>

                        </div>
                        <div class="col-2 <?php if($image2){echo("d-none");}else{echo("d-flex");};?> justify-content-center align-items-center " id="productAddbtn-ed2">

                            <div class="d-flex justify-content-center align-items-center">
                                <input type="file" id="product-pic-id-ed2" class="d-none" onchange="ProductPicAddED(2);" multiple>
                                <label for="product-pic-id2" class="btn "> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg></label>
                            </div>
                        </div>
                        <div class="col-2 <?php if($image1){echo("d-flex");}else{echo("d-none");};?>  justify-content-center align-items-center" id="productAddCon-ed1">
                            <div class="d-flex flex-column">
                                <button class="btn" onclick="RemovePicED(1)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg></button>
                                <img src="<?php if($image1){echo($image1);}else{echo("");};?>" class="productAdd" id="productAddId-ed1">
                            </div>
                        </div>
                        <div class="col-2 <?php if($image2){echo("d-flex");}else{echo("d-none");};?>  justify-content-center align-items-center " id="productAddCon-ed2">
                            <div class="d-flex flex-column">
                                <button class="btn" onclick="RemovePicED(2)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg></button>
                                <img src="<?php if($image2){echo($image2);}else{echo("");};?>" class="productAdd" id="productAddId-ed2">
                            </div>
                        </div>

                        <div class="col-4">
                            <input class="form-control" placeholder="Product Name" type="text" value="<?php echo($title);?>" id="product-add-name-ed">
                            <div class="d-flex justify-content-center ">
                                <div class="  d-flex flex-row py-4">
                                    <label class="form-label me-2 mt-2">Price:</label>
                                    <input class="form-control " id="product-price-add-ed" placeholder="Price" value="<?php echo( $price);?>" type="number" style="width: 30%;">
                                    <label class="form-label mx-2 mt-2">Stock:</label>


                                    <input class="form-control " id="product-stock-add-ed" placeholder="Stock" value="<?php echo( $qty);?>" type="number" min="1" step="1" style="width: 30%;">
                                </div>


                            </div>
                            <div class="d-flex justify-content-center ">
                                <div class="  d-flex flex-row py-4">
                                    <label class="form-label me-2 mt-2">D Fee</label>
                                    <input class="form-control " id="product-DFC-ed" placeholder="Colombo" value="<?php echo( $DFC);?>" type="number" style="width: 30%;">
                                    <label class="form-label mx-2 mt-2">D Fee</label>


                                    <input class="form-control " id="product-DFO-ed" placeholder="Other" value="<?php echo($DFO);?>" type="number" min="1" step="1" style="width: 30%;">
                                </div>


                            </div>


                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Description" style="height:30vh" id="product-dis-add-ed" ><?php echo( $des);?></textarea>
                                <label>Description</label>
                            </div>


                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center ">
                                <div class="  d-flex flex-row py-4">
                                    <label class="form-label me-2 mt-2"> Category</label>
                                    <select class="form-control " style="width: 15vw;" id="product-cat-add-ed">
                                        <option value="0" >Select Category</option>
                                        <?php
                                        $rs1 = Database::search('SELECT * FROM `category` ');
                                        $num_row1 = $rs1->num_rows;
                                        if ($num_row1 > 0) {
                                            for ($x = 0; $x < $num_row1; $x++) {
                                                $data1 = $rs1->fetch_assoc();
                                        ?>
                                                <option value="<?php echo ($data1['cat_id']) ?>" <?php if($data1['cat_id']==$cat){echo("selected");}?>><?php echo ($data1['cat_name']) ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                    <input class="form-control d-none" style="width:15vw;" id="add-cat-dt-ed" placeholder="Add Catergory">
                                    <button class="btn " onclick="Adding_Att_ED('cat');" id="add-cat-icon-plus-ed">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-plus " viewBox="0 0 16 16" >
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                    <button class="btn d-none" id="add-cat-icon-tick-ed"  onclick="Add_Att_DB_ED('cat')" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="primary" class="bi bi-check-square-fill " viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                        </svg>
                                    </button>
                                </div>


                            </div>
                            <div class="d-flex justify-content-center ">
                                <div class="  d-flex flex-row py-4">
                                    <label class="form-label me-2 mt-2 me-4"> Brand</label>
                                    <select class="form-control " style="width: 15vw;" id="product-brand-add-ed">
                                        
                                        <?php
                                        $rs3 = Database::search('SELECT * FROM `brand` ');
                                        $num_row3 = $rs3->num_rows;
                                        if ($num_row3 > 0) {
                                            for ($x = 0; $x < $num_row3; $x++) {
                                                $data3 = $rs3->fetch_assoc();
                                        ?>
                                                <option value="<?php echo ($data3['brand_id']) ?>" <?php if($data3['brand_id']==$brand){echo("selected");}?>><?php echo ($data3['brand_name']) ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                    <input class="form-control d-none" style="width:15vw;" id="add-brand-dt-ed" placeholder="Add Brand">
                                    <button class="btn " onclick="Adding_Att_ED('brand');" id="add-brand-icon-plus-ed">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-plus " viewBox="0 0 16 16" >
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                    <button class="btn d-none" id="add-brand-icon-tick-ed" onclick="Add_Att_DB_ED('brand')"  >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="primary" class="bi bi-check-square-fill " viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                        </svg>
                                    </button>
                                </div>


                            </div>

                            <div class="d-flex justify-content-center ">
                                <div class="  d-flex flex-row py-4">
                                    <label class="form-label me-2 mt-2 me-4"> Model</label>
                                    <select class="form-control " style="width: 15vw;" id="product-mod-add-ed">
                                     
                                        <?php
                                        $rs2 = Database::search('SELECT * FROM `model` ');
                                        $num_row2 = $rs2->num_rows;
                                        if ($num_row2 > 0) {
                                            for ($x = 0; $x < $num_row2; $x++) {
                                                $data2 = $rs2->fetch_assoc();
                                        ?>
                                                <option value="<?php echo ($data2['model_id']) ?>" <?php if($data2['model_id']==$model){echo("selected");}?>><?php echo ($data2['model_name']) ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                    <input class="form-control d-none" style="width:15vw;" id="add-mod-dt-ed" placeholder="Add Model">
                                    <button class="btn " onclick="Adding_Att_ED('mod');" id="add-mod-icon-plus-ed">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-plus " viewBox="0 0 16 16" >
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                    <button class="btn d-none" id="add-mod-icon-tick-ed" onclick="Add_Att_DB_ED('mod')" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="primary" class="bi bi-check-square-fill " viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                        </svg>
                                    </button>

                                </div>


                            </div>
                            <div class="d-flex justify-content-center ">
                                <div class="  d-flex flex-row py-4">
                                    <label class="form-label me-2 mt-2 me-2"> Condition</label>
                                    <select class="form-control " style="width: 15vw;" id="product-con-add-ed">
                                       
                                        <?php
                                        $rs4 = Database::search('SELECT * FROM `condition` ');
                                        $num_row4 = $rs4->num_rows;
                                        if ($num_row4 > 0) {
                                            for ($x = 0; $x < $num_row4; $x++) {
                                                $data4 = $rs4->fetch_assoc();
                                        ?>
                                                <option value="<?php echo ($data4['condition_id']) ?>" <?php if($data4['condition_id']==$condition){echo("selected");}?>><?php echo ($data4['condition_name']) ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                    <input class="form-control d-none" style="width:15vw;" id="add-con-dt-ed" placeholder="Add Condition">
                                    <button class="btn "  id="add-con-icon-plus-ed">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-plus " viewBox="0 0 16 16" >
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                    <button class="btn d-none" id="add-con-icon-tick-ed"  >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="primary" class="bi bi-check-square-fill " viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                        </svg>
                                    </button>
                                </div>


                            </div>
                            <div class="d-flex justify-content-center ">
                                <div class="  d-flex flex-row py-4 ">
                                    <label class="form-label  mt-2 me-4"> Color</label>
                                    <select class="form-control  " style="width: 15vw;" id="product-clr-add-ed">
                                       
                                        <?php
                                        $rs4 = Database::search('SELECT * FROM `color` ');
                                        $num_row4 = $rs4->num_rows;
                                        if ($num_row4 > 0) {
                                            for ($x = 0; $x < $num_row4; $x++) {
                                                $data4 = $rs4->fetch_assoc();
                                        ?>
                                                <option value="<?php echo ($data4['clr_id']) ?>"<?php if($data4['clr_id']==$color){echo("selected");}?>><?php echo ($data4['clr_name']) ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                    <input class="form-control d-none" style="width:15vw;" id="add-clr-dt-ed" placeholder="Add Color">
                                    <button class="btn " onclick="Adding_Att_ED('clr');" id="add-clr-icon-plus-ed">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-plus " viewBox="0 0 16 16" >
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                    <button class="btn d-none" id="add-clr-icon-tick-ed" onclick="Add_Att_DB_ED('clr')"  >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="primary" class="bi bi-check-square-fill " viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                        </svg>
                                    </button>
                                </div>


                            </div>





                        </div>




                    </div>
<?php
}
?>