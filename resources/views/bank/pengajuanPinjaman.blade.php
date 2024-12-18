@extends('dashboard')
@section('isi')
<style>
    .content {
        background-color: #00578f;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        width: 100vh;
        height: 80vh;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
        color: black;
        font-weight: bold;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .form-row .form-group {
        flex: 1;
        margin-right: 15px;
    }

    .form-row .form-group:last-child {
        margin-right: 0;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input, .form-group textarea {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    textarea {
        resize: none;
        width: 100%;
        height: 150px;
    }

    .btn-submit {
        background-color: #00578f;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        float: right;
        font-size: 16px;
    }

    .btn-submit:hover {
        background-color: #004070;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

      <div class="content">
    <div class="form-container">
        <h1><strong>Form Pengajuan Pinjaman</strong></h1>
        <br/>
        <form id="loanForm" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label for="nominal">Nominal Pinjaman</label>
                    <input type="number" id="nominal" name="nominal_peminjaman" class="form-control" placeholder="Masukkan nominal" required>
                </div>
                <div class="form-group">
                    <label for="angsuran">Masa Angsuran</label>
                    <input type="number" id="angsuran" name="masa_peminjaman" class="form-control" placeholder="Masukkan masa angsuran" required>
                </div>
                
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi_peminjaman" class="form-control" placeholder="Masukkan deskripsi" rows="4"></textarea>
            </div>

            <button type="button" id="submitBtn" class="btn-submit">Ajukan</button>
        </form>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true" style="color: #00578f;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Pengajuan Berhasil!</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p style="color:black; font-size:large"><strong>ID Peminjaman : <span id="loanId">106512</span></strong><br/><br/>Konfirmasi Peminjaman Pada Kantor SIDUFA
            Sebelum <span id="tglini">tanggal hari ini + 3 hari</span> </p>
            </div>
            <div class="modal-footer">
                <a href="{{url('/bank/index')}}"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Oke</button></a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    document.getElementById('submitBtn').addEventListener('click', function () {
        const nominal = document.querySelector("#nominal").value;
        const angsuran = document.querySelector("#angsuran").value;
        const desc = document.querySelector("#deskripsi").value
        console.log("disini ");
        fetch('{{ url("http://127.0.0.1:8000/api/peminjaman/create") }}', {
            method: 'POST',
            headers: {
                "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                nominal_peminjaman : nominal,
                masa_peminjaman : angsuran,
                deskripsi_peminjaman : desc,
            })
            
        })
        
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                document.getElementById('loanId').textContent = data.data.id;  // Assuming 'id' is the loan ID returned by API
                const createdAt = new Date(data.data.created_at);  // Convert created_at to Date object
        createdAt.setDate(createdAt.getDate() + 3);  // Add 3 days

        // Format the new date to "YYYY-MM-DD" format (you can adjust this as needed)
        const newDate = createdAt.toISOString().split('T')[0];
        document.getElementById('tglini').textContent = newDate;
                $('#successModal').modal('show');
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        alert('There was an error submitting your loan request.');
        });
    });
</script>

@endsection