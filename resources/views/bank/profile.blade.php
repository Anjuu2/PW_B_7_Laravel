@extends('dashboard')
@section('isi')
<style>
    .gambar {
        width: 250px;
        height: 200px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
    }

    .card {
        border: 3px solid black;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }

    .accordion {
        margin-left: 10rem;
        margin-right: 10rem;
    }

    .gambarprofile {
        max-height: 285px;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<h2 style="padding-left: 2vw;">Hai, Pria Sigma!</h2>
<div class="content">
    <div class="container-fluid ms-3 me-3">
        <div class="card card-body h-100 mt-3 ms-5 me-5">
            <div class="row">
                <div class="col-md-3">
                    <img class="gambar me-2" id="profile-image" src="{{ asset('images/kartu.png') }}" alt="">
                </div>
                <div class="col-md-6 ms-2">
                    <div class="card-body">
                        <h3><strong id="profile-nomor">4968 9537 1003 5249</strong></h3>
                        <h5>Nama: <span id="profile-nama">Tuan Pria Sigma</span></h5>
                        <h5>NPM: <span id="profile-npm">250714920</span></h5>
                        <h5>Saldo: </h5>
                        <h4>Rp <span id="profile-saldo">2.000.000</span></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat -->
        <div class="d-flex justify-content-between align-items-center mb-3 mt-5 me-3">
            <h3>Riwayat</h3>
        </div>

        <!-- Card Riwayat Transaksi -->
        <div class="row me-1">
            <div class="col-md-3">
                <div class="card w-100 h-auto">
                    <div class="card-header bg-success">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><Strong>Pembayaran Angsuran</Strong></h5>
                        <p class="card-text">ID_Transaksi : 311002
                            <br/>Status : Menunggu Konfirmasi
                            <br/>Tanggal : -
                        </p>
                        <p>Nominal : <br/><strong>-</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card w-100 h-auto">
                    <div class="card-header bg-success">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Pembayaran Angsuran</strong></h5>
                        <p class="card-text">ID_Transaksi : 310890
                            <br/>Status : Diterima
                            <br/>Tanggal : 15-04-2025
                        </p>
                        <p>Nominal : <br/><strong>Rp 1.500.000</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card w-100 h-auto">
                    <div class="card-header bg-success">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Pembayaran Angsuran</strong></h5>
                        <p class="card-text">ID_Transaksi : 310821
                            <br/>Status : Diterima
                            <br/>Tanggal : 17-03-2025
                        </p>
                        <p>Nominal : <br/><strong>Rp 1.500.000</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card w-100 h-auto">
                    <div class="card-header bg-primary">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Pengajuan Pinjaman</strong></h5>
                        <p class="card-text">ID_Transaksi : 310771
                            <br/>Status : Diterima
                            <br/>Tanggal : 20-02-2025
                        </p>
                        <p>Nominal : <br/><strong>Rp 10.000.000</strong></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch("http://127.0.0.1:8000/api/show", {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            const akun = data.data;
            document.getElementById('profile-nomor').textContent = akun.nomor_rekening;
            document.getElementById('profile-nama').textContent = akun.nama_akun;
            document.getElementById('profile-npm').textContent = akun.npm;
            document.getElementById('profile-saldo').textContent = akun.saldo.toLocaleString();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("Error fetching data:", error);
    });
});
</script>

@endsection
