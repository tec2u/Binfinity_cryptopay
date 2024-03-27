<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Binfinity - Invoice Step 1</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcomeNew/images/icon.png">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel='stylesheet'
    href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
  {{-- <link rel="stylesheet" href="/invoice/style.css"> --}}
  <link rel="stylesheet" href="/invoice/style2.css?v=2">
  <link rel="icon" type="image/png" sizes="400x400" href="{{ asset('assetsWelcomeNew/images/icon.png') }}">
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
  @php
    $img = '';

    if ($order[0]['coin'] == 'BITCOIN') {
        $img = 'https://cryptologos.cc/logos/bitcoin-btc-logo.png?v=029';
    }
    if ($order[0]['coin'] == 'TRX') {
        $img = 'https://cryptologos.cc/logos/tron-trx-logo.png?v=029';
    }
    if ($order[0]['coin'] == 'ETH') {
        $img = 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029';
    }
    if ($order[0]['coin'] == 'USDT_TRC20') {
        $img = 'https://crypto.binfinitybank.com/public/images/tron-usdt.png';
    }
    if ($order[0]['coin'] == 'USDT_ERC20') {
        $img = 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=029';
    }

  @endphp

  <!-- partial:index.partial.html -->
  {{-- <div class="screen-1">



    <img class="logo" src='{{ $img }}' style='height:100px;width:100px;margin:50px'>


    <div class="email">
      <label for="email">QR CODE {{ $order[0]['coin'] }}</label>
      <div class="sec-2">
        <ion-icon name="mail-outline"></ion-icon>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $order[0]['wallet'] }}">
      </div>
    </div>
    <div class="password">
      <label for="password">ADDRESS</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        {{ $order[0]['wallet'] }}
      </div>
    </div>
    <div class="password">
      <label for="password">VALUE CRYPTO</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        {{ $order[0]['price_crypto'] }}
      </div>
    </div>
    <div class="password">
      <label for="password">VALUE DOLLARS</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        {{ $order[0]['price'] }}
      </div>
    </div>
    <!-- COUNTDOWN -->


    @if ($order[0]['status'] == 'Paid')
      <img src='https://www.freestock.com/450/freestock_567271525.jpg' style='width:100px'>
    @else
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
    @endif

    <!-- FIM COUNT -->


    <button class="login">BACK </button>

  </div> --}}


  <div class="card">
    @if ($order[0]['status'] == 'Pending')
      <form action="{{ route('invoice.verify') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $order[0]['id'] }}">
        <button class="login" style="opacity: .75;width: max-content !important;text-align: center"> Refresh </button>
      </form>
    @endif
    <img class="logo" src='{{ $img }}' style='height:100px;width:100px;'>

    <div class="email">
      <label for="email">QR CODE {{ $order[0]['coin'] }}</label>
      <div class="sec-2" style="margin:auto">
        {{-- <ion-icon name="mail-outline"></ion-icon> --}}
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $order[0]['wallet'] }}">
      </div>
    </div>
    <div class="password">
      <label for="password">ADDRESS</label>
      <div class="sec-2" style="overflow-x: auto">
        <ion-icon name="lock-closed-outline"></ion-icon>
        {{ $order[0]['wallet'] }}
      </div>
    </div>
    <div class="password">
      <label for="password">VALUE CRYPTO</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        {{ $order[0]['price_crypto'] }}
      </div>
    </div>
    <div class="password">
      <label for="password">VALUE DOLLARS</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        {{ $order[0]['price'] }}
      </div>
    </div>

    @if ($order[0]['status'] == 'Paid' || $order[0]['status'] == 'Underpaid' || $order[0]['status'] == 'Overpaid')
      <img src='https://www.freestock.com/450/freestock_567271525.jpg' style='width:100px'>
    @elseif($order[0]['status'] == 'Expired')
      <img src="https://www.onlygfx.com/wp-content/uploads/2020/05/expired-stamp-2.png" style='width:100px'>
    @else
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
    @endif


    <button class="login"> <a href="{{ route('invoice.create') }}" style="color:white">BACK</a> </button>
  </div>

</body>
<script>
  const dateParts = '{{ $order[0]['createdAt'] }}'.split(' ');
  const datePart = dateParts[0].split('-');
  const timePart = dateParts[1].split(':');

  // Construa um novo objeto de data com as partes da data e hora
  const date1 = new Date(
    parseInt(datePart[0]), // ano
    parseInt(datePart[1]) - 1, // mês (0-11)
    parseInt(datePart[2]), // dia
    parseInt(timePart[0]), // hora
    parseInt(timePart[1]), // minutos
    parseInt(timePart[2]) // segundos
  );
  const date2 = addHours(date1, 1);
  console.log(date2);

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


{{-- <script>
  // Obtenha a data do PHP e converta-a em um objeto Date do JavaScript
  const dateParts = '2024-02-05 10:03:13'.split(' '); // Use um espaço para dividir a string
  const datePart = dateParts[0].split('-');
  const timePart = dateParts[1].split(':');

  // Construa um novo objeto de data com as partes da data e hora
  const date1 = new Date(
    parseInt(datePart[0]), // ano
    parseInt(datePart[1]) - 1, // mês (0-11)
    parseInt(datePart[2]), // dia
    parseInt(timePart[0]), // hora
    parseInt(timePart[1]), // minutos
    parseInt(timePart[2]) // segundos
  );

  console.log(date1);

  // Adicione uma hora à data
  const date2 = addHours(date1, 1);

  // Obtenha o valor de data e hora da data atual
  const targetDate = date2.getTime();

  // Atualize o contador a cada segundo
  const countdownInterval = setInterval(() => {
    const now = new Date().getTime(); // Obtenha a data e hora atual

    const timeDifference = targetDate - now; // Calcule a diferença de tempo entre as datas

    // Calcule dias, horas, minutos e segundos
    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    // Atualize os elementos HTML com os valores calculados
    document.getElementById("days").textContent = days;
    document.getElementById("hours").textContent = hours;
    document.getElementById("minutes").textContent = minutes;
    document.getElementById("seconds").textContent = seconds;

    // Verifique se o contador expirou
    if (timeDifference < 0) {
      clearInterval(countdownInterval);
      document.getElementById("timer").innerHTML = "Contagem regressiva expirada";
    }
  }, 1000);

  // Função para adicionar horas a uma data
  function addHours(date, hours) {
    return new Date(date.getTime() + hours * 60 * 60 * 1000);
  }
</script> --}}

</html>
