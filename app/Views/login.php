<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="assets/images/icon.jpg" type="image/x-icon" />
  <title>Memancing Shincan</title>  
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    form {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }
    img {
      border-radius: 50%;
      width: 130px;
      height: 130px;
      object-fit: cover;
    }
    input, button {
      width: 100%;
      padding: 1rem;
      font-size: 1rem;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    button {
      background-color: #cce38c;
      color: #af7a3b;
      border: none;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background-color: #af7a3b;
      color: #cce38c;

    }
    .error {
      color: red;
      font-size: 0.9rem;
      align-self: flex-start;
    }
    .alert {
      background-color: #ffdddd;
      color: #d8000c;
      border: 1px solid #f5c6cb;
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 8px;
      width: 100%;
      text-align: center;
      animation: fadein 0.5s;
    }

    @keyframes fadein {
      from {opacity: 0;}
      to {opacity: 1;}
    }

  </style>
</head>
<body>
  <main>
    <?php if(session()->getFlashdata('pesan')): ?>
      <div class="alert">
        <?= session()->getFlashdata('pesan') ?>
      </div>
    <?php endif; ?>

    

    <form method="POST" action="<?= base_url('login') ?>">
      <img id="bear-img" src="assets/images/bear/watch_bear_0.png" alt="Bear" />
      
      <input 
        id="username" 
        name="username" 
        type="text" 
        placeholder="Username" 
        required
        onfocus="onFocususername()" 
        oninput="onusernameInput()" 
        value="<?= old('username') ?>" 
      />
      <?php if(isset($validation)): ?>
        <div class="error"><?= $validation->getError('username') ?></div>
      <?php endif; ?>

      <input 
        id="password" 
        name="password" 
        type="password" 
        placeholder="Password" 
        required 
        onfocus="onFocusPassword()" 
      />
      <?php if(isset($validation)): ?>
        <div class="error"><?= $validation->getError('password') ?></div>
      <?php endif; ?>

      <button type="submit">Log In</button>
    </form>
  </main>

  <script>
    const watchBearImgs = [];
    const hideBearImgs = [];

    for (let i = 0; i <= 20; i++) {
      watchBearImgs.push(`assets/images/bear/watch_bear_${i}.png`);
    }

    for (let i = 0; i <= 5; i++) {
      hideBearImgs.push(`assets/images/bear/hide_bear_${i}.png`);
    }

    const bearImg = document.getElementById("bear-img");
    const usernameInput = document.getElementById("username");

    function onFocususername() {
      onusernameInput();
    }

    function onusernameInput() {
      const length = usernameInput.value.length;
      const maxChars = 30;
      const index = Math.min(Math.floor((length / maxChars) * watchBearImgs.length), watchBearImgs.length - 1);
      bearImg.src = watchBearImgs[index];
    }

    function onFocusPassword() {
      let i = 0;
      const interval = setInterval(() => {
        bearImg.src = hideBearImgs[i];
        i++;
        if (i >= hideBearImgs.length) clearInterval(interval);
      }, 50);
    }
  </script>
</body>
</html>
