<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        /* Admin page styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #d88510;
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        header nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 1rem;
        }

        header nav ul li {
            position: relative;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        header nav ul li a:hover {
            background-color: white;
            color: #d88510;
        }

        main {
            padding: 2rem;
        }

        .admin-section {
            margin-bottom: 2rem;
        }

        .admin-section h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .admin-section button {
            padding: 0.7rem 1.5rem;
            background-color: #f39c12;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .admin-section button:hover {
            background-color: #d88510;
            transform: scale(1.05);
        }

        .admin-section table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .admin-section table,
        .admin-section th,
        .admin-section td {
            border: 1px solid #ddd;
        }

        .admin-section th,
        .admin-section td {
            padding: 1rem;
            text-align: left;
        }

        .admin-section form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .admin-section form label {
            font-weight: bold;
        }

        .admin-section form input,
        .admin-section form select {
            padding: 0.7rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Admin Dashboard</div>
    </header>
    <main>
        <!-- Categories Section -->
        <div class="admin-section">
            <h2>Categories</h2>
            <button onclick="document.getElementById('add-category-form').style.display='block'">Add Category</button>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <button
                                    onclick="document.getElementById('edit-category-{{ $category->id }}').style.display='block'">Edit</button>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Category Form -->
                        <div id="edit-category-{{ $category->id }}" style="display:none;">
                            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="name">Category Name:</label>
                                <input type="text" name="name" value="{{ $category->name }}" required>
                                <button type="submit">Update Category</button>
                                <button type="button"
                                    onclick="document.getElementById('edit-category-{{ $category->id }}').style.display='none'">Cancel</button>
                            </form>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <!-- Add Category Form -->
            <div id="add-category-form" style="display:none;">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <label for="name">Category Name:</label>
                    <input type="text" name="name" required>
                    <button type="submit">Add Category</button>
                    <button type="button"
                        onclick="document.getElementById('add-category-form').style.display='none'">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Products Section -->
        <!-- Products Section -->
        <div class="admin-section">
            <h2>Products</h2>
            <button onclick="document.getElementById('add-product-form').style.display='block'">Add Product</button>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        @foreach ($category->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $category->name }}</td>
                                <td>${{ $product->price }}</td>
                                <td><img src="{{ $product->image }}" alt="{{ $product->name }}" width="50"></td>
                                <td>
                                    <button
                                        onclick="document.getElementById('edit-product-{{ $product->id }}').style.display='block'">Edit</button>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Edit Product Form -->
                            <div id="edit-product-{{ $product->id }}" style="display:none;">
                                <form action="{{ route('admin.products.update', $product) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="name">Product Name:</label>
                                    <input type="text" name="name" value="{{ $product->name }}" required>
                                    <label for="category_id">Category:</label>
                                    <select name="category_id" required>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="price">Price:</label>
                                    <input type="number" name="price" value="{{ $product->price }}" required>
                                    <label for="image">Product Image URL:</label>
                                    <input type="text" name="image" value="{{ $product->image }}" required>
                                    <button type="submit">Update Product</button>
                                    <button type="button"
                                        onclick="document.getElementById('edit-product-{{ $product->id }}').style.display='none'">Cancel</button>
                                </form>
                            </div>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <!-- Add Product Form -->
            <div id="add-product-form" style="display:none;">
                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf
                    <label for="name">Product Name:</label>
                    <input type="text" name="name" required>
                    <label for="category_id">Category:</label>
                    <select name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="price">Price:</label>
                    <input type="number" name="price" required>
                    <label for="image">Product Image URL:</label>
                    <input type="text" name="image" required>
                    <button type="submit">Add Product</button>
                    <button type="button"
                        onclick="document.getElementById('add-product-form').style.display='none'">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Offers Section -->
        <div class="admin-section">
            <h2>Offers</h2>
            <button onclick="document.getElementById('add-offer-form').style.display='block'">Add Offer</button>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                        <tr>
                            <td>{{ $offer->name }}</td>
                            <td>${{ $offer->price }}</td>
                            <td><img src="{{ $offer->image }}" alt="{{ $offer->name }}" width="50"></td>
                            <td>
                                <form action="{{ route('admin.offers.destroy', $offer) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Add Offer Form -->
            <div id="add-offer-form" style="display:none;">
                <form action="{{ route('admin.offers.store') }}" method="POST">
                    @csrf
                    <label for="name">Offer Name:</label>
                    <input type="text" name="name" required>
                    <label for="price">Price:</label>
                    <input type="number" name="price" required>
                    <label for="image">Offer Image URL:</label>
                    <input type="text" name="image" required>
                    <button type="submit">Add Offer</button>
                    <button type="button"
                        onclick="document.getElementById('add-offer-form').style.display='none'">Cancel</button>
                </form>
            </div>
        </div>

    </main>
</body>

</html>