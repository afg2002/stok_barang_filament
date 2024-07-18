<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadaan Barang App - Solusi Pengadaan Terdepan</title>
    <script src="{{asset('/js/tailwind.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold text-gray-800">Pengadaan Barang App</div>
                <div class="hidden md:flex space-x-4">
                    <a href="#fitur" class="text-gray-800 hover:text-green-600">Fitur</a>
                    <a href="#tentang" class="text-gray-800 hover:text-green-600">Tentang</a>
                    <a href="#kontak" class="text-gray-800 hover:text-green-600">Kontak</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="bg-green-600 text-white py-20">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl font-bold mb-4">Selamat Datang di Pengadaan Barang App</h1>
                <p class="text-xl mb-8">Solusi Pengadaan Barang Terdepan untuk Efisiensi Bisnis Anda</p>
                <a href="http://127.0.0.1:8000/admin" class="bg-white text-green-600 py-2 px-6 rounded-full text-lg font-semibold hover:bg-gray-100 transition duration-300">Masuk Aplikasi</a>
            </div>
        </section>

        <section id="fitur" class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Fitur Utama</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <i class="fas fa-boxes text-4xl text-green-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Manajemen Barang</h3>
                        <p class="text-gray-600">Kelola stok barang Anda dengan mudah dan efisien.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <i class="fas fa-user-tie text-4xl text-green-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Manajemen Supplier</h3>
                        <p class="text-gray-600">Kelola data supplier dan lakukan pembelian dengan mudah.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <i class="fas fa-file-export text-4xl text-green-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Export</h3>
                        <p class="text-gray-600">Export data barang dan supplier untuk analisis lebih lanjut.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang" class="bg-gray-200 py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Tentang Kami</h2>
                <p class="text-gray-600 text-center max-w-2xl mx-auto">Pengadaan Barang App adalah solusi manajemen pengadaan terdepan yang dirancang untuk membantu perusahaan mengoptimalkan proses pengadaan mereka. Dengan fitur-fitur canggih dan antarmuka yang intuitif, kami berkomitmen untuk meningkatkan efisiensi dan transparansi dalam setiap tahap pengadaan.</p>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2024 Pengadaan Barang App. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
