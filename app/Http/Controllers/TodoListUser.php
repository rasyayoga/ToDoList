<?php

namespace App\Http\Controllers;

use App\Models\todolists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoListUser extends Controller
{
    public function index()
    {
        $max_data = 10;
        $dataQuery = todolists::where('user_id', Auth::user()->id);
            if(request('search')){
                $dataQuery = $dataQuery->where('task', 'like', '%' . request('search') . '%');
            }
        $dataQuery = $dataQuery->orderBy('task', 'asc');
        $data = $dataQuery->paginate($max_data)->withQueryString();
    
        return view("pageuser.home", compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //inputan saat create todolist di app.blade.php yg name nya task required(wajib isi) dan min:3(minimal 3karakter)
        $request->validate([
            'task' => 'required|min:5|max:25',
        ],[
            //ini untuk menampilkan text alert yang akan di tampilkan jika sarat tidak terpenuhi
            'task.required' => 'Inputan Wajib Di Isi',
            'task.min' => 'Data Yang Di Input Minimal 5 Karakter',
            'task.max' => 'Data Yang Di Input Tidak Boleh Lebih dari 25 Karakter',
        ]);

        // fungsi create, dibawah task nama colom request dari inputan yang name nya task jika inputan diisi belajar coding maka isi nya $data = ['task' => 'belajar coding'];
        $data = [
            'task'=> $request->input('task'),
            'user_id' => Auth::id(), 
        ];

        //fugsi dibawah ini menuju models yang dimana models tersebut yang mengatur arah ke database mana
        todolists::create($data);

        // fungsi dibawah ini jika data berhasil ditambahkan maka akan mengarah ke halaman /todo dan menampilkan alert Berhasil Menambahkan List, 
        //success berupa data untuk menyimpan session success
        return redirect()->route('home')->with('success', 'Berhasil Menambah List');
    }

    /**
     * Display the specified resource.
     */
    public function show(todolists $todolists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(todolists $todolists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //tambahkan variable id
    public function update(Request $request, todolists $todolists, $id)
    {
        //disini tidak beda jauh dengan create
        $request->validate([
            'task' => 'required|min:5|max:25'
        ],[
            //ini untuk menampilkan text alert yang akan di tampilkan jika sarat tidak terpenuhi
            'task.required' => 'Inputan Wajib Di Isi',
            'task.min' => 'Data Yang Di Input Minimal 5 Karakter',
            'task.max' => 'Data Yang Di Input Tidak Boleh Lebih dari 25 Karakter',
        ]);
        $data = [
            'task'=> $request->input('task'),
            'is_done'=> $request->input('is_done')
        ];
 
        // where agar saat di update dia menuju pada data yang di update saja, update dari variable data
        todolists::where('id', $id)->update($data);
        return redirect()->route('home')->with('success', 'Berhasil Update list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(todolists $todolists, $id)
    {
        todolists::where('id', $id)->delete();
        return redirect()->route('home')->with('success', 'Berhasil Hapus list');
    }
}
