<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login Bear</title>
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
      background-color: #845ec2;
      color: white;
      border: none;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background-color: #6c46b7;
    }
  </style>
</head>
<body>
  <main>
    <form onsubmit="submitForm(event)">
      <img id="bear-img" src="assets/images/bear/watch_bear_0.png" alt="Bear" />
      <input id="username" type="text" placeholder="username" onfocus="onFocususername()" oninput="onusernameInput()" />
      <input id="password" type="password" placeholder="Password" onfocus="onFocusPassword()" />
      <button type="submit">Log In</button>
    </form>
  </main>

  <script>
    const watchBearImgs = [];
    const hideBearImgs = [];

    // Load all 21 watch bear images
    for (let i = 0; i <= 20; i++) {
      watchBearImgs.push(`assets/images/bear/watch_bear_${i}.png`);
    }

    // Load 6 hide bear images
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
      const maxChars = 30; // Sesuaikan ini jika mau lebih/kurang sensitif
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
