@extends('dashboard')
@section('isi')
<style>
    .content {
        background-color: #28a745;
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
        height: auto;
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

    .btn-submit {
        background-color: #28a745;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        float: right;
        font-size: 16px;
    }

    .btn-submit:hover {
        background-color: #2f7543;
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="content">
    <div class="form-container">
        <h1 class="text-center border-bottom pb-3"><strong>Form Pembayaran Pinjaman</strong></h1>
        <br/>
        <form id="loanForm">
            <div class="form-row d-flex justify-content-between align-items-center">
                <div class="form-group me-2 col-md-6">
                    <label for="nominal" id="nominal2">Nominal Angsuran</label>
                    <input type="number" id="nominal" class="form-control" readonly >
                </div>
                <div class="form-group col-md-4">
                    <label for="angsuran">Tahapan Angsuran</label>
                    <input type="number" id="angsuran" class="form-control" readonly>
                </div>
            </div>
            <div class="form-row d-flex justify-content-between align-items-center mt-3">
                <div class="form-group me-2 col-md-6">
                    <label for="sisaAngsuran">Sisa Angsuran</label>
                    <input type="number" id="temp" class="form-control" readonly>
                </div>
            </div>
            
            <div class="text-end mt-auto">
                <button type="button" class="btn-submit" data-bs-toggle="modal" data-bs-target="#successModal">Kirim</button>
            </div>
            

            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
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
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const statusElement = document.querySelector('.d-block');
    const authToken = localStorage.getItem('authToken');
if (!authToken) {
    console.error("No auth token found");
    statusElement.textContent = "No auth token found";
    return;
}
    fetch("http://127.0.0.1:8000/api/pembayaran/show", {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json"
        }
    })
    .then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
})
.then(data => {
    if (data.message === "Pembayaran retrieved successfully.") {
        const pembayaran = data.data;
        document.getElementById('nominal').placeholder = pembayaran.nominal_angsuran.toLocaleString().replace(/,/g, ".");
        document.getElementById('angsuran').placeholder = pembayaran.tahapan_angsuran.toLocaleString();

    } else {
        statusElement.textContent = data.message || "Name not found"; // Display the error message from the API
    }
})
.catch(error => {
    console.error("Error fetching data:", error);
    statusElement.textContent = `Status: Error - ${error.message}`;
});
fetch("http://127.0.0.1:8000/api/peminjaman/show", {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json"
        }
    })
    .then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
})
.then(data => {
    if (data.status) {
        const sisa = data.data;
        document.getElementById('temp').placeholder = sisa.nominal_peminjaman.toLocaleString().replace(/,/g, ".");
        
    } else {
        statusElement.textContent = data.message || "Name not found"; // Display the error message from the API
    }
})
.catch(error => {
    console.error("Error fetching data:", error);
    statusElement.textContent = `Status: Error - ${error.message}`;
});
});
    document.querySelector('.btn-submit').addEventListener('click', function () {
        
        document.getElementById('loanForm').reset();
        console.log('Pengajuan berhasil!');
    });
</script>
<script>
    document.querySelector('.btn-submit').addEventListener('click', function () {
        fetch("http://127.0.0.1:8000/api/pembayaran/show", {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.message === "Pembayaran retrieved successfully.") {
                // Update modal with loan details
                const loanId = data.data.id;  // Assuming 'id' is returned in the data
                const createdAt = new Date(data.data.created_at);  // Convert created_at to Date object
                createdAt.setDate(createdAt.getDate() + 3);  // Add 3 days to the date
                const newDate = createdAt.toISOString().split('T')[0];  // Format the date

                // Update the modal content
                document.getElementById('loanId').textContent = loanId;
                document.getElementById('tglini').textContent = newDate;

                // Show the modal
                $('#successModal').modal('show');
            } else {
                statusElement.textContent = data.message || "Data not found";
            }
        })
        .catch(error => {
            console.error("Error fetching data:", error);
            statusElement.textContent = `Status: Error - ${error.message}`;
        });
    });
</script>



@endsection