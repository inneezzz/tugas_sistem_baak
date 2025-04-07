<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('show-mahasiswa');

        $search = $request->input('search');

        $mahasiswas = Mahasiswa::with('user')
            ->whereHas('user', function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                }
            })
            ->orWhere('nim', 'like', "%{$search}%")
            ->orWhere('jurusan', 'like', "%{$search}%")
            ->latest()
            ->paginate(5);

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $this->authorize('create-mahasiswa');
        return view('mahasiswa.create'); // Gunakan `form.blade.php` untuk Create & Edit
    }

    public function store(Request $request)
    {
        $this->authorize('create-mahasiswa');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'nim' => 'required|unique:mahasiswas,nim',
            'jurusan' => 'required',
            'angkatan' => 'required|digits:4',
            'alamat' => 'nullable|string',
        ]);

        // Buat User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('mahasiswa');

        // Buat Mahasiswa
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa) // Gunakan route model binding
    {
        $this->authorize('edit-mahasiswa');
        return view('mahasiswa.edit', compact('mahasiswa')); // Gunakan `form.blade.php`
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $this->authorize('edit-mahasiswa');

        $user = $mahasiswa->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'jurusan' => 'required',
            'angkatan' => 'required|digits:4',
            'alamat' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $mahasiswa->update($request->only(['nim', 'jurusan', 'angkatan', 'alamat']));

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $this->authorize('delete-mahasiswa');

        $mahasiswa->user->delete(); // Hapus juga user-nya
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}