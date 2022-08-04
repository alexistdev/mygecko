<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Morph</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('usr.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Morph</li>
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
                                <h5 class="card-header">Tentang Morph</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-text">Sebelum mengenal lebih jauh mengenai Morph pada leopard gecko ada baiknya pelajari terlebih dahulu istilah yang biasa di gunakan dalam menggambarkan genetik dalam leopard gecko. Berikut adalah daftar istilah yang biasa digunakan dalam genetik leopard gecko:<br/>
                                        <ol>
                                        <li>Het : Heterozigouz (individu yang mengandung gen resesif yang tidak sama). Leopard gecko yang memiliki Het dalam gennya yang di kawinkan dengan leopard gecko yang memiliki het dalam gennya akan memiliki peluang menghasilkan resesif pure</li>
                                        <li>Ph (Possible het) : Possible Heterozigouz. Artinya leopard tersebut memiliki kemungkinan membawa gen Het.</li>
                                    </ol>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    Ada 4 genetik dasar yang familiar di leopard gecko. Setiiap gen tersebut memiliki perhitungan genetiknya masing-masing. Berikut akan di ulas keseluruhan genetik dasar pada Leopard gecko:
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    1.Dominan<br/>
                                    Dasar perhitungan genetik:
                                    <ul>
                                        <li>Normal X Normal = Normal</li>
                                    </ul>
                                    <br/>
                                    Contoh morph dominan gecko:
                                    <ul>
                                        <li>Normal</li>
                                        <li>Enigma</li>
                                        <li>TUG Snow</li>
                                        <li>White and Yellow</li>
                                    </ul>

                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    2. Co-Dominan/Incomplete Dominan<br/>
                                    Dasar perhitungan genetik:
                                    <ul>
                                        <li>Normal X Co-Dominan = 50% normal, 50% Co-Dominan</li>
                                        <li>Co-Dominan X Co-Dominan = 25% normal, 50% Co-dominan, 25% super Co-Dominan</li>
                                        <li>Super Co-Dominan = 100% super Co-Dominan</li>
                                    </ul>
                                    Note= Dominan dan Co-Dominan mirip sifatnya, kecuali bentuk super-form
                                    <br/>
                                    Contoh morph Co-Dominan gecko:
                                    <ul>
                                        <li>Macksnow</li>
                                        <li>Giant</li>
                                        <li>Lemon frost (pada genetik ini terdapat pengecualian. Tidak ada morph super lemonfrost karena super-form dari lemonfrost akan mati ketika di dalam telur)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    3.	Resesif<br/>
                                    Dasar perhitungan resesif:
                                    <ul>
                                        <li>Normal X Resesif = 100% normal het resesif</li>
                                        <li>Normal X Het Resesif =  50% normal, 50% het Resesif (Possible het Resesif)</li>
                                        <li>Het Resesif X Het Resesif = 25% normal, 50% het Resesif, 25% resesif (66% het resesif)</li>
                                        <li>Resesif X Het Resesif = 50% het resesif, 50% resesif</li>
                                        <li>Resesif X Resesif = 100% resesif</li>
                                    </ul>
                                    Contoh morph resesif gecko:

                                    <ul>
                                        <li>Albino (tremper, bell, rainwater)</li>
                                        <li>Eclipse</li>
                                        <li>Murphy patternless</li>
                                        <li>Blizzard</li>
                                    </ul>
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
