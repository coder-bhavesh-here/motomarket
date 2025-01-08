<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World On Moto</title>
    @vite('resources/css/app.css') <!-- Make sure you're using Laravel Mix or Vite -->
</head>

<body class="bg-cover bg-center h-screen flex flex-col justify-center items-center text-white"
    style="background-image: url('{{ asset('images/bg.jpg') }}');">
    <div class="text-center max-w-2xl h-full">
        <!-- Logo -->
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto mb-6 w-32">

        <!-- Main Heading -->
        <div class="p-5"
            style="border: 1px solid gray;background: #4c4c4cb3;border-radius: 10px;box-shadow: gray 0px 0px 30px 10px;">
            <h1 class="text-xl md:text-2xl font-bold mb-4">Hold onto your helmets—adventure is revving up!</h1>

            <!-- Subtext -->
            <p class="text-lg md:text-xl mb-6 leading-relaxed">
                We’re hard at work in the garage, tuning up WorldOnMoto.com to bring you the ultimate motorcycle
                adventure
                experiences from around the world—epic rides to last a lifetime.
            </p>
            <p class="text-lg md:text-xl mb-8">
                Stay tuned—your next ride is just around the corner.
            </p>
        </div>
    </div>
    <!-- Social Icons -->
    <div class="flex justify-center space-x-4">
        <a href="https://facebook.com" target="_blank" class="text-white hover:text-yellow-500 text-2xl">
            <i class="fab fa-facebook"></i> <!-- Font Awesome -->
        </a>
        <a href="https://youtube.com" target="_blank" class="text-white hover:text-yellow-500 text-2xl">
            <i class="fab fa-youtube"></i>
        </a>
        <a href="https://instagram.com" target="_blank" class="text-white hover:text-yellow-500 text-2xl">
            <i class="fab fa-instagram"></i>
        </a>
    </div>
    </div>
</body>

</html>
