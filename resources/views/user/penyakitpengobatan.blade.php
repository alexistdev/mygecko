<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penyakit dan Cara Mengobati</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('usr.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Penyakit dan Cara Mengobati</li>
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
                                <h5 class="card-header">Penyakit dan Cara Mengobati</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul>
                                        <li>Penyakit Crypto<br/>
                                            Cara mengobati: Penyakit ini sangat menular, jadi hal pertama adalah pisahkan segera gecko yang sakit dari gecko lainnya. Penyakit ini sulit untuk disembuhkan namun dapat di coba dengan cara memberikan obat “Gabbryl” cair kepada gecko dengan cara dioleskan atau menggunakan suntukan tanpa jarum yang diminumkan kepada gecko yang sakit setiap hari.

                                        </li>
                                        <li>
                                            Penyakit prolapse<br/>
                                            Cara mengobati: Rendam organ kelamin tersebut dengan air gula hangat (gula pasir dalam jumlah cukup banyak, hingga air sedikit kental) dengan durasi 30 menit tiap harinya hingga normal.
                                        </li>
                                        <li>
                                            Penyakit egg binding<br/>
                                            Cara mengobati:Cara pertama adlaah pindahkan kekotak gelap dan hangat, gunakan alas yang lembab untuk memudahkan proses bertelur. Jika penumpukan telur sudah parah, maka rendam dengan air hangat beberapa saat, urut secara perlahan perut leopard gecko hingga telur terlihat keluar, kemudian tarik dengan pinset. Bisa juga dilakukan dengan cara penyedotan menggunakan suntukan. Penanganan sendiri cukup beresiko, apabila ragu sebaiknya dibawa ke dokter hewan terdekat.
                                        </li>
                                        <li>
                                            MBD (metabolic Bone Deceased)<br/>
                                            Cara mengobati:Untuk sembuh dari penyakit ini sangatlah sulit, namun untuk pencegahannya selalu berikan kalsium (pemberian kalsium dapat dengan diletakan pada wadah atau di dusting pada pakan) pada gecko anda dan jangan lupa memberikan gutload pada pakan gecko.
                                        </li>
                                        <li>
                                            Tumor<br/>
                                            Cara mengobati:Tumor biasanya menjangkit pada leopard gecko dengan morph lemon frost beserta combo combonya. Untuk penyakit ini tidak dapat di obati dengan obat luar, namun jika tumor yang terdapat pada tubuh leopard gecko terlalu besar maka akan di lakukan tindakan operasi pengangkatan tumor yang bisa dilakukan oleh dokter hewan.
                                        </li>
                                        <li>
                                            Impaction<br/>
                                            Cara mengobati:Sebelum terjadi gunakan alas kandang yang aman dan tidak berbahaya (kertas bersih sangat direkomendasikan) jika sudah terlanjut terkena impaction maka segera bawa ke dokter hewan terdekat.

                                        </li>
                                        <li>
                                            Diare<br/>
                                            Cara mengobati:Penyakit ini mudah menular sehingga segera pisahkan gecko yang terkena penyakit dari gecko lainnya, naikan suhu sekitar kandang, jaga kebersihan dan hentikan dulu pemberian pakan dan suplemen sementara waktu (puasakan 2-3 hari lalu berikan 1 jangkrik dan ulangi sampai poop berubah menjadi padat) dan beriminum seperti biasa.
                                        </li>
                                        <li>
                                            Luka Luar<br/>
                                            Cara mengobati:Gunakan alas kandang kertas bersih, bersihkan bagian luka, dan tunggu luka mengering. Untuk pemberikan makan sebaiknya terus dipantau ketika makan atau gecko disuap agar luka terhindar dari gangguan serangga pakan.
                                        </li>
                                        <li>
                                            Gagal Shading<br/>
                                            Cara mengobati:Untuk menghindari gagal shading, berikan suasana lembab di dalam kandang. Namun jika sudah terlanjur gagal shading, rendam gecko yang kalian miliki dengan air hangat dan bantu kelupas kulit lama pada leopard gecko hingga bersih
                                        </li>
                                        <li>
                                            Faktor cuaca (muntah)<br/>
                                            Cara mengobati:Faktor cuaca adalah penyakit yang sering menyerang leopard gecko. Penyakit ini di sebabkan oleh cuaca yang fluktuatif (terlalu dingin juga berpengaruh).
                                            <br/>Cara mengobati:<br/>
                                            Puasakan gecko 1 minggu. Naikan suhu dengan cara menggunakan reptile pad atau bisa juga menggunakan lampu reptile tak bercahaya. Setelah memuasakan gecko selama 1 minggu. Coba pemberian makan satu ekor jangkrik. Jika di makan maka ulangi Langkah tersebut 2 hari setelahnya. Jika tidak di makan, ulangi Langkah tersebut 5 hari setelahnya. Namun jika gecko tersebut mulai lancar makan, naikan porsi jangkrik menjadi 2-3 ekor jangkrik per 2 hari sekali.

                                        </li>
                                        <li>
                                            Gecko Normal<br/>
                                            Cara mengobati:Tidak ada penyakit pada gecko kalian. Mungkin saja gecko kalian sedang birahi, ganti kulit atau yang lainnya. Silahkan hubungi breeder professional yang sudah berpengalaman di ternak leopard gecko untuk mengetahui mengapa gecko kalian teridentifikasi gejala tersebut.
                                        </li>
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
