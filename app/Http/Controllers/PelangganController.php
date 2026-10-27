<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataPelanggan'] = Pelanggan::all();
        return view('admin.pelanggan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Tambahkan Validasi Form
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'birthday'   => 'nullable|date|date_format:Y-m-d|before_or_equal:today', // Validasi tanggal yang benar
            'gender'     => 'nullable|in:Male,Female,Other',
            'email'      => 'required|email|unique:cv_2555301126,email',
            'phone'      => 'nullable|string|max:20',
        ]);

        // Simpan data setelah lolos validasi
        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan_id = $id;
        $pelanggan    = Pelanggan::findOrFail($pelanggan_id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;

        $pelanggan->save();
        return redirect()->route('pelanggan.index')->with('success', 'perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();
<<<<<<< HEAD
        return redirect()->route('pelanggan.index')->with('success','Data berhasil dihapus');
=======
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
    public function showCv($id)
    {
        // Mengambil data pelanggan berdasarkan ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Mengembalikan view (sesuaikan lokasi file Blade Anda)
        return view('admin.pelanggan.cv', compact('pelanggan'));
>>>>>>> 0db440e (UTS 001)
    }
}
