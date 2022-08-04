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
                        <li class="breadcrumb-item active">Dashboard v1</li>
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
                        <h5 class="card-header">Selamat Datang</h5>
                        <div class="card-body">
                            <h5 class="card-title">MyGecko v.1 adalah aplikasi untuk mendeteksi penyakit Gecko dengan Forward Chaining</h5>
                            <p class="card-text">Pada halaman administrator ini, berisi data master dari gejala penyakit , jenis penyakit dan basis data pengguna.</p>
                            <p>Dikembangkan oleh Anugerah Resky</p>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <x-admin.js-layout />
</x-admin.template-admin>
