<?php
  include 'NavSidebarAfter.php';
?>
<style>
    body {
        font-family: "Playfair Display", serif;
        background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
        color: white;
        overflow-x: hidden;
    }
    .title {
        font-size: 55px;
        letter-spacing: 2px;
        font-weight: 700;
        margin-bottom: 20px;
        margin-top: -60px;
    }
    .theme {
        min-height:100vh;
        background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
        color: white;
        padding: 60px;
        height: auto;
        font-family:'Playfair Display', serif;         
    }
    .checkout-card {
        background-color: #2a0a0f;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }
    .btn-checkout {
        background-color: #6b1825;
        color: white;
        font-size: 20px;
        font-weight: 600;
        width: 100%;
        padding: 12px;
        border-radius: 10px;
    }
    .btn-checkout:hover {
        background: #b9a29d;
        color: black;
    }
</style>

<body>
<div class="theme" id="cart-container">
   <div class="content">
        <h1 class="title">Checkout</h1>
   </div>

   <div class="checkout-card mx-auto col-lg-10 col-md-11 col-sm-12" 
        style="background-color:#f8f7f2; color:#4a0d12; padding:40px; border-radius:20px;">

        <div id="checkout-list"></div>

<script>
let checkoutCart = JSON.parse(localStorage.getItem("cart")) || [];

function renderCheckout() {
    const list = document.getElementById("checkout-list");
    list.innerHTML = "";

    checkoutCart.forEach(item => {
        const div = document.createElement("div");
        div.className = "d-flex align-items-center mb-4";
        div.style.gap = "30px";

        div.innerHTML = `
            <img src="${item.image}" class="rounded-circle" style="width:90px; height:90px; object-fit:cover;" />
            <div class="flex-grow-1">
                <h4 style="font-weight:600;">${item.name}</h4>
                <h5 style="font-weight:500; color:#6b1825;">${item.notes || "-"}</h5>
            </div>
            <div style="font-size:22px; font-weight:600; color:#6b1825;">${item.qty} Portion</div>
        `;
        list.appendChild(div);
    });

    const subtotal = checkoutCart.reduce((sum, item) => sum + parseFloat(item.price) * item.qty, 0);
    document.getElementById("subtotal").innerText = 
        new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(subtotal);
}
window.onload = renderCheckout;
</script>

<div class="d-flex justify-content-end align-items-center mt-5 " style="gap:40px;">
    <h3 style="font-weight:600; color:#6b1825;">Subtotal: <span id="subtotal">$0</span></h3>
    
    <form action="checkout_proses.php" method="POST">
        <input type="hidden" name="cart_data" id="cart_data">
        <button type="submit" class="btn btn-checkout">Checkout & Save</button>
    </form>
</div>

<script>
// FIX → id BENAR adalah cart_data
document.getElementById("cart_data").value = JSON.stringify(checkoutCart);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
