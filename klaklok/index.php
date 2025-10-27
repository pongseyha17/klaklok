<!DOCTYPE html>
<html lang="km">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kla Klouk Game</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #2c3e50, #34495e);
      color: white;
      font-family: "Khmer OS Battambang", Arial, sans-serif;
      text-align: center;
    }
    h1 {
      margin: 20px 0;
      font-weight: bold;
    }
    .dice-area img {
      width: 100px;
      margin: 10px;
      border-radius: 10px;
      background: white;
      padding: 5px;
    }
    .bet-card {
      border-radius: 15px;
      overflow: hidden;
      transition: transform 0.2s ease;
    }
    .bet-card:hover {
      transform: scale(1.05);
    }
    .bet-card img {
      width: 100%;
      height: 120px;
      object-fit: contain;
      background: white;
      padding: 10px;
    }
    .bet-card input {
      margin-top: 10px;
      width: 100%;
      text-align: center;
      font-weight: bold;
    }
    .balance-box {
      background: #27ae60;
      padding: 15px;
      border-radius: 12px;
      font-size: 1.2rem;
      font-weight: bold;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.3);
    }
    .btn-custom {
      font-size: 1.2rem;
      font-weight: bold;
      border-radius: 10px;
      padding: 10px 30px;
    }
  </style>
  <script src="js/myscript.js"></script>
</head>
<body>
  <div class="container py-4">
    <h1>🎲 ចាក់ខ្លាឃ្លោក 🎲</h1>

    <!-- Dice display -->
    <div class="dice-area my-3">
      <img src="img/dice_1.PNG" id="dice1">
      <img src="img/dice_2.PNG" id="dice2">
      <img src="img/dice_3.PNG" id="dice3">
    </div>

    <!-- Buttons & Balance -->
    <div class="d-flex justify-content-center align-items-center gap-4 my-3">
      <input type="button" value="ក្រឡុក" onclick="startShaking()" id="mybut" class="btn btn-warning btn-custom">
      <div class="balance-box">
        💰 ប្រាក់នៅសល់: <span id="balance">0</span> $
      </div>
    </div>

    <h3 class="mt-4">⚡ សូមមេតាភ្នាល់ ⚡</h3>

    <!-- Betting Grid -->
    <div class="row mt-3">
      <div class="col-6 col-md-4 col-lg-2 mb-3" id="bet1">
        <div class="card bet-card">
          <img src="img/dice_1.PNG">
          <div class="card-body p-2">
            <input type="number" id="betdice1" value="0" min="0" step="500" class="form-control">
          </div>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-2 mb-3" id="bet2">
        <div class="card bet-card">
          <img src="img/dice_2.PNG">
          <div class="card-body p-2">
            <input type="number" id="betdice2" value="0" min="0" step="500" class="form-control">
          </div>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-2 mb-3" id="bet3">
        <div class="card bet-card">
          <img src="img/dice_3.PNG">
          <div class="card-body p-2">
            <input type="number" id="betdice3" value="0" min="0" step="500" class="form-control">
          </div>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-2 mb-3" id="bet4">
        <div class="card bet-card">
          <img src="img/dice_4.PNG">
          <div class="card-body p-2">
            <input type="number" id="betdice4" value="0" min="0" step="500" class="form-control">
          </div>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-2 mb-3" id="bet5">
        <div class="card bet-card">
          <img src="img/dice_5.PNG">
          <div class="card-body p-2">
            <input type="number" id="betdice5" value="0" min="0" step="500" class="form-control">
          </div>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-2 mb-3" id="bet6">
        <div class="card bet-card">
          <img src="img/dice_6.PNG">
          <div class="card-body p-2">
            <input type="number" id="betdice6" value="0" min="0" step="500" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var min = 1;
    var max = 6;
    var cmd;
    var amount = 0;
    var dice1, dice2, dice3;

    function getBalance() {
      amount = parseFloat(prompt("សូមបញ្ចូលប្រាក់ដើម 💵")) || 0;
      document.getElementById("balance").innerHTML = amount;
    }

    function shakingDice() {
      var d1 = document.getElementById("dice1");
      var d2 = document.getElementById("dice2");
      var d3 = document.getElementById("dice3");
      dice1 = Math.floor(Math.random() * (max - min + 1)) + min;
      dice2 = Math.floor(Math.random() * (max - min + 1)) + min;
      dice3 = Math.floor(Math.random() * (max - min + 1)) + min;
      d1.src = "img/dice_" + dice1 + ".PNG";
      d2.src = "img/dice_" + dice2 + ".PNG";
      d3.src = "img/dice_" + dice3 + ".PNG";
    }

    function startShaking() {
      var but = document.getElementById("mybut");
      if (but.value == "ក្រឡុក") {
        cmd = setInterval(shakingDice, 100);
        but.value = "ឈប់";
        but.classList.replace("btn-warning", "btn-danger");
      } else {
        clearInterval(cmd);
        but.value = "ក្រឡុក";
        but.classList.replace("btn-danger", "btn-warning");
        checkWin();
      }
    }

    function checkWin() {
      for (var i = 1; i <= 6; i++) {
        var betBox = document.getElementById("bet" + i);
        var betAmount = parseFloat(document.getElementById("betdice" + i).value) || 0;

        if (i == dice1 || i == dice2 || i == dice3) {
          betBox.querySelector(".card").style.border = "3px solid #2ecc71";
          amount += betAmount;
        } else {
          betBox.querySelector(".card").style.border = "3px solid #e74c3c";
          amount -= betAmount;
        }
      }
      document.getElementById("balance").innerHTML = amount;
    }

    getBalance();
  </script>
</body>
</html>
