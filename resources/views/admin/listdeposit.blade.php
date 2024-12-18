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

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="dropdown">
    <button class="btn btn-lg dropdown-toggle no-border d-flex align-items-center ps-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <h2>Daftar Deposit</h2>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{url('/admin/listakun')}}">Daftar Akun</a></li>
        <li><a class="dropdown-item" href="{{url('/admin/listpinjaman')}}">Daftar Pengajuan Pinjaman</a></li>
        <li><a class="dropdown-item" href="{{url("/admin/listpembayaran")}}"> Daftar pembayaran</a></li>
    </ul>
</div>

<div class="container mt-3 ms-0 ps-0">
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search" style="width: 250px;">
        <button class="btn btn-outline-dark" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <button type="button" class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#staticVerifikasi">Masukkan Data</button>
</div>

<table class="table table-striped border-dark text-center mt-4 ms-0" id="deposit-table">
    <thead class="table-dark">
        <tr>
            <th class="id">ID</th>
            <th>Nomor Rekening</th>
            <th>Nominal Deposit</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="modal fade" id="staticVerifikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticVerifikasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticVerifikasiLabel">Masukkan Data Deposit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strong>Nomor Rekening</strong>
                <input type="number" class="form-control" id="floatingNumberRekening" required>
                <strong class="mt-3">Nominal Deposit</strong>
                <input type="number" class="form-control" id="floatingNumberNominal" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tolak</button>
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="acc">Terima</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Fetch the Akun data from the API when the page loads
    window.addEventListener('DOMContentLoaded', function() {
        fetch('http://127.0.0.1:8000/api/admin/deposit')
            .then(response => response.json())
            .then(data => {
                console.log(data);  // Debugging: Cek data yang diterima

                // Cek apakah data.accounts merupakan array
                const accounts = data.data || []; // Gunakan data.accounts jika data memiliki array langsung
                console.log(accounts);  // Cek apakah accounts berisi array

                const tbody = document.querySelector('#deposit-table tbody');
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
                        <td>${account.nominal_deposit}</td>
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
    
// Add event listener to the "Terima" button
document.getElementById('acc').addEventListener('click', function () {
    const nominal = document.querySelector("#floatingNumberRekening").value;
    const angsuran = document.querySelector("#floatingNumberNominal").value;
    

    // Now we can access accountId globally
   // Debugging
    console.log("Nominal:", nominal);  // Debugging

    // Send the update request to the backend
    fetch(`http://127.0.0.1:8000/api/admin/deposit/create`, {
        method: 'POST',
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            nominal_deposit: angsuran,
            nomor_akun: nominal,
        })
    })
    
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            // Close the modal
            $('#staticVerifikasi').modal('hide');
            
            // Optionally, update the table row or show a success message
            alert('Deposit updated successfully!');
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
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection