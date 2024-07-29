<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Supermarket</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header styles */
        header {
            background-color: #d88510;
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        header .logo {
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        header .logo img {
            padding-right: 1rem;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        nav ul li a:hover {
            background-color: white;
            color: #d88510;
        }

        /* Hero section styles */
        .hero {
            position: relative;
            text-align: center;
            color: white;
            background-color: #f8f4f0;
            padding: 2rem 0;
        }

        .hero img {
            width: 50%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
        }

        .shop-now {
            padding: 0.7rem 1.5rem;
            background-color: #d88510;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .shop-now:hover {
            background-color: #c67500;
            transform: scale(1.05);
        }

        /* Categories and Products section */
        .categories,
        .products {
            padding: 2rem;
            text-align: center;
        }

        .categories h2,
        .products h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .category-list {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .category-item {
            background-color: #d88510;
            padding: 1rem;
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 20px;
            transition: background-color 0.3s, transform 0.3s;
            width: 200px;
            color: white;
            /* Adjust width as needed */
        }

        .category-item:hover {
            background-color: #c67500;
            transform: scale(1.05);
        }

        .product-carousel {
            display: flex;
            overflow-x: auto;
            gap: 1rem;
            padding-bottom: 1rem;
        }

        .product-item {
            background-color: #d88510;
            border: 1px solid #ddd;
            padding: 1rem;
            width: 200px;
            /* Set the width of the product item */
            text-align: center;
            border-radius: 20px;
            transition: transform 0.3s;
            margin-bottom: 1rem;
        }

        .product-item:hover {
            transform: scale(1.05);
        }

        .product-item img {
            width: 100%;
            height: auto;
            max-height: 150px;
            /* Adjust the maximum height of the image */
            object-fit: cover;
            border-radius: 10px;
        }

        .product-item p {
            color: white;
            font-weight: bold;
        }

        .shop {
            border-radius: 10px;
            border: none;
            height: 30px;
            width: 100px;
            background-color: #c67500;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .shop:hover {
            background-color: #d88510;
        }

        /* Footer styles */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }

        footer .contact-info {
            margin-bottom: 1rem;
        }

        footer .contact-info p {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a img {
            vertical-align: middle;
            margin-left: 0.5rem;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .shop-now {
                padding: 0.5rem 1rem;
            }

            .categories h2,
            .products h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            nav ul {
                flex-direction: column;
                align-items: center;
            }

            .hero h1 {
                font-size: 1.5rem;
            }

            .shop-now {
                padding: 0.5rem;
            }

            .categories h2,
            .products h2 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="{{ asset('svg/shario.png') }}" alt="Icon"> MINI MARKET ALHAY
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#categories">Categories</a></li>
                <li><a href="#location">Location</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <img src="{{ asset('pictures/pic.png') }}" alt="Supermarket Image" />
            <div class="hero-text">
                <button class="shop-now" id="shop-now" data-scroll-target="#categories">Shop Now</button>
            </div>
        </section>

        <section class="categories" id="categories">
            <h2>Categories</h2>
            <div class="category-list">
                @foreach ($categories as $category)
                    <div class="category-item" data-category="{{ $category->slug }}">{{ $category->name }}</div>
                @endforeach
            </div>
        </section>

        @foreach ($categories as $category)
            <section class="products" id="{{ $category->slug }}">
                <h2>{{ $category->name }}</h2>
                <div class="product-carousel">
                    @foreach ($category->products as $product)
                        <div class="product-item">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" />
                            <p>{{ $product->name }}</p>
                            <p>{{ $product->price }} L.L</p>
                            <button class="shop" data-whatsapp="https://wa.me/1234567890">Shop</button>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

    </main>

    <footer id="location">
        <div class="contact-info">
            <p>
                Location 1: 123 Main St. | Phone:
                <a href="https://wa.me/1234567890">123-456-7890
                    <img src="{{ asset('svg/whatsapp.svg') }}" alt="WhatsApp" /></a>
            </p>
            <p>
                Location 2: 456 Another St. | Phone:
                <a href="https://wa.me/0987654321">098-765-4321
                    <img src="{{ asset('svg/whatsapp.svg') }}" alt="WhatsApp" /></a>
            </p>
        </div>
        <p>Created by <a href="https://wa.me/+96171510381">Hussein Chalhoub</a>
            <a href="https://wa.me/+96171510381" target="_blank">
                <img src="{{ asset('svg/whatsapp.svg') }}" alt="WhatsApp">
            </a>
        </p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categoryItems = document.querySelectorAll('.category-item');
            const categoriesLink = document.querySelector('a[href="#categories"]');
            const locationLink = document.querySelector('a[href="#location"]');
            const shopButtons = document.querySelectorAll('.shop');
            const shopNowButton = document.querySelector('.shop-now');

            categoryItems.forEach(item => {
                item.addEventListener('click', () => {
                    const categorySlug = item.getAttribute('data-category');
                    const categorySection = document.getElementById(categorySlug);

                    if (categorySection) {
                        categorySection.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            if (categoriesLink) {
                categoriesLink.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent default link behavior
                    const targetElement = document.getElementById('categories');
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            }

            if (locationLink) {
                locationLink.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent default link behavior
                    const targetElement = document.getElementById('location');
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            }

            shopButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const whatsappLink = button.getAttribute('data-whatsapp');
                    window.location.href = whatsappLink;
                });
            });

            if (shopNowButton) {
                shopNowButton.addEventListener('click', () => {
                    const scrollTarget = shopNowButton.getAttribute('data-scroll-target');
                    const targetElement = document.querySelector(scrollTarget);
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            }
        });
    </script>
</body>

</html>