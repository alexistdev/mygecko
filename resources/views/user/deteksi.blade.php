<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Deteksi Penyakit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('usr.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Deteksi Penyakit</li>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-header">Deteksi Penyakit</h5>
                            </div>
                        </div>

                        <div class="card-body">
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <p>Apakah gecko: Berat badan kurus ?</p>--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">--}}
{{--                                        <label class="form-check-label" for="flexRadioDefault1">--}}
{{--                                           Ya--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>--}}
{{--                                        <label class="form-check-label" for="flexRadioDefault2">--}}
{{--                                            Tidak--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col-md-12">
                                    Dari hasil deteksi maka bisa dipastikan gecko anda berpotensi sakit: <span class="text-danger font-weight-bold">Tumor</span>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <button class="btn btn-danger">Ulangi</button>
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
