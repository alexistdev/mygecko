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
                            @if($selesai == 1)

                                <form action="{{route('user.deteksi.save')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if($errors->tambah->has('basis_id'))
                                                <span
                                                    class="text-danger errorMessage">{{$errors->tambah->first('basis_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Apakah gecko: {{$dataGejala->gejala->name}} ?</p>
                                            <input type="hidden" name="basis_id" value="{{$dataGejala->id}}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jawaban" value="1"
                                                       id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jawaban" value="2"
                                                       id="flexRadioDefault2" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Tidak
                                                </label>
                                            </div>
                                            @if($errors->tambah->has('jawaban'))
                                                <span
                                                    class="text-danger errorMessage">{{$errors->tambah->first('jawaban')}}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                                        </div>
                                    </div>

                                </form>
                            @elseif($selesai == 2)
                                <div class="row">
                                    <div class="col-md-12">
                                        Dari hasil deteksi maka bisa dipastikan gecko anda berpotensi sakit: <span
                                            class="text-danger font-weight-bold">{{$solusi}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Jawaban anda:<br/>
                                        <ul>
                                            @foreach($jawaban as $row)
                                                <li>{{$row->basis->gejala->name}} =
                                                    @if($row->jawaban ==1)
                                                        YA
                                                    @else
                                                        TIDAK
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <button class="btn btn-danger">Ulangi</button>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        Dari hasil deteksi dengan mengungkap fakta yang ada = Maka Gecko anda Baik2 saja
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <button class="btn btn-danger">Ulangi</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <x-admin.js-layout/>
</x-admin.template-admin>
