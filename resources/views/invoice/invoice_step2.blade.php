<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Binfinity - Invoice Step 1</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'><link rel="stylesheet" href="invoice/style.css">
<style>
  #countdown {
  text-align: center;
}

#timer {
  display: flex;
  justify-content: center;
}

#timer div {
  margin: 0 10px;
}

#timer span {
  display: block;
  font-size: 24px;
}
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="screen-1">

  <img class="logo" src='https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Bitcoin.svg/1200px-Bitcoin.svg.png' style='height:100px;width:100px;margin:50px' >
   
  <div class="email">
    <label for="email">QR CODE</label>
    <div class="sec-2">
      <ion-icon name="mail-outline"></ion-icon>
      <img src='https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=TWXxDpeNpqXrQZ6hhc8rJAnjHZHE47ib2x'>
    </div>
  </div>
  <div class="password">
    <label for="password">ADDRESS</label>
    <div class="sec-2">
      <ion-icon name="lock-closed-outline"></ion-icon>
      TWXxDpeNpqXrQZ6hhc8rJAnjHZHE47ib2x
    </div>
  </div>
   <div class="password">
    <label for="password">VALUE CRYPTO</label>
    <div class="sec-2">
      <ion-icon name="lock-closed-outline"></ion-icon>
      0.000052
    </div>
  </div>
   <div class="password">
    <label for="password">VALUE DOLLARS</label>
    <div class="sec-2">
      <ion-icon name="lock-closed-outline"></ion-icon>
      100.00
    </div>
  </div>
  <!-- COUNTDOWN -->
  
  <div id="countdown">
    
    <div id="timer">
     
      <div>
        <span id="minutes">0</span>
        <span>Minutes</span>
      </div>
      <div>
        <span id="seconds">0</span>
        <span>Seconds</span>
      </div>
    </div>
  </div>

  <!-- FIM COUNT -->


  <button class="login">BACK </button>

</div>

  
</body>
<script>
const date1 = new Date();
console.log(date1);
const date2 = addHours(date1, 1);

const targetDate = date2.getTime();

// Update the countdown every second
const countdownInterval = setInterval(() => {
  // Get the current date and time
  const now = new Date().getTime();

  // Calculate the time difference between the current date/time and the target date/time
  const timeDifference = targetDate - now;

  // Calculate days, hours, minutes, and seconds
  const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
  const hours = Math.floor(
    (timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
  );
  const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

  // Display the calculated time in the HTML elements
  //document.getElementById("days").textContent = days;
  //document.getElementById("hours").textContent = hours;
  document.getElementById("minutes").textContent = minutes;
  document.getElementById("seconds").textContent = seconds;

  // Check if the countdown has expired
  if (timeDifference < 0) {
    clearInterval(countdownInterval);
    document.getElementById("timer").innerHTML = "Countdown expired";
  }
}, 1000);


function addHours(date, hours) {
  date.setTime(date.getTime() + hours * 60 * 60 * 1000);

  return date;
}
</script>
</html>
