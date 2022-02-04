<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Inventory;
use Exception;

class InventoryController extends Controller
{
    // return ResponseFormatter::error(['message' => 'Unauthorized'],'Authentication Failed!',500);
    public function index(){

        $data = Inventory::paginate(5);

        return ResponseFormatter::success($data);

    }

    public function show($id){

        try {

            $data = Inventory::findOrFail($id);

            return ResponseFormatter::success($data);


        } catch (Exception $e) {

            return ResponseFormatter::error([
                'error' => $e
            ],'Something went wrong',500);

        }

    }

    public function store(Request $request){

        try {

            $request->validate([
                'nama' => ['required','unique:inventories,nama'],
                'harga' => ['required']
            ]);

            $data = Inventory::create([
                'nama' => $request->nama,
                'harga' => $request->harga
            ]);

            return ResponseFormatter::success($data);


        } catch (Exception $e) {

            return ResponseFormatter::error([
                'error' => $e->getmessage(),
                'message' => $e
            ],'Something went wrong',500);

        }

    }

    public function update(Request $request){

        try {

            $id = $request->id;
            $data = $request->all();

            $inventory = Inventory::findOrFail($id);
            $inventory->update($data);

            return ResponseFormatter::success($inventory);

        } catch (Exception $e) {

            return ResponseFormatter::error([
                'error' => $e->getmessage(),
                'message' => $e
            ],'Something went wrong',500);

        }

    }

    public function delete($id){

        try {

            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            return ResponseFormatter::success($inventory,'Data Berhasil Di Hapus!');

        } catch (Exception $e) {

            return ResponseFormatter::error([
                'error' => $e->getmessage(),
                'message' => $e
            ],'Something went wrong',500);

        }

    }

    public function tambahStok(Request $request){

        try {

            $id = $request->id;
            $inventory = Inventory::findOrFail($id);
            $inventory->stok += $request->value;
            $inventory->update();

            return ResponseFormatter::success($inventory,'Data Berhasil Di Tambahkan!');

        } catch (Exception $e) {

            return ResponseFormatter::error([
                'error' => $e->getmessage(),
                'message' => $e
            ],'Something went wrong',500);

        }

    }

    public function kurangStok(Request $request){

        try {

            $id = $request->id;
            $inventory = Inventory::findOrFail($id);
            $inventory->stok -= $request->value;
            $inventory->update();

            return ResponseFormatter::success($inventory,'Data Berhasil Di Kurang!');

        } catch (Exception $e) {

            return ResponseFormatter::error([
                'error' => $e->getmessage(),
                'message' => $e
            ],'Something went wrong',500);

        }

    }


}
