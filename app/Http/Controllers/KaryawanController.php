<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    // List data karyawan dengan fitur search dan pagination
    public function index(Request $request)
    {
        $search = $request->query('search');

        $karyawan = Karyawan::when($search, function($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('jabatan', 'like', "%{$search}%")
                         ->orWhere('alamat', 'like', "%{$search}%");
        })
        ->orderBy('id_karyawan', 'asc')
        ->paginate(5)
        ->appends(['search' => $search]);

        // Dashboard Statistics
        $stats = [
            'total' => Karyawan::count(),
            'avg_age' => round(Karyawan::avg('usia'), 1) ?? 0,
            'unique_roles' => Karyawan::distinct('jabatan')->count('jabatan'),
            'top_role' => Karyawan::select('jabatan')
                            ->groupBy('jabatan')
                            ->orderByRaw('COUNT(*) DESC')
                            ->first()->jabatan ?? 'N/A',
        ];

        return view('karyawan.index', compact('karyawan', 'search', 'stats'));
    }

    // Form tambah karyawan
    public function create()
    {
        return view('karyawan.create');
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'jabatan' => 'required|max:20',
            'usia' => 'required|numeric',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('karyawan', 'public');
        }

        Karyawan::create($data);

        return redirect()->route('karyawan.index')
            ->with('success', 'DATA KARYAWAN BERHASIL DITAMBAHKAN!');
    }

    // Detail karyawan (HANYA SATU KALI!)
    public function show(Karyawan $karyawan)
    {
        $totalKaryawan = Karyawan::count();
        $samePosition = Karyawan::where('jabatan', $karyawan->jabatan)->count();

        return view('karyawan.show', compact('karyawan', 'totalKaryawan', 'samePosition'));
    }

    // Form edit karyawan
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    // Update data di database
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'jabatan' => 'required|max:20',
            'usia' => 'required|numeric',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($karyawan->foto) {
                Storage::disk('public')->delete($karyawan->foto);
            }
            $data['foto'] = $request->file('foto')->store('karyawan', 'public');
        }

        $karyawan->update($data);

        return redirect()->route('karyawan.index')
            ->with('success', 'DATA KARYAWAN BERHASIL DIPERBARUI!');
    }

    // Hapus data dari database
    public function destroy(Karyawan $karyawan)
    {
        // Hapus foto jika ada
        if ($karyawan->foto) {
            Storage::disk('public')->delete($karyawan->foto);
        }
        
        $karyawan->delete();

        return redirect()->route('karyawan.index')
            ->with('success', 'DATA KARYAWAN BERHASIL DIHAPUS!');
    }
}
