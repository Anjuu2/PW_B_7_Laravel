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
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="dropdown">
    <button class="btn btn-lg dropdown-toggle no-border d-flex align-items-center ps-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <h2>Daftar Pembayaran</h2>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{url('/admin/listakun')}}">Daftar Akun</a></li>
        <li><a class="dropdown-item" href="{{url('/admin/listpinjaman')}}">Daftar Pengajuan Pinjaman</a></li>
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

<table class="table table-striped border-dark text-center mt-4 ms-0" id="pembayaran-table">
    <thead class="table-dark">
        <tr>
            <th class="id">ID</th>
            <th>Nomor Akun</th>
            <th>Nominal Angsuran</th>
            <th>Tahap Angsuran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="modal fade" id="staticVerifikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticVerifikasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="staticVerifikasiLabel">Verifikasi Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deskripsi</p>
                <strong class="mt-3">Tanggal Verifikasi</strong>
                <input type="date" class="form-control" id="floatingDate" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tolak</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="acc">Terima</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Fetch the Akun data from the API when the page loads
    window.addEventListener('DOMContentLoaded', function() {
        fetch('http://127.0.0.1:8000/api/admin/pembayaran')
            .then(response => response.json())
            .then(data => {
                console.log(data);  // Debugging: Cek data yang diterima

                // Cek apakah data.accounts merupakan array
                const accounts = data.data || []; 
                
                console.log(accounts);  // Cek apakah accounts berisi array

                const tbody = document.querySelector('#pembayaran-table tbody');
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
                        <td>${account.nominal_angsuran}</td>
                        <td>${account.tahapan_angsuran}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticVerifikasi" data-account-id="${account.id}">Verifikasi</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

</script>


<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
let accountId = null;

$('#staticVerifikasi').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);  // Button that triggered the modal
    accountId = button.data('account-id');  // Extract account ID from data-* attributes and store it globally
    console.log("Account ID set:", accountId);  // Debugging
});

// Add event listener to the "Terima" button
document.getElementById('acc').addEventListener('click', function () {
    const tanggal = document.querySelector("#floatingDate").value;

    // Now we can access accountId globally
    console.log("Account ID on button click:", accountId);  // Debugging

    if (accountId === null) {
        alert("Account ID is missing! Please try again.");
        return;
    }

    // Send the update request to the backend
    fetch(`http://127.0.0.1:8000/api/admin/pembayaran/update/${accountId}`, {
        method: 'POST',
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            tanggal_pembayaran: tanggal,
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
    
    
    // Now we can access accountId globally
    console.log("Account ID on button click:", accountId);  // Debugging
    
    if (accountId === null) {
        alert("Account ID is missing! Please try again.");
        return;
    }

    // Send the update request to the backend
    fetch(`http://127.0.0.1:8000/api/admin/riwayat/pembayaran/${accountId}`, {
        method: 'POST',
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json",
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
           
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error submitting your History.');
    });
    
});
</script>

@endsection