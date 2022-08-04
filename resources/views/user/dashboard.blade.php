<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                                <h5 class="card-header">Selamat Datang</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="card-title">Selamat Datang di dalam Sistem Informasi Pendiagnosa Penyakit Pada Leopard Geckog</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{asset('gambar/GeckoDashboard.jpg')}}" class="img-responsive" alt="gambar gecko" width="50%"/>
                                </div>
                            </div>

                            <p class="card-text">Panduan cara menggunakan sistem informasi ini:</p>
                            <ul>
                                <li>Halaman pengenalan berisi informasi secara umum tentang leopard gecko</li>
                                <li>Halaman cara perawatan berisi cara bagaimana merawat leopard gecko dengan baik dan benar</li>
                                <li>Halaman deteksi penyakit memudahkan kalian dalam mendiagnosa penyakit pada leopard gecko yang kalian miliki dengan cara menjawab beberapa pertanyaan terkait gejala yang timbul pada leopard gecko kalian.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <x-admin.js-layout />
</x-admin.template-admin>
