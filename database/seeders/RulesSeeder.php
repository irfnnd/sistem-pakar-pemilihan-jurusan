<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rule; // Pastikan model Rule sudah ada dan benar

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = [
            // K001 - Kecerdasan Linguistic-Verbal
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L001'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L002'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L003'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L004'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L005'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L006'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L007'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L008'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L009'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L010'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L011'],
            ['kode_kecerdasan' => 'K001', 'kode_ciri' => 'L012'],

            // K002 - Kecerdasan Logika-Matematika
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L013'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L014'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L015'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L016'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L017'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L018'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L019'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L020'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L021'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L022'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L023'],
            ['kode_kecerdasan' => 'K002', 'kode_ciri' => 'L024'],

            // K003 - Kecerdasan Spasial-Visual
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L025'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L026'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L027'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L028'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L029'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L030'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L031'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L032'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L033'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L034'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L035'],
            ['kode_kecerdasan' => 'K003', 'kode_ciri' => 'L036'],

            // K004 - Kecerdasan Ritmik-Musik
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L037'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L038'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L039'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L040'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L041'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L042'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L043'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L044'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L045'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L046'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L047'],
            ['kode_kecerdasan' => 'K004', 'kode_ciri' => 'L048'],

            // K005 - Kecerdasan Kinestetik
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L049'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L050'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L051'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L052'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L053'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L054'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L055'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L056'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L057'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L058'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L059'],
            ['kode_kecerdasan' => 'K005', 'kode_ciri' => 'L060'],

            // K006 - Kecerdasan Interpersonal
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L061'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L062'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L063'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L064'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L065'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L066'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L067'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L068'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L069'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L070'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L071'],
            ['kode_kecerdasan' => 'K006', 'kode_ciri' => 'L072'],

            // K007 - Kecerdasan Intrapersonal
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L073'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L074'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L075'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L076'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L077'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L078'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L079'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L080'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L081'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L082'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L083'],
            ['kode_kecerdasan' => 'K007', 'kode_ciri' => 'L084'],

            // K008 - Kecerdasan Naturalis
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L085'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L086'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L087'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L088'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L089'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L090'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L091'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L092'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L093'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L094'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L095'],
            ['kode_kecerdasan' => 'K008', 'kode_ciri' => 'L096'],

            // K009 - Kecerdasan Eksistensial
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L097'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L098'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L099'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L100'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L101'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L102'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L103'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L104'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L105'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L106'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L107'],
            ['kode_kecerdasan' => 'K009', 'kode_ciri' => 'L108'],
        ];

        foreach ($rules as $rule) {
            Rule::create($rule);
        }
    }
}
