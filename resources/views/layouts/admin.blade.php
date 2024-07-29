<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #343a40;
            color: white;
            padding: 1rem;
        }

        header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        header nav ul li {
            margin-right: 1rem;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Admin container */
        .admin-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
        }

        /* Form styles */
        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        form label {
            margin-bottom: 0.5rem;
        }

        form input[type="text"],
        form input[type="number"],
        form select {
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 3px;
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 3px;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        /* Section styles */
        .admin-section {
            margin-top: 2rem;
            width: 100%;
            max-width: 600px;
            background-color: white;
            padding: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .admin-section h2 {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .admin-section ul {
            list-style: none;
            padding: 0;
        }

        .admin-section li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .admin-section button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 3px;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .admin-section button:hover {
            background-color: #218838;
        }

        .admin-section form {
            margin-bottom: 0;
        }

        /* Media queries */
        @media (max-width: 768px) {
            .admin-container {
                padding: 1rem;
            }

            form {
                width: 100%;
            }

            .admin-section {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('admin.index') }}">Admin</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>