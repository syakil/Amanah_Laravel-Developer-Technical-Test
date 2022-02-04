<?php

namespace App\Http\Controllers;

use App\Challange;
use App\Helpers\ResponseFormatter;
use Exception;
use Illuminate\Http\Request;

class ChallangeController extends Controller
{
    public function show(){

        $angkaRahasia = Challange::findOrFail(1);

        return ResponseFormatter::success($angkaRahasia);

    }

    public function update(Request $request){
        try {

            $request->validate([
                'nomor_rahasia' => 'required|max:4|min:4'
            ]);

            if (!is_numeric($request->nomor_rahasia)) {
                return ResponseFormatter::error($request->nomor_rahasia,'Nomor Rahasia Harus Berbentuk Angka!');
            }

            $angkaRahasia = Challange::findOrFail(1);
            $angkaRahasia->nomor_rahasia = $request->nomor_rahasia;
            $angkaRahasia->update();

            return ResponseFormatter::success($angkaRahasia);

        } catch (Exception $e) {

            return ResponseFormatter::error([
                'error' => $e
            ],'Something went wrong',500);

        }

    }

    public function store(Request $request){

        try {


            $request->validate([
                'nomor_rahasia' => 'required|max:4|min:4'
            ]);

            if (!is_numeric($request->nomor_rahasia)) {
                return ResponseFormatter::error($request->nomor_rahasia,'Nomor Rahasia Harus Berbentuk Angka!');
            }

            $check = Challange::where('id',1)->first();

            if ($check) {

                $angkaRahasia = Challange::findOrFail(1);
                $angkaRahasia->nomor_rahasia = $request->nomor_rahasia;
                $angkaRahasia->update();

            }else{

                $angkaRahasia = Challange::create([
                    'nomor_rahasia' => $request->nomor_rahasia
                ]);

            }

            return ResponseFormatter::success($angkaRahasia);

        } catch (Exception $e) {

            return ResponseFormatter::error([
                'error' => $e
            ],'Something went wrong',500);

        }
    }

    public function test(Request $request){

        $angkaRahasia = Challange::findOrFail(1);
        $angkaTebakan = $request->angkaTebakan;

        $alhamdullilah = 0;
        $subhanallah = 0;

        if (is_null($angkaTebakan)) {

            return ResponseFormatter::error('Angka Tebakan Harus Di Masukan!');

        }elseif (!is_numeric($request->angkaTebakan)) {

            return ResponseFormatter::error($request->angkaTebakan,'Nomor Rahasia Harus Berbentuk Angka!');

        }else{

            $nomorRahasia = str_split($angkaRahasia->nomor_rahasia);
            $nomorTebakan = str_split($angkaTebakan);

        }

        if ($nomorRahasia[0] == $nomorTebakan[0]) {
            $alhamdullilah++;
        }else{
            $subhanallah++;
        }

        if ($nomorRahasia[1] == $nomorTebakan[1]) {
            $alhamdullilah++;
        }else{
            $subhanallah++;
        }
        if ($nomorRahasia[2] == $nomorTebakan[2]) {
            $alhamdullilah++;
        }else{
            $subhanallah++;
        }
        if ($nomorRahasia[3] == $nomorTebakan[3]) {
            $alhamdullilah++;
        }else{
            $subhanallah++;
        }

        $hasil = [
            'Alhamdullilah' => $alhamdullilah,
            'Subhanallah' => $subhanallah
        ];

        return ResponseFormatter::success($hasil);

    }
}
