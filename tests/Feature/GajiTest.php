<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Gaji;
use App\Models\User;
use App\Models\Kehadiran;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GajiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_gaji()
    {
        $role = 'admin';

        $user = User::where('role', $role)->first();

        $keh = Kehadiran::with('karyawan')->find(1)->get();

        foreach($keh as $item){
            $bpjs = $item->karyawan->bpjs;
            $tun = $item->karyawan->tunjangan;
            $mas = $item->masuk;
            $lemb = $item->lembur;
        }

        $upah_harian = 50000*$mas;
        $lembur = 10000*$lemb;

        $bonus = 500000;
        $potong = 125000;

        $total_gaji = $lembur+$upah_harian+$bonus+$tun+$bpjs-$potong;

        Gaji::create([
            'kehadiran_id' => '1',
            'uang_lembur' => $lembur,
            'bpjs' => $bpjs,
            'tunjangan' => $tun,
            'bonus' => $bonus,
            'potongan' => $potong,
            'gaji_harian' => $upah_harian,
            'total_gaji' => $total_gaji,
        ]);

        $response = $this->actingAs($user)->get('/gaji');

        $response->assertStatus(200);
    }

    public function test_lihat_gaji()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)->get(route('gaji.index'));
        $response->assertStatus(200);
    }

    public function test_update_gaji()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $keh = Kehadiran::with('karyawan')->find(1)->get();

        foreach($keh as $item){
            $bpjs = $item->karyawan->bpjs;
            $tun = $item->karyawan->tunjangan;
            $mas = $item->masuk;
            $lemb = $item->lembur;
        }

        $upah_harian = 50000*$mas;
        $lembur = 10000*$lemb;

        $bonus = 750000;
        $potong = 12000;

        $total_gaji = $lembur+$upah_harian+$bonus+$tun+$bpjs-$potong;

        $request = [
            'kehadiran_id' => '1',
            'uang_lembur' => $lembur,
            'bonus' => $bonus,
            'tunjangan' => $tun,
            'bpjs' => $bpjs,
            'potongan' => $potong,
            'gaji_harian' => $upah_harian,
            'total_gaji' => $total_gaji,
        ];

        $response = $this->actingAs($user)
        ->put(route('gaji.update',1), $request);

        $response->assertStatus(302);
    }

    public function test_hapus_gaji()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)
        ->delete(route('gaji.destroy',1));

        $response->assertStatus(302);
    }
}
