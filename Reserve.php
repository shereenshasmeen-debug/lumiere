<?php 
session_start();
include 'NavSidebarAfter.php'; 


// Jika belum login → paksa login dulu
if(!isset($_SESSION['id'])){
    echo "<script>alert('Please log in before making a reservation!'); window.location='Login.php';</script>";
    exit;
}
?>
<style>
    body { font-family: "Playfair Display", serif; background-color:#000; color:white; overflow-x:hidden; }
    .background-overlay{position:absolute; inset:0; background-image:url('img/foto1.webp'); background-size:cover; opacity:.45; z-index:1;}
    .content{position:relative; z-index:2; max-width:900px; margin-left:70px;}
    .title{font-size:55px; font-weight:700; margin-bottom:20px;}
    .datetime-input{background:#f1f1f1;border:none;border-radius:30px;padding:12px 20px;width:300px;font-size:15px;color:#333;}
    .datetime-input:focus{outline:none;box-shadow:0 0 0 3px rgba(255,0,0,.4);}
    .selection-box{background:#ffffffee;border-radius:18px;padding:25px 35px;max-width:450px;margin-top:10px;}
    .toggle-buttons{display:flex;gap:10px;margin-bottom:15px;}
    .toggle-btn{flex:1;padding:12px;border-radius:8px;border:none;font-weight:600;cursor:pointer;background:#b9a29d;color:#333;}
    .toggle-btn.active{background:#3f1117;color:white;transform:scale1.03;}
    .room-list button,.table-list button{width:100%;background:#fff;border:none;padding:14px;color:#7b0000;font-size:16px;margin-bottom:7px;border-radius:8px;font-weight:600;}
    .room-list button:hover,.table-list button:hover{background:#ece0d7;}
    .room-list button.active,.table-list button.active{background:#7b0000;color:white;}
    .next-btn{margin-top:30px;background:white;border:none;padding:10px 40px;border-radius:18px;color:#7b0000;font-size:20px;cursor:pointer;margin-bottom:20px;}
    .next-btn:hover{background:#b9a29d;color:black;}
</style>

<body>
<div class="main-content">
    <div class="background-overlay"></div>
    <div class="content">
        <h1 class="title">Reservation</h1>

        <label>Date & Time</label><br>
        <input type="datetime-local" id="datetime" class="datetime-input">

        <div class="room-section mt-4">
            <label>Select Room & Table</label>
            <div class="selection-box">
                <div class="toggle-buttons">
                    <button class="toggle-btn" onclick="showTab('room')">Room</button>
                    <button class="toggle-btn" onclick="showTab('table')">Table</button>
                </div>

                <div class="room-list" id="roomList">
                    <button onclick="selectRoom(this)">Bar</button>
                    <button onclick="selectRoom(this)">Hall</button>
                    <button onclick="selectRoom(this)">Private</button>
                    <button onclick="selectRoom(this)">Beach Lounge</button>
                </div>

                <div class="table-list" id="tableList" style="display:none;">
                    <button onclick="selectTable(this)">Table 1</button>
                    <button onclick="selectTable(this)">Table 2</button>
                    <button onclick="selectTable(this)">Table 3</button>
                    <button onclick="selectTable(this)">Table 4</button>
                    <button onclick="selectTable(this)">Table 5</button>
                </div>
            </div>
        </div>
        <button class="next-btn" onclick="handleNext()">Next</button>
    </div>
</div>

<script>
function showTab(tab){
    document.getElementById('roomList').style.display = (tab==='room')?'block':'none';
    document.getElementById('tableList').style.display = (tab==='table')?'block':'none';
}

function selectRoom(btn){ [...btn.parentElement.children].forEach(b=>b.classList.remove('active')); btn.classList.add('active'); }
function selectTable(btn){ [...btn.parentElement.children].forEach(b=>b.classList.remove('active')); btn.classList.add('active'); }

function handleNext(){
    let datetime      = document.getElementById('datetime').value;
    let selectedRoom  = document.querySelector('#roomList button.active');
    let selectedTable = document.querySelector('#tableList button.active');

    if(!datetime) return alert("Select Tanggal & Waktu!");
    if(!selectedRoom) return alert("Select a Room!");
    if(!selectedTable) return alert("Select a Table!");

    // Simpan ke localStorage untuk receipt nanti
    localStorage.setItem("reservation_datetime", datetime);
    localStorage.setItem("reservation_room", selectedRoom.textContent);
    localStorage.setItem("reservation_table", selectedTable.textContent);

    // Kirim ke backend untuk simpan database
    let form = document.createElement("form");
    form.method="POST"; form.action="reserve_proses.php";
    form.innerHTML = `
        <input type="hidden" name="datetime" value="${datetime}">
        <input type="hidden" name="room" value="${selectedRoom.textContent}">
        <input type="hidden" name="table" value="${selectedTable.textContent}">
    `;
    document.body.appendChild(form);
    form.submit();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
