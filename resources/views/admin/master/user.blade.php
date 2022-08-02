<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    @notifyCss
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Data User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('adm.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <x-notify-messages />
                </div>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            Daftar User
                            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalTambah">Tambah</button>
                        </div>
                        <div class="card-body">
                            <table id="tabel1" class="table table-bordered" style="width: 100%">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">NAMA</th>
                                    <th scope="col" class="text-center">EMAIL</th>
                                    <th scope="col" class="text-center">REGISTER</th>
                                    <th scope="col" class="text-center">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Start: Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('adm.master.usersave')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <!-- Start: Nama Pengguna -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="namaPengguna"
                                      @class(["form-label","errorLabel",($errors->tambah->has('name'))? "text-danger":""]) >Nama
                                </label>
                                <input type="text" name="name" maxlength="125"
                                       @class(["form-control","errorInput",($errors->tambah->has('name'))? "is-invalid":""]) value="{{old('name')}}"
                                       id="namaPengguna" placeholder="Nama">
                                @if($errors->tambah->has('name'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->tambah->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: Nama Pengguna -->

                        <!-- Start: Email -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="email"
                                    @class(["form-label","errorLabel",($errors->tambah->has('email'))? "text-danger":""]) >Email
                                </label>
                                <input type="email" name="email" maxlength="255"
                                       @class(["form-control","errorInput",($errors->tambah->has('email'))? "is-invalid":""]) value="{{old('email')}}"
                                       id="email" placeholder="Email">
                                @if($errors->tambah->has('email'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->tambah->first('email')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: Email -->

                        <!-- Start: Password -->
                        <div class="row mt-2 mb-2">
                            <div class="col-md-12">
                                <label for="password"
                                    @class(["form-label","errorLabel",($errors->tambah->has('password'))? "text-danger":""]) >Password
                                </label>
                                <input type="password" name="password" maxlength="125"
                                       @class(["form-control","errorInput",($errors->tambah->has('password'))? "is-invalid":""]) value="{{old('password')}}"
                                       id="password" placeholder="******">
                                @if($errors->tambah->has('password'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->tambah->first('password')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: Password -->

                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: Modal Tambah -->

    <!-- Start: Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('adm.master.userupdate')}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="user_id" class="form-control" id="useredit_id" value="{{old('user_id')}}">
                            </div>
                        </div>
                        <!-- Start: Nama Pengguna -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="nameEdit"
                                    @class(["form-label","errorLabel",($errors->edit->has('name'))? "text-danger":""]) >Nama
                                </label>
                                <input type="text" name="name" maxlength="125"
                                       @class(["form-control","errorInput",($errors->edit->has('name'))? "is-invalid":""]) value="{{old('name')}}"
                                       id="nameEdit" placeholder="Nama">
                                @if($errors->edit->has('name'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->edit->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: Nama Pengguna -->

                        <!-- Start: Email -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="emailEdit"
                                    @class(["form-label","errorLabel",($errors->edit->has('email'))? "text-danger":""]) >Email
                                </label>
                                <input type="email" name="email" maxlength="255"
                                       @class(["form-control","errorInput",($errors->edit->has('email'))? "is-invalid":""]) value="{{old('email')}}"
                                       id="emailEdit" placeholder="Email">
                                @if($errors->edit->has('email'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->edit->first('email')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: Email -->

                        <!-- Start: Password -->
                        <div class="row mt-2 mb-2">
                            <div class="col-md-12">
                                <label for="password"
                                    @class(["form-label","errorLabel",($errors->edit->has('password'))? "text-danger":""]) >Password
                                </label>
                                <input type="password" name="password" maxlength="125"
                                       @class(["form-control","errorInput",($errors->edit->has('password'))? "is-invalid":""]) value="{{old('password')}}"
                                       id="password" placeholder="******">
                                @if($errors->edit->has('password'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->edit->first('password')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: Password -->

                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: Modal Edit -->

    <!-- Start: Modal Hapus -->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('adm.master.userdelete')}}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            @if($errors->hapus->has('user_id'))
                                <span
                                    class="text-center text-danger errorMessage">{{$errors->hapus->first('user_id')}}</span>
                            @endif
                            <div class="col-md-12">
                                <input type="hidden" name="user_id" class="form-control" id="userhapus_id" value="{{old('user_id')}}">
                            </div>
                        </div>
                        Hapus data pengguna ini ?
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: Modal Hapus -->

    <x-admin.js-layout />
    @notifyJs
    <script>
        var modaltambah = new bootstrap.Modal(document.getElementById("modalTambah"), {});
        var modaledit = new bootstrap.Modal(document.getElementById("modalEdit"), {});
        var modalhapus = new bootstrap.Modal(document.getElementById("modalHapus"), {});

        @if($errors->hasbag('tambah'))
            document.onreadystatechange = function () {
            modaltambah.show();
        };
        @endif

        @if($errors->hasbag('edit'))
            document.onreadystatechange = function () {
            modaledit.show();
        };
        @endif

        @if($errors->hasbag('hapus'))
            document.onreadystatechange = function () {
            modalhapus.show();
        };
        @endif

        /** Saat tombol hapus di klik*/
        $(document).on("click", ".open-hapus", function (e) {
            e.preventDefault();
            let fid = $(this).data('id');
            $('#userhapus_id').val(fid);
        })

        /** Saat tombol edit di klik*/
        $(document).on("click", ".open-edit", function (e) {
            e.preventDefault();
            let fid = $(this).data('id');
            let fname = $(this).data('name');
            let femail = $(this).data('email');
            $('#useredit_id').val(fid);
            $('#nameEdit').val(fname);
            $('#emailEdit').val(femail);
        });

        /** saat modal edit di closed maka modal akan dibersihkan */
        $('.modal').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            let pesanError = $('.errorMessage');
            let errorInput = $('.errorInput');
            let errorLabel = $('.errorLabel');
            pesanError.html("");
            errorInput.removeClass('is-invalid');
            errorLabel.removeClass('text-danger');
        })
        $(document).ready(function () {
            let base_url = "{{route('adm.master.user')}}";
            $('#tabel1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'GET',
                    url: base_url,
                    async: true,
                },
                language: {
                    processing: "Loading",
                },
                columns: [
                    {
                        data: 'index',
                        class: 'text-center',
                        defaultContent: '',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                        }
                    },
                    {data: 'name', class: 'text-center'},
                    {data: 'email', class: 'text-center'},
                    {data: 'created_at', class: 'text-center'},
                    {data: 'action', class: 'text-center', orderable: false},
                ],
                "bDestroy": true
            });
        });
    </script>
</x-admin.template-admin>
