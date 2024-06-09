function rotateContent() {
    const container = document.querySelector('.container');
    container.classList.toggle('rotated');
}
function SignUp() {
   var fname = document.getElementById('fn');
   var lname = document.getElementById('ln');
   var email = document.getElementById('email');
   var password = document.getElementById('pw');
   var pnum = document.getElementById('pno');
   var gender = document.getElementById('gender');


    var form =new FormData();
    form.append("fname",fname.value);
    form.append("lname",lname.value);
    form.append("email",email.value);
    form.append("password",password.value);
    form.append("pnum",pnum.value);
    form.append("gender",gender.value);
    
    const cartData=[];
     
    var xhr = new XMLHttpRequest();
    xhr.onload= function(){
        var t =xhr.responseText;
        
              
        if (t=="success"){

            
     

          
            document.getElementById("reponse-text").classList.add("alert");
            document.getElementById("reponse-text").classList.add("alert-success");
            document.getElementById("rep-t").classList.add("res-height");
            
            document.getElementById("rep-t").innerHTML=""+t+"";
            document.getElementById("sign-email").setAttribute("value",email.value);
            const container = document.querySelector('.container');          
            container.classList.toggle('rotated');
          
            

            
           
        }else{
            var m = document.getElementById("exampleModal");
            bm = new bootstrap.Modal(m);
            bm.show();
            setTimeout(function () {
                bm.hide();
              });
            document.getElementById("rep-t").innerHTML="";
            document.getElementById("reponse-text").classList.remove("alert");
            document.getElementById("reponse-text").classList.remove("alert-success");
            document.getElementById("rep-t").classList.remove("res-height");
          
          
            document.getElementById("response").classList.add("alert");
            document.getElementById("response").classList.add("alert-danger");
            document.getElementById("response").innerHTML=""+t+"";
            
            
  
            
        }
    }
    xhr.open("POST","signup.php","ture");
    xhr.send(form);


}

function SignIn(){
    var uname = document.getElementById("sign-email");
    var pass = document.getElementById("sign-pass");
   var remember= document.getElementById("rememberMe");
    var formS = new FormData();
    formS.append("uname",uname.value);
    formS.append("pass",pass.value);
    formS.append("rememberMe",remember.checked);
    console.log(remember.checked);
    var xhrS = new XMLHttpRequest();
    xhrS.onload=function(){
       
        if(xhrS.responseText=="success"){
             window.location="index.php";
       

        }
        else{
            var m = document.getElementById("exampleModal");
            bm = new bootstrap.Modal(m);
            bm.show();
            document.getElementById("response").classList.add("alert");
            document.getElementById("response").classList.add("alert-danger");
            document.getElementById("response").innerHTML=""+xhrS.responseText+"";
        }

    }
    xhrS.open("POST","signin.php","ture");
    xhrS.send(formS);

}
function forgetPass(){
    var uname = document.getElementById("sign-email");
    if(uname.value){
        var fmodal=new bootstrap.Modal(document.getElementById("forgetPassword"));
fmodal.show();
    }   else{
        var m = document.getElementById("exampleModal");
            bm = new bootstrap.Modal(m);
            bm.show();
            document.getElementById("response").classList.add("alert");
            document.getElementById("response").classList.add("alert-danger");
            document.getElementById("response").innerHTML="Enter the Email";

    }

}


function ResetPass() {
    var uname = document.getElementById("sign-email");
    var Npass = document.getElementById("newPassword");
    var Rpass = document.getElementById("RnewPassword");
    var Vcode = document.getElementById("VCodeConI");
    var fom = new FormData();
    fom.append("email", uname.value);
    fom.append("Npass", Npass.value);
    fom.append("Rpass", Rpass.value);
    fom.append("verificationCode", Vcode.value);

    if (document.getElementById("loadingSvg")) {
        document.getElementById("loadingSvg").classList.remove("d-none");
    }

    var xhrR = new XMLHttpRequest();

    xhrR.onload = function () {
        if (document.getElementById("loadingSvg")) {
            document.getElementById("loadingSvg").classList.add("d-none");
        }

        if (xhrR.responseText === "Verification code has been sent") {
            document.getElementById("errResetPas").classList.add("alert");
            document.getElementById("errResetPas").classList.remove("alert-danger");
            document.getElementById("errResetPas").classList.add("alert-success");
            document.getElementById("errResetPas").innerHTML = "" + xhrR.responseText + "";
            document.getElementById("NewPassCon").classList.add("d-none");
            document.getElementById("RNewPassCon").classList.add("d-none");
            document.getElementById("VCodeCon").classList.remove("d-none");
        } else if (xhrR.responseText === "Password is Changed") {
            document.getElementById("errResetPas").classList.add("alert");
            document.getElementById("errResetPas").classList.remove("alert-danger");
            document.getElementById("errResetPas").classList.add("alert-success");
            document.getElementById("errResetPas").innerHTML = "" + xhrR.responseText + "";
            setTimeout(function(){
                window.location="index.php";
       
            },700);
        } else {
            document.getElementById("errResetPas").classList.add("alert");
            document.getElementById("errResetPas").classList.add("alert-danger");
            document.getElementById("errResetPas").innerHTML = "" + xhrR.responseText + "";
        }
    };

    xhrR.open("POST", "forgetPassword.php", "true");
    xhrR.send(fom);
}


function ShowHidePs(ps){
    var passwordtext = document.getElementById(""+ps+"");
    if (passwordtext.type=="text"){
        passwordtext.type="password";
    }
    else{
        passwordtext.type="text";
    }
}
 function UpdateProf(){
var fname = document.getElementById("prof-fname");
var lname = document.getElementById("prof-lname");
var mobile = document.getElementById("prof-mobile");
var address1 = document.getElementById("prof-address1");
var address2 = document.getElementById("prof-address2");
var province = document.getElementById("prof-address2");
var city = document.getElementById("prof-provice");
var district = document.getElementById("prof-District");
var gender = document.getElementById("prof-gender");
 var form = new FormData();
 form.append("fname",fname.value);
 form.append("lname",lname.value);
 form.append("mobile",mobile.value);
 form.append("address1",address1.value);
 form.append("address2",address2.value);
 form.append("province",province.value); 
 form.append("city",city.value); 
 form.append("district",district.value); 
 form.append("gender",gender.value); 
var xhr = new XMLHttpRequest();
xhr.onload=function(){

}
xhr.open("POST", "UpdateProf.php", "true");
xhr.send(form);

 }
 function ProviceClick(event){

    var form = new FormData();
    form.append("province_id",event.target.value);
    var xhr = new XMLHttpRequest();
xhr.onload=function(){
    
document.getElementById('prof-District').innerHTML=""+xhr.response+"";
}
xhr.open("POST", "LoadDisCity.php", "true");
xhr.send(form);


 }
 function DistrictClick(event){

    var form = new FormData();
   
    form.append("district_id",event.target.value);
   
    var xhr = new XMLHttpRequest();
    xhr.onload=function(){
    
document.getElementById('prof-city').innerHTML=""+xhr.response+"";
}
xhr.open("POST", "LoadDisCity.php", "true");
xhr.send(form);


 }
 function ProfPicUpdate(){
    
    var profPic= document.getElementById("profile-pic-id");
    var form = new FormData();
    form.append("picFile",profPic.files[0]);
    var xhr = new XMLHttpRequest();
    xhr.onload= function (){
        
 
 location.reload();
    }
    xhr.open("POST","profPicUp.php","true");
    xhr.send(form);

 }
 
function catProductLoad(cat,pg,bd,keyword){
       
              var form = new FormData();
              form.append("cat_id",cat);
              form.append("pg",pg);
              form.append("bd",bd);
             
              if(keyword){
                form.append("keyword",keyword);
              }
             
              var xhr = new XMLHttpRequest();
              xhr.onload=function(){
               document.getElementById("cat_container").innerHTML+=""+xhr.response+""
              }
              xhr.open("POST","categoryLoad.php","ture");
              xhr.send(form);
        
         
  
  }
  function searchClick(){
    var keyword = document.getElementById("search-bar").value;
    alert(keyword);
    window.location='/store.php?cat=0&&pg=0&&bd=0&&key='+keyword;
  }





       

  var imageURLs=[];
  function ProductPicAdd(num){
  
    var productImg=document.getElementById("product-pic-id"+num);
    
    
    function ManyImg(images){
       
        for(i=0;i<file_count;i++){
            var file= images[i];
            imageURLs.push(file);
            
            var url = window.URL.createObjectURL(file);
            file.id=url;
            var productAddBtn = document.getElementById("productAddbtn" + (i+1));
            productAddBtn.classList.toggle("d-none");                
            var productAddId = document.getElementById("productAddId" + (i+1));
            productAddId.src = url;
            
            var productAddCon = document.getElementById("productAddCon" + (i+1));              
            productAddCon.classList.toggle("d-none");
                

         }
    }
    function SingleImg(images,index){
        var file= images[0];
        imageURLs.push(file);
       
        var url = window.URL.createObjectURL(file);
        file.id=url;
        var productAddBtn = document.getElementById("productAddbtn"+index);
        productAddBtn.classList.toggle("d-none");         
        var productAddId = document.getElementById("productAddId"+index);
        productAddId.src = url;
       
        var productAddCon = document.getElementById("productAddCon"+index);              
        productAddCon.classList.toggle("d-none");
    }
  

   console.log(productImg.files.length);
        if(productImg.files.length>0){
      
            images=productImg.files;
            file_count=images.length;
            
           
            if(file_count==2){
              ManyImg(images);
              console.log(imageURLs);
            }
            else if(file_count==1)
            { 
              
                SingleImg(images,num);
                
                
            }
            else if(file_count>2) {
                alert("Please select a maxium of 2 images ")
            }
           
        }
        
      
    
   
  }
  function RemovePic(index){
   
      
        var productAddBtn = document.getElementById("productAddbtn"+index);
        productAddBtn.classList.toggle("d-none")
                 
        var productAddId = document.getElementById("productAddId"+index);
       
        var FileID=productAddId.src;
        
        var URLindex = imageURLs.findIndex(file => file.name === FileID);
        imageURLs.splice(URLindex,1);
       
        var productAddCon = document.getElementById("productAddCon"+index);              
        productAddCon.classList.toggle("d-none");
        productAddId.src = window.location.href;
  }


  var imageURLsED=[];
  function ProductPicAddED(num){
    

    var productImg=document.getElementById("product-pic-id-ed"+num);
    
    
    function ManyImg(images){
       
        for(i=0;i<file_count;i++){
            var file= images[i];
            imageURLsED.push(file);
            
            var url = window.URL.createObjectURL(file);
            file.id=url;
            var productAddBtn = document.getElementById("productAddbtn-ed" + (i+1));
            productAddBtn.classList.toggle("d-none");                
            var productAddId = document.getElementById("productAddId-ed" + (i+1));
            productAddId.src = url;
            
            var productAddCon = document.getElementById("productAddCon-ed" + (i+1));              
            productAddCon.classList.toggle("d-none");
                

         }
    }
    function SingleImg(images,index){
       
        var file= images[0];
        imageURLsED.push(file);
       
        var url = window.URL.createObjectURL(file);
        file.id=url;
        var productAddBtn = document.getElementById("productAddbtn-ed"+index);
        console.log(productAddBtn);
        productAddBtn.classList.toggle("d-none");         
        productAddBtn.classList.toggle("d-flex");         
        var productAddId = document.getElementById("productAddId-ed"+index);
        productAddId.src = url;
       
        var productAddCon = document.getElementById("productAddCon-ed"+index);              
        productAddCon.classList.toggle("d-none");
        productAddCon.classList.toggle("d-flex");
    }
  


        if(productImg.files.length>0){
      
            images=productImg.files;
            file_count=images.length;
            
           
            if(file_count==2){
              ManyImg(images);
              console.log(imageURLsED);
            }
            else if(file_count==1)
            { 
              
                SingleImg(images,num);
                
                
            }
            else if(file_count>2) {
                alert("Please select a maxium of 2 images ")
            }
           
        }
        
      
    
   
  }
  function RemovePicED(index){
   
      
        var productAddBtn = document.getElementById("productAddbtn-ed"+index);
        productAddBtn.classList.toggle("d-none")
        productAddBtn.classList.toggle("d-flex")
                 
        var productAddId = document.getElementById("productAddId-ed"+index);
       
        var FileID=productAddId.src;
        
        var URLindex = imageURLsED.findIndex(file => file.name === FileID);
        imageURLsED.splice(URLindex,1);
       
        var productAddCon = document.getElementById("productAddCon-ed"+index);              
        productAddCon.classList.toggle("d-none");
        productAddCon.classList.toggle("d-flex");
        productAddId.src = window.location.href;
  }
  function AddProductSubmit(){
 var productName=document.getElementById("product-add-name");
 var price =document.getElementById("product-price-add");
 var stock=document.getElementById("product-stock-add");
 var DFO =document.getElementById("product-DFO");
 var DFC=document.getElementById("product-DFC");
 var description=document.getElementById("product-dis-add");
 var Category=document.getElementById("product-cat-add");
 var Condition=document.getElementById("product-con-add");
 var Model=document.getElementById("product-mod-add");
 var Brand=document.getElementById("product-brand-add");
 var Color=document.getElementById("product-clr-add");
 
 var form = new FormData();
 form.append("pname",productName.value);
 form.append("price",price.value);
 form.append("stock",stock.value);
 form.append("DFO",DFO.value);
 form.append("DFC",DFC.value);
 form.append("description",description.value);
 form.append("category",Category.value);
 form.append("condition",Condition.value);
 form.append("model",Model.value);
 form.append("brand",Brand.value);
 form.append("color",Color.value);
 imageURLs.forEach(
    function(file){
        form.append("images[]",file)
    }
 )
var xhr = new XMLHttpRequest();
xhr.onload = function(){
   
  if(xhr.responseText=="success"){
    window.location.reload();

  }
  else{
    var m = document.getElementById("product_add_error");
    bm = new bootstrap.Modal(m);
    bm.show();
    document.getElementById("response").classList.add("alert");
    document.getElementById("response").classList.add("alert-danger");
    document.getElementById("response").innerHTML=""+xhr.responseText+"";
  }
}
xhr.open("POST","AddProduct.php","true");
xhr.send(form);

  }
  function EditProductSubmit(){
    var product_id=document.getElementById("edit-product-id");
    var productName=document.getElementById("product-add-name-ed");
    var price =document.getElementById("product-price-add-ed");
    var stock=document.getElementById("product-stock-add-ed");
    var DFO =document.getElementById("product-DFO-ed");
    var DFC=document.getElementById("product-DFC-ed");
    var description=document.getElementById("product-dis-add-ed");
    var Category=document.getElementById("product-cat-add-ed");
    var Condition=document.getElementById("product-con-add-ed");
    var Model=document.getElementById("product-mod-add-ed");
    var Brand=document.getElementById("product-brand-add-ed");
    var Color=document.getElementById("product-clr-add-ed");
    var form = new FormData();
    form.append("pname",productName.value);
    form.append("price",price.value);
    form.append("stock",stock.value);
    form.append("DFO",DFO.value);
    form.append("DFC",DFC.value);
    form.append("description",description.value);
    form.append("category",Category.value);
    form.append("condition",Condition.value);
    form.append("model",Model.value);
    form.append("brand",Brand.value);
    form.append("color",Color.value);
    form.append("product_id",product_id.innerHTML);
    imageURLs.forEach(
       function(file){
           form.append("images[]",file)
       }
    )
   var xhr = new XMLHttpRequest();
   xhr.onload = function(){
      
     if(xhr.responseText=="success"){
       window.location.reload();
   
     }
     else{
       var m = document.getElementById("product_add_error");
       bm = new bootstrap.Modal(m);
       bm.show();
       document.getElementById("response").classList.add("alert");
       document.getElementById("response").classList.add("alert-danger");
       document.getElementById("response").innerHTML=""+xhr.responseText+"";
     }
   }
   xhr.open("POST","EditProductProcess.php","true");
   xhr.send(form);
   
     }
  function Adding_Att(type){
    
   document.getElementById("product-"+type+"-add").classList.toggle("d-none");
   document.getElementById("add-"+type+"-dt").classList.toggle("d-none");
   document.getElementById("add-"+type+"-icon-plus").classList.toggle("d-none");
   document.getElementById("add-"+type+"-icon-tick").classList.toggle("d-none");

  }

  function Add_Att_DB(type){
 
   var Att_data =document.getElementById("add-"+type+"-dt");
   var form = new FormData();
   form.append("att_data",Att_data.value);
   form.append("type",type);
   var xhr = new XMLHttpRequest();
   xhr.onload = function(){
    
    var res = xhr.responseText.split("%%");
  

   if(res){
  
    if(res[0]=="success"){
       
        document.getElementById("product-"+type+"-add").innerHTML=res[1];
        document.getElementById("product-"+type+"-add").classList.toggle("d-none");
       document.getElementById("add-"+type+"-dt").classList.toggle("d-none");
      document.getElementById("add-"+type+"-icon-plus").classList.toggle("d-none");
     document.getElementById("add-"+type+"-icon-tick").classList.toggle("d-none");
    
    }

   }
   else{
    var m = document.getElementById("product_add_error");
    bm = new bootstrap.Modal(m);
    bm.show();
    document.getElementById("response").classList.add("alert");
    document.getElementById("response").classList.add("alert-danger");
    document.getElementById("response").innerHTML=""+xhr.responseText+"";
   }
}
xhr.open("POST","AddAtt.php","true");
xhr.send(form);

  }
function EditProduct(id){
    xhr = new XMLHttpRequest();
    form = new FormData();
    form.append('id',id);
    xhr.onload=function(){
        document.getElementById('edit-product-model').innerHTML=""+xhr.response+"";
        var m = document.getElementById("Edit-Product-menu");
        bm = new bootstrap.Modal(m);
    bm.show();
    }
    xhr.open("POST","editproduct.php");
    xhr.send(form);
}
function Adding_Att_ED(type){
    
    
    document.getElementById("product-"+type+"-add-ed").classList.toggle("d-none");
    document.getElementById("add-"+type+"-dt-ed").classList.toggle("d-none");
    document.getElementById("add-"+type+"-icon-plus-ed").classList.toggle("d-none");
    document.getElementById("add-"+type+"-icon-tick-ed").classList.toggle("d-none");
 
   }
function Add_Att_DB_ED(type){
 
    var Att_data =document.getElementById("add-"+type+"-dt-ed");
    var form = new FormData();
    form.append("att_data",Att_data.value);
    form.append("type",type);
    var xhr = new XMLHttpRequest();
    xhr.onload = function(){
     
     var res = xhr.responseText.split("%%");
   
 
    if(res){
   
     if(res[0]=="success"){
        
         document.getElementById("product-"+type+"-add-ed").innerHTML=res[1];
         document.getElementById("product-"+type+"-add-ed").classList.toggle("d-none");
        document.getElementById("add-"+type+"-dt-ed").classList.toggle("d-none");
       document.getElementById("add-"+type+"-icon-plus-ed").classList.toggle("d-none");
      document.getElementById("add-"+type+"-icon-tick-ed").classList.toggle("d-none");
     
     }
 
    }
    else{
     var m = document.getElementById("product_add_error");
     bm = new bootstrap.Modal(m);
     bm.show();
     document.getElementById("response").classList.add("alert");
     document.getElementById("response").classList.add("alert-danger");
     document.getElementById("response").innerHTML=""+xhr.responseText+"";
    }
 }
 xhr.open("POST","AddAtt.php","true");
 xhr.send(form);
 
   }
   function deleteProduct(id){
    xhr = new XMLHttpRequest();
    form = new FormData();
    form.append('id',id);
  
    xhr.onload=function(){
       
        document.getElementById("product-list-"+id+"").classList.add("d-none");
       
    }
    xhr.open("POST","deleteproduct.php");
    xhr.send(form);

   }
   function AddCart(id){
  
    form = new FormData();
    if(document.getElementById("amount-product")){
      var amount = document.getElementById("amount-product").value;
      form.append('amount',amount);
    }
   
    form.append('id',id);
   
    form.append('que',"insert");
    xhr = new XMLHttpRequest();
    xhr.onload= function (){
    
      
       
cartCount();
    }
    xhr.open("POST","addcart.php");
    xhr.send(form);
     
   }
   function DeleteCart(id){
    form = new FormData();

    form.append('id',id);
    form.append('que',"delete");
    xhr = new XMLHttpRequest();
    xhr.onload= function (){
       
 document.getElementById("cart-con-"+id).remove();
 cartCount();
 finalsubcal();
    }
    xhr.open("POST","addcart.php");
    xhr.send(form);
     
   }
   function WishBTNreset(id,email){
    
    form = new FormData();
    
    form.append('id',id);
    form.append('email',email);
    
    
    xhr = new XMLHttpRequest();
    xhr.onload= function (){
    
     
      document.getElementById("wish-btn-con-"+id).innerHTML=xhr.response;
       

    }
    xhr.open("POST","wish-list-btn-set.php");
    xhr.send(form);
   }
   function AddWishList(id,email){
   
    form = new FormData();
    
    form.append('id',id);
    
    form.append('que',"insert");
    xhr = new XMLHttpRequest();
    xhr.onload= function (){
   
      
    WishBTNreset(id,email);

    }
    xhr.open("POST","addwishlist.php");
    xhr.send(form);
     
   }
   
   function toggleWishlist(id,isin,email){

    
    if(!email){
      alert("Please Sign in")
    
   
    }
    else{
      if (isin=="2"){
      
        AddWishList(id,email);
      
        
       
       
       
        
      }
      else{
        DeleteWishList(id,email);
       
        
      }
    }
  
    
 
   }

   function DeleteWishList(id,email){
    
    form = new FormData();

    form.append('id',id);
    form.append('que',"delete");
    xhr = new XMLHttpRequest();
    xhr.onload= function (){
      WishBTNreset(id,email);
     if(document.getElementById("wish-con-"+id)){
      document.getElementById("wish-con-"+id).remove();
     }

 
    }
    xhr.open("POST","addwishlist.php");
    xhr.send(form);
     
   }
   function cartItemsOnload(data){
   alert(data);

   }
   function updateSubTotal(price,id){
    form = new FormData();
    var amount = document.getElementById("cart-amount-"+id).value;
    var subDOM = document.getElementById("cart-sub-"+id);
    form.append('id',id);
    form.append('amount',amount);
   
    var sub=amount*price;
    subDOM.innerHTML=""+sub+"";
    finalsubcal();
    
    xhr = new XMLHttpRequest();
    xhr.onload= function (){
      console.log(xhr.responseText);

 
    }
    xhr.open("POST","updateCartAmout.php");
    xhr.send(form);

   }
   function finalsubcal() {
    var finalsub = 0;
    var finaltotal=0;
    var subtotals = document.querySelectorAll(".subtotals");
    
    if (subtotals.length === 0) {
      document.getElementById("cart-empty-msg").classList.remove("d-none");
      
      document.getElementById("final-sub").innerHTML = "LKR 0";
      document.getElementById("final-total").innerHTML="LKR 0";
    } else {
      document.getElementById("cart-empty-msg").classList.add("d-none");
      
      subtotals.forEach(function (item) {
        console.log(finalsub);
        console.log(item.innerHTML);
        finalsub += parseInt(item.innerHTML);
      });
      document.getElementById("final-sub").innerHTML = "LKR " + finalsub;
      if(document.getElementById("delfee").checked){
        var finaltotal=finalsub+500;
        document.getElementById("final-total").innerHTML="LKR"+finaltotal+"";
      }
      else{
       var finaltotal=finalsub;
       document.getElementById("final-total").innerHTML="LKR"+finaltotal+"";
      }
    }
   
  }
   function cartCount(){

    xhr= new XMLHttpRequest();
    xhr.onload=function()
    {
        
document.getElementById("cart-count").innerHTML=xhr.response;
    }
    xhr.open("POST","cart-count.php");
    xhr.send();
 }
 function loadingCards() {
   var numberOfProducts=4;
    
    for (var i = 0; i < numberOfProducts; i++) {
        
        HomePageAnimation(i);
    }
};

function HomePageAnimation(id) {
    gsap.registerPlugin(ScrollTrigger);
  
    gsap.set(".card" + id, { y: 400 });
    gsap.to(".card" + id, {
        scrollTrigger: {
            trigger: "#cardcons",
            start: "-270px center",
            end: "bottom center", 
            
            toggleActions: "restart none none",
           
        },
        y: 0,
        duration: 1,
        delay: id * 0.2,
        onComplete: function() {
           
            enableTiltEffect();
        }
    });
}

function enableTiltEffect() {
    
        
        VanillaTilt.init(document.querySelectorAll(".cardT"),{
            glare:true,
            reverse:true,
            "max-glare":0.5
        })
        
    
    
}

function logout(){

  xhr = new XMLHttpRequest();
  form = new FormData();
  form.append('que',"logout");
  xhr.onload=function(){
  
    window.location.href="index.php";
  }
  xhr.open("POST","logout.php");
  xhr.send(form);
}
const stripe = Stripe("pk_test_51O0gVtHoypIZDK3xZzHGbNPpXJz1Cjo9pwC3dz53lEUHLfr6NW3u0DMq05onZozImteQ71JxhdkhuSzgWH5dQYRw004Wg2k6uk");

async function checkout() {
  
  const fetchClientSecret = async () => {
    const response = await fetch('./create-checkout-session.php', {
      method: 'POST',
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(session) {
      return stripe.redirectToCheckout({ sessionId: session.sessionId });
    })
    .then(function(result) {
      if (result.error) {
        alert(result.error.message);
      }
    })
    .catch(function(error) {
      console.error('Error:', error);
    });
   
    
  };

  fetchClientSecret();

 
}
function loadingCards2() {
  var numberOfProducts=4;
   
   for (var i = 4; i < numberOfProducts; i--) {
       
       HomePageAnimation(i);
   }
};
function HomePageAnimation2(id) {
  gsap.registerPlugin(ScrollTrigger);

  gsap.set(".card" + id, { y: 400 });
  gsap.to(".card" + id, {
      scrollTrigger: {
          trigger: "#cardcons2",
          start: "170px center",
          end: "bottom center", 
          markers: true,
          
          toggleActions: "restart none none",
         
      },
      y: 0,
      duration: 1,
      delay: id * 0.2,
      onComplete: function() {
         
          enableTiltEffect();
      }
  });
}
  // slider

const swiper = new Swiper('.swiper', {
  
    direction: 'horizontal',
    loop: true,
    effect: "fade",
  
  
   
    pagination: {
      el: '.swiper-pagination',
    },
  
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
    
    scrollbar: {
      el: '.swiper-scrollbar',
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  
  });
  
  
  swiper.on('slideChange', () => {
    const activeIndex = swiper.activeIndex;
  
    anime({
      targets: ".text-1",
      translateX: [100, 0],
      duration: 1000,
    });
  
    anime({
      targets: ".bottle1",
      translateY: [100, 0],
      duration: 1000,
    });
  
    anime({
      targets: ".text-2",
      translateY: [100, 0],
      duration: 1000,
    });
  
    anime({
      targets: ".box",
      translateX: [100, 0],
      duration: 1000,
    });
  
    anime({
      targets: ".text-3",
      translateY: [100, 0],
      duration: 1000,
    });
  
    anime({
      targets: ".cream1",
      translateY: [100, 0],
      duration: 1000,
    });
  
    anime.set(".cream2", { rotate: 0 });
  
    
    anime({
      targets: ".cream2",
      rotate: '1turn',
      duration: 1000,
      delay: 200, 
    });
  });
  
  anime({
    targets: ".banner-text",
    translateX: [100, 0],
    duration: 1000,
  });
  
  anime({
    targets: ".bottle",
    translateY: [100, 0],
    duration: 1000,
  });
  

    $('body').stellar({
      
       
    });
