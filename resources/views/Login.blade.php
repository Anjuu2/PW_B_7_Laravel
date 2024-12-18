<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

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

    </style>
</head>
<body class="antialiased">

<section class="background-animation">
    <video class="video-background" autoplay loop muted>
        <source src="{{asset("images/test.mp4")}}" type="video/mp4"> <!-- background video -->
        Your browser does not support the video tag.
    </video>

    <div class="bg-overlay"></div>
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5 content">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="my-5 display-5 fw-bold">
                    Hadir Untuk Anda, Bersama Membangun Masa Depan Anda
                </h1>
            </div>
            <div class="col-lg-5 mb-5 mb-lg-0 position-relative ms-auto">
                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                    <form class="form">
    @csrf
    <div>
        <h4 class="mb-3 fw-bold text-start">Selamat Datang</h4>
    </div>
    <div class="form-floating">
        <input type="number" name="npm" class="form-control mb-4" id="floatingNpm" placeholder="Nomor Mahasiswa" required />
        <label for="floatingInput">Nomor Mahasiswa</label>
    </div>

    <div class="form-floating">
        <input type="password" name="password" class="form-control mb-4" id="floatingPassword" placeholder="Kata Sandi" required />
        <label for="floatingPassword">Kata Sandi</label>
    </div>

    <div class="form-floating">
        <input type="number" name="pin" class="form-control" id="floatingPin" placeholder="Pin Atma Loan" required />
        <label for="floatingPin">Pin Atma Loan</label>
    </div>

    <button type="submit" style="width:100%;" class="btn btn-dark btn-block mb-2 mt-3" id="loginButton">Login</button>
    <div class="d-flex justify-content-center mt-2">
        <a href="{{ url('register') }}" class="link-dark" style="font-size: 22px;">Buat Akun SIDUFA</a>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-C6RzsynM9kwDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
            <!-- <script>
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector(".form");

    // Listen for form submission
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        // Get form values
        

        // Send POST request to the login API endpoint
        fetch("http://127.0.0.1:8001/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },const npm = document.querySelector("#floatingNpm").value;
        const password = document.querySelector("#floatingPassword").value;
        const pin = document.querySelector("#floatingPin").value;
        console.log("Form is being submitted...");
            body: JSON.stringify({
                npm: npm,
                password: password,
                pin: pin
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                // Store the token in localStorage or sessionStorage
                localStorage.setItem('authToken', data.token);

                // Redirect to the dashboard (banl/index)
                window.location.href = "/bank/index";
            } else {
                // Handle error if login fails
                alert(data.message);
                statusElement.textContent = "Login failed: " + data.message;
            }
        })
        .catch(error => {
            console.error("Error:", error);
            statusElement.textContent = "Login failed: " + error.message;
        });
    });
});


        </script> -->

        <script>
        console.log("Form is being submitted...1");
        document.getElementById('loginButton').addEventListener('click', function () {
                const npm = document.querySelector("#floatingNpm").value;
                const password = document.querySelector("#floatingPassword").value;
                const pin = document.querySelector("#floatingPin").value;
        console.log("Form is being submitted..2.");
                
                    fetch("http://127.0.0.1:8000/api/login", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            npm: npm,
                            password: password,
                            pin: pin
                        })
                    })
                        .then(response => {
                            console.log('Response Status:', response.status);
                            if (!response.ok) {
                                throw new Error('Invalid data');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.message === 'Halo Admin'){
                                console.log("admin");
                                window.location.href = "{{ url('/admin/listakun') }}";  // Redirect to the bank/index page
                            }else if(data.message==='Login successful.'){
                                console.log('Response Data:', data);
                            
                            if (data.status) {
                                localStorage.setItem('authToken', data.token);
                                    
                                Toastify({
                                    text: "Login Success! Welcome   " + npm,
                                    duration: 20000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "linear-gradient(to right, #4caf50, #8bc34a)", // Green gradient for success
                                }).showToast();
                                console.log("Form is being submitted...3");
                                
                                    window.location.href = "{{ url('/bank/index') }}"; 
                            }
                             // Redirect to the bank/index page
                                
                    
                                 console.log("Form is being submitted...4");
                            } else {
                                alert('Invalid credentials');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error.message);
                            alert('An error occurred during login. Please check your credentials or try again later.');
                            Toastify({
                                    text: "An unexpected error occurred. Please try again.",
                                    duration: 2000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "linear-gradient(to right, #ff5f6d, #7a0606", // Green gradient for success
                                }).showToast();
                        });
                
            });
            </script>
</body>
</html>
