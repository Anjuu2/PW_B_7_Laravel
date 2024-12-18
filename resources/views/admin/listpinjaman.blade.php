@extends('admin')
@section('isi')

<style>
    .table{
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: 15px;
    }

    td{
        border: 2px solid black;
    }

    .id{
        width: 5vw;
    }
    .dropdown{
        display: block;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="dropdown">
    <button class="btn btn-lg dropdown-toggle no-border d-flex align-items-center ps-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <h2>Daftar Pengajuan Pinjaman</h2>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{url('/admin/listakun')}}">Daftar Akun</a></li>
        <li><a class="dropdown-item" href="{{url('/admin/listpembayaran')}}">Daftar Pembayaran</a></li>
        <li><a class="dropdown-item" href="{{url('/admin/listdeposit')}}">Daftar Deposit</a></li>
    </ul>
</div>

<div class="container mt-3 ms-0 ps-0">
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search" style="width: 250px;">
        <button class="btn btn-outline-dark" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
</div>

<table class="table table-striped border-dark text-center mt-4 ms-0" id="peminjaman-table">
    <thead class="table-dark">
        <tr>
            <th class="id">ID</th>
            <th>Nomor Rekening</th>
            <th>Nominal Peminjaman</th>
            <th>Masa Angsuran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="modal fade" id="staticVerifikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticVerifikasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticVerifikasiLabel">Verifikasi Peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deskripsi</p>
                <strong>Nominal yang disetujui</strong>
                <div class="input-group mb-3">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="floatingNumberNominal" placeholder="Masukkan Jumlah" required>
                </div>
                <strong class="mt-3">Masa Angsuran yang disetujui</strong>
                <input type="number" class="form-control    mb-3" id="floatingNumberAngsuran" placeholder="Masukkan Masa Angsuran" required>
                <strong class="mt-3">Tanggal Verifikasi</strong>
                <input type="date" class="form-control" id="floatingDate" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tolak</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="acc">Terima</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticKTM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticKTMLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h1 class="modal-title fs-5" id="staticKTMLabel">KTM Peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <img src="{{asset('/images/Ktm.png')}}" alt="KTM">
            </div>
        </div>
    </div>
</div>

<script>
    // Fetch the Akun data from the API when the page loads
    window.addEventListener('DOMContentLoaded', function() {
        fetch('http://127.0.0.1:8000/api/admin/peminjaman')
            .then(response => response.json())
            .then(data => {
                console.log(data);  // Debugging: Cek data yang diterima

                // Cek apakah data.accounts merupakan array
                const accounts = data.data || []; // Gunakan data.accounts jika data memiliki array langsung
                console.log(accounts);  // Cek apakah accounts berisi array

                const tbody = document.querySelector('#peminjaman-table tbody');
                console.log(tbody);  // Cek apakah tbody ditemukan

                // Clear any existing rows
                tbody.innerHTML = '';

                // Loop melalui akun dan tambahkan ke tabel
                accounts.forEach(account => {
                    const row = document.createElement('tr');
                    console.log(account);  // Debugging: Cek apakah objek account benar

                    row.innerHTML = `
                        <td>${account.id}</td>
                        <td>${account.nomor_akun}</td>
                        <td>${account.nominal_peminjaman}</td>
                        <td>${account.masa_peminjaman}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticVerifikasi" data-account-id="${account.id}">Verifikasi</button>
                        </td>
                    `;
                    tbody.appendChild(row);

                    // Debugging: Cek apakah row sudah ditambahkan ke tbody
                    console.log(row);
                });
            })
            .catch(error => {
                console.error('Error fetching akun data:', error);
            });
    });

</script>
<script>
    
</script>
<script>
    $(document).ready(function() {
        $('#staticVerifikasi').on('hidden.bs.modal', function () {
            $(this).find('input[type="date"]').val('');
        });

        $('#btnTolak, #btnTerima').on('click', function() {
            $('#staticVerifikasi').find('input[type="date"]').val('');
        });
    });
</script>

<script>
let accountId = null;

$('#staticVerifikasi').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);  // Button that triggered the modal
    accountId = button.data('account-id');  // Extract account ID from data-* attributes and store it globally
    console.log("Account ID set:", accountId);  // Debugging
});

// Add event listener to the "Terima" button
document.getElementById('acc').addEventListener('click', function () {
    const nominal = document.querySelector("#floatingNumberNominal").value;
    const angsuran = document.querySelector("#floatingNumberAngsuran").value;
    const tanggal = document.querySelector("#floatingDate").value;

    // Now we can access accountId globally
    console.log("Account ID on button click:", accountId);  // Debugging
    console.log("Nominal:", nominal);  // Debugging

    if (accountId === null) {
        alert("Account ID is missing! Please try again.");
        return;
    }

    // Send the update request to the backend
    fetch(`http://127.0.0.1:8000/api/admin/peminjaman/update/${accountId}`, {
        method: 'POST',
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            nominal_peminjaman: nominal,
            masa_peminjaman: angsuran,
            tanggal_peminjaman: tanggal,
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            // Close the modal
            $('#staticVerifikasi').modal('hide');
            
            // Optionally, update the table row or show a success message
            alert('Peminjaman updated successfully!');
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error submitting your update.');
    });
});
</script>

@endsection