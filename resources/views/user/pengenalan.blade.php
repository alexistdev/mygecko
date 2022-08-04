<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengenalan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('usr.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Pengenalan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-header">Tentang Gecko</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-text">APA SIH LEOPARD GECKO???</p>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <img src="{{asset('gambar/GeckoPengenalan.jpg')}}" class="img-rounded" alt="GeckoPengenalan" width="500px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Leopard gecko adalah jenis tokek yang terdapat di pakistan, india, dan iran. Tokek ini adalah binatang hias dan menjadi hewan peliharaan populer karena warna tubuhnya yang indah dan perawatannya yang mudah. Leopard gecko (Eublepharis Macularius) merupakan salah satu jenis tokek terbesar diantara golongannya. Leopard gecko betina berukuran panjang antara 18 hingga 20cm dengan berat badan antara 50 hingga 70 gram, sementara leopard gecko jantan berukuran lebih besar, panjangnya antara 20 hingga 28 cm dengan berat antara 60-80gram. (hal ini berbeda jika gecko mengandung gen Giant / Super Giant)
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <img src="{{asset('gambar/Titit&tempikGecko.jpg')}}" class="img-rounded" alt="Titit&tempikGecko" width="500px">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    Cara Membedakan Gecko Jantan dan betina:<br/>
                                    Gecko jantan (gambar sebelah kanan):<br/>
                                    <ul>
                                        <li>memiliki femoral pores (titik menyerupai huruf V di sekitar pangkal ekor)</li>
                                        <li>memiliki 2 benjolan di pangkal ekor yang dinamakan hemipenis</li>
                                        <li>jika sedang birahi, biasanya ditandai oleh femoral pores yang padat (tidak berlubang)</li>
                                    </ul>

                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <img src="{{asset('gambar/jantanbirahi.jpg')}}" class="img-rounded" alt="jantanbirahi" width="500px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Gecko betina (gambar sebelah kiri):<br/>
                                    <ul>
                                        <li>tidak memiliki femoral pores</li>
                                        <li>tidak memiliki benjolan di pangkal ekor</li>
                                        <li>jika sedang birahi, biasanya ditandai oleh adanya bulatan merah disekitar perut (dinamai dengan Ovulasi)</li>
                                    </ul>

                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <img src="{{asset('gambar/Betinabirahi.jpg')}}" class="img-rounded" alt="jantanbirahi" width="500px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Warna pada tubuh leopard gecko bisa bervariasi mulai dari kuning, kuning kecoklatan, coklat muda, oranye atau kemerahan. Sedangkan bintik-bintiknya biasanya berwarna hitam atau coklat gelap. Perbedaan warna pada masing masing gecko dipengaruhi oleh morph pada leopard gecko itu sendiri. Maka dari itu, “DATA” pada leopard gecko sangatlah penting.
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <img src="{{asset('gambar/Stikerdata.jpeg')}}" class="img-rounded" alt="Stikerdata" width="500px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Leopard gecko tergolong dalam hewan krepuskular (aktif ketika sore dan subuh / ketika remang remang). Tokek jenis ini tidak aktif pada musim dingin. Leopard gecko yang dipelihara biasanya aktif pada saat memerlukan makanan saja dan lebih banyak beristirahat. Gecko adalah hewan insektifora (pemakan serangga) seperti jangkrik, ulat hongkong, ulat jerman, dan kecoa dubia.
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <img src="{{asset('gambar/geckomakan.jpg')}}" class="img-rounded" alt="geckomakan" width="500px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Leopard gecko menjadi hewan yang populer dikalangan pecinta reptil. Perilakunya yang jinak, warna yang cantik, serta perawatan yang mudah, menjadikan tokek ini sebagai salah satu rekomendasi peliharaan untuk pemula. Suhu yang ideal untuk tempat pemeliharaan adalah 28o hingga 35o C. untuk cara pemeliharaan detail yuk kunjungi halaman Cara Perawatan!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <x-admin.js-layout />
</x-admin.template-admin>
