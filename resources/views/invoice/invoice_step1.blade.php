<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcomeNew/images/icon.png">
  <title>Binfinity - Invoice Step 1</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet'
    href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
  <link rel="stylesheet" href="/invoice/style.css?v=2">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcomeNew/images/icon.png">
</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="screen-1">
    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    @if (session('wallet'))
      <div class="alert alert-warning">
        {{ session('wallet') }}, create in <a style="color:blue" href="{{ route('wallets.index') }}">LINK</a>
      </div>
    @endif

    <div class="alert alert-warning" style="display: none" id="aviso">
      Fill value</a>
    </div>

    <img class="logo" src='/assetsWelcomeNew/images/logo2.png' style="width: 200px;margin: 48px;">
    <form action="{{ route('invoice.store.post') }}" method="post">
      @csrf

      <div class="email">
        <label for="email">CHOOSE CRYPTO</label>
        <div class="sec-2">
          <ion-icon name="mail-outline"></ion-icon>
          <select name="method" id="crypto" required>
            {{-- <option value="BITCOIN">BTC</option> --}}
            {{-- <option value="ETH">ETH</option> --}}
            <option value="TRX">TRX</option>
            <option value="USDT_TRC20">USDT TRC20</option>
            <option value="USDT_ERC20">USDT ERC20</option>
          </select>
        </div>
      </div>
      <div class="password">
        <label for="password">VALUE IN DOLLARS</label>
        <div class="sec-2">
          <ion-icon name="lock-closed-outline"></ion-icon>
          <input type="number" id="valuefora" name="value" placeholder="0.00005" step="0.010" onkeyup="temValor()"
            required />
        </div>
      </div>


      @if (isset($userCookie))
        <div class="password" style="display: none">
          <label for="password">Financial password</label>
          <div class="sec-2">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="text" value="{{ $userCookie->financial_password }}" name="password" placeholder="***"
              required />
          </div>
        </div>

        <div class="password" style="display: none">
          <label for="password">Financial password</label>
          <div class="sec-2">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="text" value="{{ $userCookie->login }}" name="login" placeholder="***" required />
          </div>
        </div>

        <a style='color: #fff;text-decoration: none;'><button class="login" type="submit" style='width: 300px;'>NEXT
          </button></a>
      @endif
    </form>

    @if (!isset($userCookie))
      <div onclick="temValor()">
        <a style='color: #fff;text-decoration: none;'><button disabled data-bs-toggle="modal" id="btn-modal"
            data-bs-target="#exampleModal" class="login" style='width: 300px;'>NEXT
          </button></a>
      </div>
    @endif

  </div>


  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('invoice.store.post') }}" method="post"
            style="display: flex;flex-direction: column;gap:1rem">
            @csrf

            <div class="email" style="display: none">
              <label for="email">CHOOSE CRYPTO</label>
              <div class="sec-2">
                <ion-icon name="mail-outline"></ion-icon>
                <select name="method" id="cryptoModal">
                  {{-- <option value="BITCOIN">BTC</option> --}}
                  {{-- <option value="ETH">ETH</option> --}}
                  <option value="TRX">TRX</option>
                  <option value="USDT_TRC20">USDT TRC20</option>
                  <option value="USDT_ERC20">USDT ERC20</option>
                </select>
              </div>
            </div>
            <div class="password" style="display: none">
              <label for="password">VALUE IN DOLLARS</label>
              <div class="sec-2">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="number" name="value" id="valueModal" placeholder="0.00005" step="0.010" />
              </div>
            </div>

            <div class="password" style="display: flex;flex-direction: column;gap:1rem">
              <label for="password">Login</label>
              <div class="sec-2">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="text" name="login" placeholder="username" required />
              </div>
            </div>

            <div class="password" style="display: flex;flex-direction: column;gap:1rem">
              <label for="password">Financial password</label>
              <div class="sec-2">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="text" name="password" placeholder="***" required />
              </div>
            </div>


            {{-- <a href='' style='color: #fff;    text-decoration: none;'><button class="login" type="submit"
                style='width: 300px;'>NEXT
              </button></a> --}}

            <button type="submit" onclick="pegaDados()" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#exampleModal">
              NEXT
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function temValor() {
      var valuefora = document.getElementById('valuefora').value;
      if (valuefora.length > 0) {
        document.getElementById('btn-modal').disabled = false;
        document.getElementById('aviso').style.display = 'none';
      } else {
        document.getElementById('aviso').style.display = 'block';
      }
    }

    function pegaDados() {

      var crypto = document.getElementById('crypto').value;
      var valuefora = document.getElementById('valuefora').value;

      // console.log(crypto);
      // console.log(valuefora);

      document.getElementById('cryptoModal').value = crypto;
      document.getElementById('valueModal').value = valuefora;

      // cryptoModal = document.getElementById('crypto').value;
      // valueModal = document.getElementById('value').value;

      // console.log(cryptoModal);
      // console.log(valueModal);
    }
  </script>

</body>

</html>
