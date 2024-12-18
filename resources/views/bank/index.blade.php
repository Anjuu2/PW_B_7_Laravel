@extends('dashboard')
@section('isi')

<style>
    .gambar{
        height: 100px;
        background-color: white;
        background-image: none;

    }

    .gambarKelas{
        width: 300px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
    }

    .card{
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .card:hover{
        transform: scale(1.03);
    }

    .rating-icon{
        color: gold;
    }

    .table{
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: 15px;
    }

    td{
        border: 2px solid black;
    }

</style>

<div class="content">
    <div class="container-fluid">
        <h1>Status SIDUFA</h1>
        <div class="row align-items-center mt-3">
            <div class="col-md-3 col-sm-6">
                <div class="card p-0 mx-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <img class="gambar p-1 me-2" src="{{ asset('images/foto1Fixxx.png') }}" alt="" >
                            <div class="text-start mt-2">
                                
                                <h4 style="font-size: 20px;">Status Akun</h4>
                                <p class="m-0">Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card p-0 mx-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <img class="gambar p-1 me-2" src="{{ asset('images/foto2.png') }}" alt="" >
                            <div class="text-start mt-2">
                            <h4 style="font-size: 20px; padding-top: -10vh;" >Sisa Pinjaman</h4>
                            <p class="m-0" id="sisa">Rp 8.300.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card p-0 mx-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <img class="gambar p-1 me-2" src="{{ asset('images/foto3Fix.png') }}" alt="" >
                            <div class="text-start mt-2">
                                <h4 style="font-size: 20px;">Angsuran Berikutnya</h4>
                                <p class="m-0" id="apb">Rp 1.700.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card p-0 mx-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <img class="gambar p-1 me-2" src="{{ asset('images/foto4Fix.png') }}" alt="" >
                            <div class="text-start mt-2">
                                <h4 style="font-size: 20px;">Tenggat Pembayaran</h4>
                                <p class="m-0" id="tpb">29 - 02 - 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1>Fasilitas SIDUFA</h1>
        <table class="table table-striped border-dark text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nama Fasilitas</th>
                    <th>Nominal minimum</th>
                    <th>Lama Angsuran</th>
                    <th>Status Layanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pengajuan Pinjaman</td>
                    <td>Rp 10.000.000</td>
                    <td>> 180 Hari</td>
                    <td>Tersedia</td>
                    <td>
                        <a href="{{url('bank/pengajuanPinjaman')}}">
                        <button type="button" class="btn btn-primary" >
                            <ix></ix> Ajukan
                        </button>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>Pembayaran Pinjaman</td>
                    <td>Rp 100.000</td>
                    <td>-</td>
                    <td>Tersedia</td>
                    <td>
                        <a href="{{url('bank/pembayaranAngsuran')}}">
                            <button type="button" class="btn btn-success" id="pembayaran" >
                                <ix></ix> Ajukan
                            </button>
                        </a></button>
                    </td>
                </tr>

                <tr>
                    <td>Deposit Saldo</td>
                    <td>Rp. 100.000</td>
                    <td>-</td>
                    <td>Tidak Tersedia</td>
                    <td>
                        <button type="button" class="btn btn-warning" disabled>
                            <ix></ix> Ajukan
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch("http://127.0.0.1:8000/api/peminjaman/show", {
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
            document.getElementById('sisa').textContent = "Rp " + akun.nominal_peminjaman.toLocaleString().replace(/,/g, ".");
            const areal= akun.nominal_peminjaman/akun.masa_peminjaman;
            document.getElementById('apb').textContent = "Rp " + areal.toLocaleString().replace(/,/g, ".");
            const datereal= new Date(akun.tanggal_peminjaman);
            datereal.setDate(datereal.getDate()+30)
            document.getElementById('tpb').textContent = datereal.toISOString().split('T')[0];
        } else {
            
        }
    })
    .catch(error => {
        console.error("Error fetching data:", error);
    });
    document.getElementById('pembayaran').addEventListener('click', function () {
        fetch("http://127.0.0.1:8000/api/pembayaran/create", {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                // Add any required data here
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                
                // Optionally, refresh the page or update the UI after the payment creation
            } else {
               
            }
        })
        .catch(error => {
            console.error("Error creating payment:", error);
        });
    });
});
</script>

@endsection