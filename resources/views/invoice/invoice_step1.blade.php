<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Binfinity - Invoice Step 1</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'><link rel="stylesheet" href="invoice/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="screen-1">

  <img class="logo" src='/assetsWelcomeNew/images/logo2.png' style="width: 200px;margin: 48px;" >
   
  <div class="email">
    <label for="email">CHOOSE CRYPTO</label>
    <div class="sec-2">
      <ion-icon name="mail-outline"></ion-icon>
      <select name="crypto" id="crypto">
            <option value="BTC">BTC</option>
            <option value="ETH">ETH</option>
            <option value="TRX">TRX</option>
            <option value="USDTTRC20">USDT TRC20</option>
            <option value="USDTERC20">USDT ERC20</option>
    </select>
    </div>
  </div>
  <div class="password">
    <label for="password">VALUE IN DOLLARS</label>
    <div class="sec-2">
      <ion-icon name="lock-closed-outline"></ion-icon>
      <input type="text" name="value" placeholder="0.00005"/>
    </div>
  </div>
   
  <a href='/invoice_step2' style='color: #fff;    text-decoration: none;'><button class="login" style='width: 300px;'>NEXT </button></a>

</div>
<!-- partial -->
  
</body>
</html>
