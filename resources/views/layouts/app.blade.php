<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Productos')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Merriweather', serif;
            margin: 0;
            background: #f7f7f4;
            color: #1f2933;
        }
        header {
            background: #0f172a;
            padding: 1rem 2rem;
            color: white;
        }
        header nav a {
            color: white;
            margin-right: 1rem;
            text-decoration: none;
        }
        main {
            padding: 2rem;
            max-width: 960px;
            margin: 0 auto;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 0.25rem;
        }
        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid #cbd5f5;
            border-radius: 8px;
            padding: 0.65rem 0.75rem;
            font-size: 1rem;
            font-family: inherit;
        }
        textarea {
            min-height: 120px;
        }
        .field + .field {
            margin-top: 1rem;
        }
        .field small {
            color: #b91c1c;
        }
        .description {
            color: #475569;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        pre {
            background: #0f172a;
            color: white;
            padding: 0.75rem;
            border-radius: 12px;
            overflow-x: auto;
        }
        .preview {
            max-width: 320px;
            border-radius: 16px;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
        }
        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
        }
        .status {
            background: #ecfccb;
            border: 1px solid #d9f99d;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            color: #365314;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="{{ route('products.index') }}">Listado</a>
        <a href="{{ route('products.create') }}">Nuevo producto</a>
    </nav>
</header>
<main>
    @if(session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    @yield('content')
</main>
</body>
</html>

