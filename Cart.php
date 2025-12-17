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
            background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
            color: white;
            padding: 60px;
            height: auto ;
            max-height: 600vh;
            font-family:'Playfair Display', serif;         
        }
        .menu-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f5f5f5;
            width: 100%;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        .menu-box img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
        }
        .menu-text {
            color: #3f1117;
            font-weight: 800;
            margin-left: 15px;
            flex: 1;
        }
        .menu-notes textarea {
            width: 220px;
            height: 120px;
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            resize: none;
            color: #3f1117;
            margin-right: 25px;
        }
        .plusmin-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #090909;
        }
        .plusmin-btn button {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            background: #3f1117;
            color: white;
            font-size: 18px;
        }
        .btn-checkout {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
            max-width: 250px;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 20px;
            background-color: #8b0000;
            color: white;
            letter-spacing: 2px;
            z-index: 999;
        }
        .btn-checkout:hover {
            background: #b9a29d;
            color: black;
        }
    </style>
<body>
<div class="theme" id="cart-container">
    <h1 class="title">Cart</h1>
    <div id="cart-items"></div>
</div>
<button class="btn btn-checkout" id="checkout">Checkout</button>
<script>
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// masukin ke page cart
function renderCart() {
    const container = document.getElementById("cart-items");
    container.innerHTML = "";

    cart.forEach((item, index) => {
        console.log(item.name, item.price);
        const box = document.createElement("div");
        box.className = "cart-box";

        box.innerHTML = `
            <div class="menu-box">
                <img src="${item.image}" alt="Food Image">
                <div class="menu-text">
                    <h3>${item.name}</h3>
                    <h4>${new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(item.price)}/portion</h4>
                </div>
                <div class="menu-notes">
                    <textarea class="notes" placeholder="Notes...">${item.notes || ""}</textarea>
                </div>
                <div class="plusmin-btn">
                    <button class="minus">-</button>
                    <span class="quantity">${item.qty}</span>
                    <button class="plus">+</button>
                </div>
            </div>
        `;
    container.appendChild(box);

        // buat button plus
        box.querySelector(".plus").addEventListener("click", () => {
            item.qty++;
            updateCart();
        });

        // buat button min
        box.querySelector(".minus").addEventListener("click", () => {
            if (item.qty > 1) {
                item.qty--;
            } else {
                // ngapus item
                cart.splice(index, 1);
            }
            updateCart();
        });
        // update notes
        box.querySelector(".notes").addEventListener("change", (e) => {
            item.notes = e.target.value;
            updateCart();
        });
    });
}
// ngupdate localStorage 
function updateCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
}
renderCart();

document.getElementById("checkout").addEventListener("click", () => {
      window.location.href = "Checkout.php"; 
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
