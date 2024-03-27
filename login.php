<?php
include("components/header.php");
?>

<body class="h-full bg-gray-900">
    <?php
    session_start();

    require_once("database.php");

    // ถ้า login อยู่แล้วให้ไปที่ dashboard
    if (isset($_SESSION["user"])) {
        header("Location: index.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // หา user จาก database
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // ตรวจสอบรหัสผ่าน
        if ($user && password_verify($password, $user['password'])) {
            // ตั้ง session
            $_SESSION['user'] = $user;
            header('Location: index.php');
        } else {
            $_SESSION['loginfail'] = "
            <div class='rounded-md bg-red-50 p-4'>
            <div class='flex'>
              <div class='flex-shrink-0'>
                <svg class='h-5 w-5 text-red-400' viewBox='0 0 20 20' fill='currentColor' aria-hidden='true'>
                  <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z' clip-rule='evenodd' />
                </svg>
              </div>
              <div class='ml-3'>
                <h3 class='text-sm font-medium text-red-800'>Invalid email or password</h3>
              </div>
            </div>
          </div>
            ";
            header('Location: login.php');
        }
    }
    ?>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="img/logo.png" alt="">
            <h2 class="mt-4 text-center text-2xl font-bold leading-9 tracking-tight text-white">Sign in</h2>
        </div>

        <div class="mt-9 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="login.php" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-white">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-white">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="password" required class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <?php
                if (isset($_SESSION['loginfail'])) {
                    echo $_SESSION['loginfail'];
                }
                ?>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Sign in</button>
                </div>
            </form>
        </div>
    </div>

</body>