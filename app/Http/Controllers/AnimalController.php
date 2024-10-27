<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    // Properti untuk menyimpan data hewan
    private $animals = ['Kucing', 'Ayam', 'Ikan'];

    // Method index untuk menampilkan seluruh data animals
    public function index()
    {
        // Menampilkan data hewan menggunakan foreach
        foreach ($this->animals as $animal) {
            echo "- $animal\n";
        }
    }

    // Method store untuk menambahkan hewan baru
    public function store(Request $request)
    {
        $newAnimal = $request->input('animal');
        
        // Menambahkan hewan baru menggunakan array_push
        array_push($this->animals, $newAnimal);

        return response()->json([
            'message' => 'Hewan berhasil ditambahkan!',
            'animals' => $this->animals,
        ]);
    }

    // Method update untuk memperbarui data hewan
    public function update(Request $request, $id)
    {
        $updatedAnimal = $request->input('animal');
        
        // Memeriksa apakah id ada dalam array
        if (isset($this->animals[$id])) {
            $this->animals[$id] = $updatedAnimal;

            return response()->json([
                'message' => 'Hewan berhasil diperbarui!',
                'animals' => $this->animals,
            ]);
        }

        return response()->json([
            'message' => 'Hewan tidak ditemukan!',
        ], 404);
    }

    // Method destroy untuk menghapus data hewan
    public function destroy($id)
    {
        // Menghapus hewan dari array menggunakan array_splice atau unset
        if (isset($this->animals[$id])) {
            array_splice($this->animals, $id, 1);

            return response()->json([
                'message' => 'Hewan berhasil dihapus!',
                'animals' => $this->animals,
            ]);
        }

        return response()->json([
            'message' => 'Hewan tidak ditemukan!',
        ], 404);
    }
}
