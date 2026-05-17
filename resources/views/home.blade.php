<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Burger Kingdom</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        BURGER KINGDOM
    </div>

    <ul>
        <li class="active">
            <a href="/menu">Menu</a>
        </li>

            <li>
            <a href="/cart">Cart</a>
        </li>

        <li>
            <a href="/orders">Orders</a>
        </li>

        <li>
            <a href="/about">About</a>
        </li>
    </ul>

    <div class="profile-container">

    <button class="profile-btn" onclick="toggleMenu()">
        {{ Auth::user()->name }}
    </button>

    <div class="profile-menu" id="profileMenu">

        <a href="/logout">
            Logout
        </a>

    </div>

</div>

</nav>


<!-- HERO -->

<section class="hero">

    <div class="hero-text">

        <h1>Menu Burger Hari Ini!</h1>

        <p>
            Pesan sekarang dan rasakan kenikmatan burger premium!
        </p>

        <div class="tags">
            <span>Fresh Beef</span>
            <span>Premium Cheese</span>
            <span>Fresh Veggies</span>
        </div>

    </div>

</section>

<!-- PRODUCTS -->

<section class="products">

    @foreach($products as $p)

    <div class="card">

        <img src="{{ asset('images/' . $p->image) }}">

        <h2>{{ $p->name }}</h2>

        <p class="desc">
            {{ $p->description }}
        </p>

        <p>
            Rp {{ number_format($p->price) }}
        </p>

        <!-- BUTTON BUKA POPUP -->
    <button
    onclick="openModal(
        {{ $p->id }},
        '{{ asset('images/' . $p->image) }}',
        '{{ $p->name }}',
        '{{ $p->description }}',
        {{ $p->price }}
    )"
>
    Add To Cart
</button>

    </div>

    @endforeach

    <!-- MODAL -->

<div id="popup" class="popup">

    <div class="popup-content">

        <span class="close" onclick="closeModal()">×</span>
        
        <img id="popupImage" class="popup-img">

        <p class="desc" id="popupDesc"></p>

        <h3 id="popupPrice"></h3>

        <h2 id="popupTitle"></h2>
        <form id="cartForm" method="POST">

            @csrf

            <!-- OPTIONS -->
    <div class="options">

    <label class="option-btn">
        <input type="checkbox"
       name="telur"
       class="extra"
       value="5000">
        <span>Tambah Telur +5.000</span>
    </label>

    <label class="option-btn">
        <input type="checkbox"
       name="keju"
       class="extra"
       value="4000">
        <span>Tambah Keju +4.000</span>
    </label>

    <label class="option-btn">
        <input type="checkbox"
       name="double_telur"
       class="extra"
       value="10000">
        <span>Double Telur +10.000</span>
    </label>

    <label class="option-btn">
        <input type="checkbox"
       name="double_keju"
       class="extra"
       value="6000">
        <span>Double Keju +6.000</span>
    </label>

    <label class="option-btn">
       <input type="checkbox"
       name="double_cheese"
       class="extra"
       value="12000">
        <span>Double Cheese +12.000</span>
    </label>

    <label class="option-btn">
        <input type="checkbox"
       name="extra_saus"
       class="extra"
       value="2000">
        <span>Extra Saus +2.000</span>
    </label>

    <label class="option-btn">
        <input type="checkbox"
       name="tanpa_sayur"
       class="extra"
       value="-2000">
        <span>Tanpa Sayur -2.000</span>
    </label>

    <label class="option-btn">
        <input type="checkbox"
       name="tanpa_tomat"
       class="extra"
       value="-1000">
        <span>Tanpa Tomat -1.000</span>
    </label>

    <label class="option-btn">
        <input type="checkbox"
       name="tanpa_saus"
       class="extra"
       value="-1000">
        <span>Tanpa Saus -1.000</span>
    </label>

</div>

        <!-- CATATAN -->
        <textarea
            name="note"
            class="note-input"
            placeholder="Tambahkan catatan pesanan...">
        </textarea>

        <!-- QUANTITY -->
        <input type="hidden"
            name="quantity"
            id="quantityInput"
            value="1">

    <!-- QTY + BUTTON -->
   <div class="bottom-action">

    <div class="qty">

        <button type="button" onclick="minusQty()">-</button>

        <span id="qty">1</span>

        <button type="button" onclick="plusQty()">+</button>

    </div>

    <button type="submit" class="add-btn" id="totalBtn">
        Tambah Rp 30.000
    </button>

    </div>

</form>

        </div>

</div>

</section>

<script>

let basePrice = 0;
let qty = 1;

function openModal(id, image, name, description, price)
{
    document.getElementById('popup').style.display = 'flex';

    document.getElementById('cartForm').action =
    '/cart/' + id;

    // gambar
    document.getElementById('popupImage').src = image;

    // nama
    document.getElementById('popupTitle').innerText = name
    
    // deskripsi
    document.getElementById('popupDesc').innerText = description;

    // harga awal
    document.getElementById('popupPrice').innerText =
    'Rp ' + price.toLocaleString('id-ID');

    // harga dasar sesuai menu
    basePrice = price;

    // reset qty
    qty = 1;
    document.getElementById('qty').innerText = qty;

    // reset checkbox
    document.querySelectorAll('.extra').forEach(cb => {
        cb.checked = false;
    });

    updatePrice();
}

function closeModal()
{
    document.getElementById('popup').style.display = 'none';
}

const checkboxes =
document.querySelectorAll('.extra');

checkboxes.forEach(cb => {

    cb.addEventListener('change', updatePrice);

});

function plusQty()
{
    qty++;

    document.getElementById('qty').innerText = qty;
    document.getElementById('quantityInput').value = qty;
    updatePrice();
}

function minusQty()
{
    if(qty > 1)
    {
        qty--;

        document.getElementById('qty').innerText = qty;

        updatePrice();
    }
}

function updatePrice()
{
    let total = basePrice;

    checkboxes.forEach(cb => {

        if(cb.checked)
        {
            total += parseInt(cb.value);
        }

    });

    total = total * qty;

    document.getElementById('totalBtn').innerText =
    'Tambah Rp ' + total.toLocaleString('id-ID');
}

</script>

<script>

function toggleMenu()
{
    const menu =
    document.getElementById('profileMenu');

    if(menu.style.display === 'block')
    {
        menu.style.display = 'none';
    }
    else
    {
        menu.style.display = 'block';
    }
}

</script>
</body>
</html>