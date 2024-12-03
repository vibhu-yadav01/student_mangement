<!doctype html>
<html lang="en">
<head>
  <title>Login page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/bootstrap/mycss.css">
</head>
<body>
  
 

 <div class="form">
 <div class="section">
  <div class="container">
   <div class="row full-height justify-content-center">
    <div class="col-12 text-center align-self-center py-5">
     <div class="section pb-5 pt-5 pt-sm-2 text-center">

     <div style="width:100%; display:flex; justify-content:center; align-items:center;">
    <label id="Alert" style="color: red; font-weight: bold; text-decoration:underline; font-size: 28px;"></label>
</div>

      <h6 class="mb-0 pb-3"><span>Student</span><span>Professor</span></h6>
              <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
              <label for="reg-log"></label>
      <div class="card-3d-wrap mx-auto">
       <div class="card-3d-wrapper">
        <div class="card-front">
         <div class="center-wrap">
          <div class="section text-center">
            
           <h4 class="mb-4 pb-3">Log In</h4>
           <div class="form-group">
            <input type="number" id="txtroll" placeholder="RollNo" class="form-style">
            <i class="input-icon uil uil-user"></i>
           </div> 
           <div class="form-group mt-2">
            <input type="password" id="txtpassword" placeholder="Password"  class="form-style">
            <i class="input-icon uil uil-lock-alt"></i>
           </div>
           
           <div class="form-group mt-2"></div>
          
           <button class="submitBtn" id="btnlogin">log in</button>
           <!--WORK NOT COMPLETED IN THIS PART-->
           <a href=".." class="link">Don't have an account?Register one</a>
               </div>
              </div>
             </div>
        <div class="card-back">
         <div class="center-wrap">
          <div class="section text-center">
           <h4 class="mb-3 pb-3">Log In</h4>
           <div class="form-group">
            <input type="email" id="txtemail" placeholder="Email" autocomplete="off" class="form-style" required>
            <i class="input-icon uil uil-at"></i>
           </div> 
           <div class="form-group mt-2">
            <input type="password" id="txtpass" placeholder="Password" autocomplete="off" class="form-style" required>
            <i class="input-icon uil uil-lock-alt"></i>
           </div>
           <div class="form-group mt-2"></div>
           <button class="submitBtn" id="btnloginp">Log in</button>
           <!--WORK NOT COMPLETED IN THIS PART-->
           <a href=".." class="link">Don't have an account?Register one</a>
               </div>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
     </div>
 </div>
 </div>
<script src= "../Jquery/jquery.js"></script>
<script src= "../UserInterface/slogin.js"></script>
<script src= "../UserInterface/plogin.js"></script>
</html>