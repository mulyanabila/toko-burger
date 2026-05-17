<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Burger</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="brand">

        <div class="brand-icon">
            🍔
        </div>

        <div class="brand-text">
            <h1>BURGER KINGDOM</h1>
            <p>Premium Burgers</p>
        </div>

    </div>

   <div class="profile-dropdown">

    <button type="button" class="profile-btn" id="profileBtn">

        <div class="profile-circle">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>

        <span>
            {{ Auth::user()->name }}
        </span>

    </button>

    <div class="dropdown-menu" id="dropdownMenu">

        <a href="/logout" class="logout-link">
            Logout
        </a>

    </div>

</div>

</div>

<!-- HERO -->

<section class="hero">

    <div class="hero-left">

        <h1>Burger Hari Ini!</h1>

        <p>
            Pesan sekarang dan rasakan kenikmatan burger premium!
        </p>

        <div class="hero-tags">
            <span>Fresh Beef</span>
            <span>Premium Cheese</span>
            <span>Fresh Veggies</span>
        </div>

    </div>

    <div class="hero-image">
        🍔
    </div>

</section>

<!-- MENU -->

<section class="products">

    @foreach($products as $p)

    <div class="product-card">

        <img src="{{ asset($p->image) }}">

        <div class="product-info">

            <h2>{{ $p->name }}</h2>

            <p>
                {{ $p->description }}
            </p>

            <div class="product-bottom">

                <div class="price">
                    Rp {{ number_format($p->price,0,',','.') }}
                </div>

                <!-- BUTTON OPEN MODAL -->

                <button
                    type="button"
                    class="add-btn openModal"

                    data-id="{{ $p->id }}"
                    data-name="{{ $p->name }}"
                    data-desc="{{ $p->description }}"
                    data-price="Rp {{ number_format($p->price,0,',','.') }}"
                    data-image="{{ asset($p->image) }}"
                >
                    +
                </button>

            </div>
        <!-- CRUD BUTTON -->

            <div class="admin-action">

                <a href="/admin/products/edit/{{ $p->id }}"
                    class="edit-btn">
                    Edit
                </a>

                <a href="/admin/products/delete/{{ $p->id }}"
                 class="delete-btn">
                        Delete
                </a>

        </div>


        </div>

    </div>

    @endforeach

</section>

                <button type="submit" class="checkout-btn">
                    Add To Cart
                </button>

            </form>

        </div>

    </div>

</div>


</script>

</body>
</html>