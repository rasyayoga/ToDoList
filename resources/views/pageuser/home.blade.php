@extends('layouts.template')

@section('content')
    <!-- 00. Navbar -->
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Simple To Do List</div>
            <!-- 
            <div class="navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Akun Saya
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                            <li><a class="dropdown-item" href="#">Update Data</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        -->
        </div>
    </nav> --}}
    
    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">To Do List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card mb-3">
                <div class="card-body">
                    {{-- melihat apakah session success ada, jika ada maka jalankan if tersebut --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- ketik bf lalu pilih yang b:if maka menampilkan @if ($errors->any()) dan ketik bf lalu klik yang b:foreach maka menampilkan @foreach ($errors->all() as $item) --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                    <!-- 02. Form input data -->
                    <form id="todo-form" action="{{ route('home.post') }}" method="post">
                        {{-- setiap form wajib ada csrf agar inputan terkirim --}}
                        @csrf
                        <div class="input-group mb-3 gap-3">
                            {{-- value="{{ old('task') }} agar saat ada alert error maka data tetap masi ada, tidak hilang --}}
                            <input type="text" class="form-control" name="task" id="todo-input"
                                placeholder="Tambah task baru" required value="{{ old('task') }}">
                            <button class="btn btn-primary" type="submit">
                                Simpan
                            </button>
                        </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="todo-form" action="{{ route('home') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                    placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>
                        
                        <ul class="list-group mb-4" id="todo-list">
                            @foreach ($data as $item)
                            <!-- 04. Display Data -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="task-text">
                                    {!! $item->is_done == '1'?'<del>':'' !!}
                                      {{$item->task}}
                                    {!! $item->is_done == '1'?'</del>':'' !!}
                                </span>
                                <input type="text" class="form-control edit-input" style="display: none;"
                                    value="{{$item->task}}">
                                <div class="btn-group gap-2">
                                    <button class="btn btn-danger btn-sm delete-btn" 
                                    data-id="{{ $item->id }}" 
                                    data-url="{{ route('home.delete', ['id' => $item->id]) }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmDeleteModal">
                                ✕
                            </button>
                            
                                    {{-- {{ $loop->index }} variable bantuan agar data yang kita klik yang terbuka yaa yang kita klik saja tidak semua nya terbuka --}}
                                    <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">✎</button>
                                </div>
                            </li>
                            <!-- 05. Update Data -->
                            <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                <form action="{{ route('home.update', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <div class="input-group mb-3 gap-2">
                                            <input type="text" class="form-control" name="task"
                                                value="{{$item->task}}">
                                            <button class="btn btn-outline-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="radio px-2">
                                            <label>
                                                <input type="radio" value="1" name="is_done" {{ $item->is_done == '1'?'checked': ''}}> Selesai
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="0" name="is_done" {{ $item->is_done == '0'?'checked': ''}}> Belum
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </li>                       
                            @endforeach
                        </ul>
                        {{ $data->links()}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- Modal Konfirmasi Delete -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus task ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form id="deleteForm" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteForm = document.getElementById('deleteForm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const deleteUrl = this.getAttribute('data-url');
                    deleteForm.action = deleteUrl;
                });
            });
        </script>

    @endsection