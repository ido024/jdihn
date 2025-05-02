<?php

namespace App\Http\Controllers;

use App\Models\Jaksa;
use App\Models\Penuntut;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PenuntutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penuntuts = Penuntut::all();
        return view('pages.penuntut.index', compact('penuntuts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jaksas = Jaksa::all();
        return view('pages.penuntut.create', compact('jaksas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'no_tuntutan' => 'required',
            'nama_penuntut' => 'required',
            'nama_terdakwa' => 'required',
            'umur_terdakwa' => 'required',
            'tgl_tuntutan' => 'required',
            'no_hp_penuntut' => 'required',
            'alamat_penuntut' => 'required',
            'kasus_dugaan' => 'required',
            'bukti_foto1' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:10240',
            'bukti_foto2' => 'image|mimes:jpeg,png,jpg,gif,pdf|max:10240',
            'bukti_foto3' => 'image|mimes:jpeg,png,jpg,gif,pdf|max:10240',
            'bukti_foto4' => 'image|mimes:jpeg,png,jpg,gif,pdf|max:10240',
            'bukti_foto5' => 'image|mimes:jpeg,png,jpg,gif,pdf|max:10240',
        ]);

        // Handle file upload for bukti_foto1
        if ($request->hasFile('bukti_foto1')) {
            $validatedData['bukti_foto1'] = $request->file('bukti_foto1')->store('bukti_fotos', 'public');
        }

        // Handle file upload for bukti_foto2
        if ($request->hasFile('bukti_foto2')) {
            $validatedData['bukti_foto2'] = $request->file('bukti_foto2')->store('bukti_fotos', 'public');
        }

        // Handle file upload for bukti_foto3
        if ($request->hasFile('bukti_foto3')) {
            $validatedData['bukti_foto3'] = $request->file('bukti_foto3')->store('bukti_fotos', 'public');
        }

        // Handle file upload for bukti_foto4
        if ($request->hasFile('bukti_foto4')) {
            $validatedData['bukti_foto4'] = $request->file('bukti_foto4')->store('bukti_fotos', 'public');
        }

        // Handle file upload for bukti_foto5
        if ($request->hasFile('bukti_foto5')) {
            $validatedData['bukti_foto5'] = $request->file('bukti_foto5')->store('bukti_fotos', 'public');
        }

        // Buat data penuntut dalam database dengan menggunakan data yang telah divalidasi
        $penuntut = Penuntut::create($validatedData);
        // Check if the model was successfully created
        if ($penuntut) {
            // Redirect or perform any action on successful creation
            Session::flash('success', 'Data Penuntut berhasil disimpan.');
            return redirect()->route('dashboard.penuntut.index');
        } else {
            // If model creation fails, display an error message
            Session::flash('error', 'Gagal menyimpan data. Mohon coba lagi.');
            return redirect()->back()->withInput();
        }
        // Redirect pengguna ke rute tertentu dengan pesan sukses
        // return redirect()->route('dashboard.penuntut.index')
        //     ->with('success', 'Penuntut created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penuntut $penuntut)
    {
        return view('pages.penuntut.show', compact('penuntut'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penuntut $penuntut)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'no_tuntuntan' => 'required',
            'nama_penuntut' => 'required',
            'nama_terdakwa' => 'required',
            'umur_terdakwa' => 'required',
            'tgl_tuntutan' => 'required',
            'no_hp_penuntut' => 'required',
            'alamat_penuntut' => 'required',
            'kasus_dugaan' => 'required',
            'bukti_foto1' => 'image|mimes:jpeg,png,jpg,gif,pdf',
            'bukti_foto2' => 'image|mimes:jpeg,png,jpg,gif,pdf',
            'bukti_foto3' => 'image|mimes:jpeg,png,jpg,gif,pdf',
            'bukti_foto4' => 'image|mimes:jpeg,png,jpg,gif,pdf',
            'bukti_foto5' => 'image|mimes:jpeg,png,jpg,gif,pdf',
        ]);

        // Handle file upload for bukti_foto1
        if ($request->hasFile('bukti_foto1')) {
            $validatedData['bukti_foto1'] = $request->file('bukti_foto1')->store('bukti_fotos', 'public');
        }

        // Handle file upload for bukti_foto2
        if ($request->hasFile('bukti_foto2')) {
            $validatedData['bukti_foto2'] = $request->file('bukti_foto2')->store('bukti_fotos', 'public');
        }

        // Handle file upload for bukti_foto3
        if ($request->hasFile('bukti_foto3')) {
            $validatedData['bukti_foto3'] = $request->file('bukti_foto3')->store('bukti_fotos', 'public');
        }

        // Handle file upload for bukti_foto4
        if ($request->hasFile('bukti_foto4')) {
            $validatedData['bukti_foto4'] = $request->file('bukti_foto4')->store('bukti_fotos', 'public');
        }

        // Handle file upload for bukti_foto5
        if ($request->hasFile('bukti_foto5')) {
            $validatedData['bukti_foto5'] = $request->file('bukti_foto5')->store('bukti_fotos', 'public');
        }

        // Update penuntut in the database
        $penuntut->update($validatedData);

        // Redirect user back with success message
        return redirect()->route('dashboard.penuntut.index')
            ->with('success', 'Penuntut updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penuntut $penuntut)
    {
        $penuntut->delete();

        return redirect()->route('dashboard.penuntut.index')
            ->with('success', 'Penuntut deleted successfully');
    }
}
