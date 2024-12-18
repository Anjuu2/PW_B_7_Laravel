<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <style>
        body {
            font-family: 'Figtree', Arial, Helvetica, sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .background-animation {
            position: relative;
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
        }

        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: 1;
            transform: translate(-50%, -50%);
            object-fit: cover;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 2;
        }

        .bg-glass {
            background-color: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: saturate(150%) blur(30px);
            z-index: 3;
        }

        .content {
            position: relative;
            z-index: 4;
            color: white;
            text-align: center;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="antialiased">

<section class="background-animation">
    <video class="video-background" autoplay loop muted>
        <source src="{{url("images/test.mp4")}}" type="video/mp4"> <!-- background video -->
        Your browser does not support the video tag.
    </video>

    <div class="bg-overlay"></div>
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5 content">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-0 mb-5 mb-lg-0 position-relative ms-auto">
                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                    <form class="form" action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <h3 class="mb-3 fw-bold text-center">Registrasi Akun SIDUFA</h3>
    </div>
    
    <div class="row me-1">
        <div class="col-md-6 mb-5">
            <div class="form-floating">
                <input type="number" name="npm" class="form-control" id="floatingNpm" placeholder="Nomor Mahasiswa" required />
                <label for="floatingNpm">Nomor Mahasiswa</label>
            </div>
        </div>

        <div class="col-md-6 mb-5">
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Kata Sandi" required />
                <label for="floatingPassword">Kata Sandi</label>
            </div>
        </div>
    </div>

    <div class="row me-1">
        <div class="col-md-6 mb-5">
            <div class="form-floating">
                <input type="text" name="nama_akun" class="form-control" id="floatingNama" placeholder="Nama Mahasiswa" required />
                <label for="floatingNama">Nama Mahasiswa</label>
            </div>
        </div>

        <div class="col-md-6 mb-5">
            <div class="form-floating">
                <input type="number" name="pin" class="form-control" id="floatingPin" placeholder="Pin Atma Loan" required />
                <label for="floatingPin">Pin Atma Loan</label>
            </div>
        </div>
    </div>

    <button type="submit" style="width:25%;" class="btn btn-dark btn-block mx-auto d-block" >Daftar</button>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-C6RzsynM9kwDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script>
    document.addEventListener("DOMContentLoaded", () => {
        const registerButton = document.querySelector('.btn.btn-dark.btn-block.mx-auto.d-block');
        
        // Add event listener for the register button
        registerButton.addEventListener('click', async function (e) {
            e.preventDefault(); // Prevent the default form submission

            try {
                // Collect form data
                const npm = document.getElementsByName('npm')[0].value;
                const pin = document.getElementsByName('pin')[0].value;
                const nama_akun = document.getElementsByName('nama_akun')[0].value;
                const password = document.getElementsByName('password')[0].value;

                // Prepare the data to be sent
                const data = {
                    npm,
                    nama_akun,
                    pin,
                    password
                };

                // Send data to the server using fetch
                const registerResponse = await fetch("http://127.0.0.1:8001/api/register", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                });

                const responseJson = await registerResponse.json();
                if (registerResponse.ok) {
                    // Handle success, maybe redirect or show a success message
                    console.log('Registration Successful', responseJson);
                } else {
                    // Handle errors
                    console.log('Registration Error', responseJson);
                }

            } catch (error) {
                console.error("Error in registration:", error);
            }
        });
    });
</script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js">
    
</script>
</body>

</html>
