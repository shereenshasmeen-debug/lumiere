<?php
  session_start();
  if (!isset($_SESSION['login'])) {
    header("Location: Login.php");
    exit;
}
?>
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
        .content {
            position: relative;
            z-index: 2;
            max-width: 100%;
            margin-left: 30px;
            margin-top: -60px;
        }
        .title {
            font-size: 55px;
            letter-spacing: 2px;
            font-weight: 700;
            margin-bottom: 20px;
            margin-top: 0px;
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
            width: 170vb;
            height: 20vh;
            background: #f5f5f5;
            position: relative;
            border-radius: 15px;
            margin-top: 15px;
            margin-left: 0px;
        }
        .menu-box img {
            width: 90px;
            height: 90px;
            margin: 15px;
            border-radius: 50%;
            margin-right: 0px;
        }
        .menu-text {
            color: #3f1117;
            font-weight: 800;
            margin-top: 20px;
            margin-left: 10px;
        }
        .plus-btn {
            background: #8b0000;
            color: white;
            border: none;
            width: 60px;
            height: 60px;
            font-size: 28px;
            font-weight: bold;
            border-radius: 50%;
            cursor: pointer;
            margin-right: 10px;
            margin-left: 600px;
            margin-top: 50px;
        }
        .btn-menu {
            padding: 12px 32px;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 18px;
            background-color: #8b0000;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-right: 20px;
            margin-left: 20px;
            transition: 0.3s;
        }
        .btn-menu:hover {
            background: #b9a29d;
            color: black;
        }
        .menu-place {
            display: flex;
            width: 180vb;
            height: 20vh;
            background: #f5f5f5;
            position: relative;
            border-radius: 15px;
            margin-top: 15px;
            margin-left: 0px;
        }
        .search-box {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 6px 8px 6px 14px;
            margin-left: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.35);
            border-radius: 20px;
            width: 270px;
        }
        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            width: 220px;
            font-family: "Playfair Display", serif;
            font-size: 14px;
            color: black;
        }
        .search-box button {
            border: none;
            background: #8b0000;
            color: #fff;
            padding: 8px 18px;
            margin-left: 5px;
            border-radius: 18px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .search-box button:hover {
            background: #3f1117;
            transform: scale(1.05);
        }
    </style>
<body>
<div class="theme">
    <div class="content">
        <h1 class="title">Menu</h1>
            <button class="btn btn-menu" onclick="showSection('main')">Main Course</button>
            <button class="btn btn-menu" onclick="showSection('bev')">Beverage</button>
            <button class="btn btn-menu" onclick="showSection('dess')">Dessert</button>
            <form class="search-box" onsubmit="return false;">
                <input type="text" id="searchInput" placeholder="Search menu...">
                <button type="button">Search</button>
            </form>
            <button class="btn btn-menu" id="next">Next</button>

        <div id="main" class="menu-section">  
            <div class="menu-box" data-price="90">
                <img src="img/PAN SEARED SALMON.png">
                <div class="menu-text">
                    <h3>PAN SEARED SALMON</h3>
                    <p>Tender salmon with a crisp golden sear, lightly seasoned to highlight its natural flavor.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 394px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="80">
                <img src="img/ABURI CHEESY FRIES.png">
                <div class="menu-text">
                    <h3>ABURI CHEESY FRIES</h3>
                    <p>Crispy fries topped with melted, flame-torched cheese for a creamy and smoky finish.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 398px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="80">
                <img src="img/BATTERED FISH N CHIPS.png">
                <div class="menu-text">
                    <h3>BATTERED FISH & CHIPS</h3>
                    <p>Crispy battered fish with thick-cut fries, offering a classic, comforting coastal flavor.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 404px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="95">
                <img src="img/BEEF WELLINGTON.png">
                <div class="menu-text">
                    <h3>BEEF WELLINGTON</h3>
                    <p>Premium beef wrapped in mushroom duxelles and flaky pastry, an elegant fine-dining classic.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 330px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="100">
                <img src="img/LOBSTER THERMIDOR.png">
                <div class="menu-text">
                    <h3>LOBSTER THERMIDOR</h3>
                    <p>Baked lobster in a rich creamy-buttery sauce with a golden, aromatic topping.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 450px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="88">
                <img src="img/BLACK COD WITH MISO GLAZE.png">
                <div class="menu-text">
                    <h3>BLACK COD WITH MISO GLAZE</h3>
                    <p>Silky cod marinated in sweet miso, perfectly tender with a savory-sweet balance.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 428px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="97">
                <img src="img/BLACK TRUFFLE PASTA.png">
                <div class="menu-text">
                    <h3>BLACK TRUFFLE PASTA</h3>
                    <p>Al dente pasta coated in a fragrant truffle cream sauce, rich and earthy.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 498px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="90">
                <img src="img/CHATEAUBRIAND.png">
                <div class="menu-text">
                    <h3>CHATEAUBRIAND</h3>
                    <p>A thick, tender cut of beef roasted to perfection and often served with rich sauces.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 424px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="88">
                <img src="img/CHICKEN PARMIGIANA.png">
                <div class="menu-text">
                    <h3>CHICKEN PARMIGIANA</h3>
                    <p>Crispy breaded chicken topped with tomato sauce and melted cheese, baked until bubbly.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 370px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="80">
                <img src="img/MAC AND CHEESE.png">
                <div class="menu-text">
                    <h3>MAC & CHEESE</h3>
                    <p>Creamy pasta covered in rich melted cheese; warm, simple, and comforting.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 470px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="83">
                <img src="img/SALAMI PIZZA.png">
                <div class="menu-text">
                    <h3>SALAMI PIZZA</h3>
                    <p>Thin-crust pizza topped with savory, smoky salami slices.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 600px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="105">
                <img src="img/KING CRAB LEGS WITH GARLIC BUTTER.png">
                <div class="menu-text">
                    <h3>KING CRAB LEGS WITH GARLIC BUTTER</h3>
                    <p>Sweet, tender crab legs served with warm, rich garlic butter.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 500px;">+</button>
                </div>
            </div>
        </div>

        <div id="bev" class="menu-section" style="display:none;">
            <div class="menu-box" data-price="35">
                <img src="img/AMERICANO.png">
                <div class="menu-text">
                    <h3>AMERICANO</h3>
                    <p>Light-bodied and aromatic—V60 brew with the boldness of an Americano.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 480px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="50">
                <img src="img/HONEY CINNAMON LATTE.png">
                <div class="menu-text">
                    <h3>HONEY CINNAMON LATTE</h3>
                    <p>Double ristretto, honey cinnamon, cream & milk.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 658px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="45">
                <img src="img/MATCHA.png">
                <div class="menu-text">
                    <h3>MATCHA LATTE</h3>
                    <p>Crafted with ceremonial-grade matcha and microfoamed milk for a rich, mellow, and sophisticated sip.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 260px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="30">
                <img src="img/EQUIL SPARKLING WATER.png">
                <div class="menu-text">
                    <h3>EQUIL SPARKLING WATER</h3>
                    <p>Crisp, refreshing sparkling water with clean mineral notes.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 583px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="35">
                <img src="img/ICE LEMON TEA.png">
                <div class="menu-text">
                    <h3>ICE LEMON TEA</h3>
                    <p>Chilled black tea with fresh lemon, zesty and lightly sweet.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 585px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="40">
                <img src="img/ICE LYCHEE TEA.png">
                <div class="menu-text">
                    <h3>ICE LYCHEE TEA</h3>
                    <p>Refreshing tea infused with sweet, tropical lychee essence.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 583px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="50">
                <img src="img/FLOWER TEA LEMONADE.png">
                <div class="menu-text">
                    <h3>FLOWER TEA LEMONADE</h3>
                    <p>Floral tea blended with bright lemonade for a delicate, vibrant drink.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 505px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="45">
                <img src="img/SUMMER HYDRA.png">
                <div class="menu-text">
                    <h3>SUMMER HYDRA</h3>
                    <p>A cooling, fruity drink with fresh, hydrating flavors.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 623px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="55">
                <img src="img/ROOT BEER CLOUD.png">
                <div class="menu-text">
                    <h3>ROOT BEER CLOUD</h3>
                    <p>Classic root beer topped with creamy foam for a sweet, nostalgic twist.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 488px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="60">
                <img src="img/STRAWBERRY NUT FRAPPE.png">
                <div class="menu-text">
                    <h3>STRAWBERRY NUT FRAPPE</h3>
                    <p>A thick, creamy frappe combining sweet strawberry and nutty flavors.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 500px;">+</button>
                </div>
            </div>
        </div>

        <div id="dess" class="menu-section" style="display: none">  
            <div class="menu-box" data-price="60">
                <img src="img/BLUEBERRY TOAST.png">
                <div class="menu-text">
                    <h3>BLUEBERRY TOAST</h3>
                    <p>Thick toast topped with sweet blueberry compote; crisp, soft, and flavorful.</p>
                </div>
                <div>
                    <button class="plus-btn"style="margin-left: 475px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="75">
                <img src="img/BURNT MELTED CHEESE.png">
                <div class="menu-text">
                    <h3>BURNT MELTED CHEESE</h3>
                    <p>Caramelized melted cheese that’s smoky, creamy, and deeply savory.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 520px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="65">
                <img src="img/CANNED TIRAMISU.png">
                <div class="menu-text">
                    <h3>CANNED TIRAMISU</h3>
                    <p>Classic tiramisu in a jar with espresso-soaked layers and smooth mascarpone.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 448px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="70">
                <img src="img/CHEESE CUSTARD PUFF .png">
                <div class="menu-text">
                    <h3>CHEESE CUSTARD PUFF</h3>
                    <p>Flaky pastry filled with light, creamy cheese custard.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 635px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="65">
                <img src="img/CREPES SUZETTE.png">
                <div class="menu-text">
                    <h3>CREPES SUZETTE</h3>
                    <p>Delicate French crêpes served with a bright, citrusy caramelized sauce.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 500px;">+</button>
                </div>
            </div>
             <div class="menu-box" data-price="60">
                <img src="img/CROFFLES.png">
                <div class="menu-text">
                    <h3>CROFFLES</h3>
                    <p>Crispy, buttery croissant-pressed waffles with flaky layers.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 585px;">+</button>
                </div>
            </div>
             <div class="menu-box" data-price="55">
                <img src="img/FROZEN HAUTE CHOCOLATE SUNDAE.png">
                <div class="menu-text">
                    <h3>FROZEN HAUTE CHOCOLATE SUNDAE</h3>
                    <p>A rich, icy chocolate sundae with deep, velvety cocoa flavor.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 515px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="60">
                <img src="img/HAUTE COUTURE MACARONS.png">
                <div class="menu-text">
                    <h3>HAUTE COUTURE MACARONS</h3>
                    <p>Elegant almond macarons filled with premium creams.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 610px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="70">
                <img src="img/LOTUS BISCOFF CHEESECAKE.png">
                <div class="menu-text">
                    <h3>LOTUS BISCOFF CHEESECAKE</h3>
                    <p>Creamy cheesecake with spiced Biscoff crumbs and warm caramel notes.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 480px;">+</button>
                </div>
            </div>
            <div class="menu-box" data-price="70">
                <img src="img/LOTUS GUILTY.png">
                <div class="menu-text">
                    <h3>LOTUS GUILTY</h3>
                    <p>A rich, indulgent Lotus dessert with bold caramel-spice flavors.</p>
                </div>
                <div>
                    <button class="plus-btn" style="margin-left: 545px;">+</button>
                </div>
            </div>         
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
   // buat milih main, bev ato dess 
  function showSection(id) {
    document.querySelectorAll('.menu-section').forEach(section => {
      section.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';
  }

  // buat search menu
    const searchInput = document.getElementById("searchInput");
    const menus = document.querySelectorAll(".menu-box");

    searchInput.addEventListener("keyup", function () {
        const keyword = this.value.toLowerCase();

        menus.forEach(menu => {
            const title = menu.querySelector("h3").innerText.toLowerCase();

            if (title.includes(keyword)) {
                menu.style.display = "flex";
            } else {
                menu.style.display = "none";
            }
        });
    });

  // buat plus button
  document.querySelectorAll('.menu-box').forEach(menu => {
    const btn = menu.querySelector('.plus-btn');
    const name = menu.querySelector("h3").innerText;
    const price = Number(menu.dataset.price);
    const image = menu.querySelector("img").src;

    btn.addEventListener("click", () => {

        // Selalu ambil data terbaru
        let cartData = JSON.parse(localStorage.getItem("cart")) || [];

        // Cek apakah menu ini sudah ada di cart
        let found = cartData.find(item => item.name === name);

        if (found) {
            found.qty += 1;  
        } else {
            cartData.push({
                name: name,
                qty: 1,
                price: price,
                image: image
            });
        }

        // Update angka di dalam tombol
        btn.textContent = found ? found.qty : 1;

        // Simpan kembali ke localStorage
        localStorage.setItem("cart", JSON.stringify(cartData));
    });
});


  // masukin button ke cart
  document.getElementById("next").addEventListener("click", () => {
      window.location.href = "Cart.php"; 
  });
</script>

</body>
</html>