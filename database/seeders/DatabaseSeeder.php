<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Disease;
use App\Models\Event;
use App\Models\Service;
use App\Models\User;
use App\Models\Queue;
use App\Models\Treatment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
                'name' => '-',
                'username' => Str::random(45),
                'password' => bcrypt(Str::random(20)),
                'address' => 'Lorem Ipsum',
                'photo' => 'photos/profiles/avatar.png',
                'role' => 'admin',
                'specialist' => NULL,
                'practice_time' => NULL
            ],
            [
                'name' => 'Imam Alfariji',
                'username' => 'imam',
                'password' => bcrypt('alfariji'),
                'address' => 'Lorem Ipsum',
                'photo' => 'photos/profiles/avatar.png',
                'role' => 'admin',
                'specialist' => NULL,
                'practice_time' => NULL
            ],
            [
                'name' => 'dr. Muchsyim',
                'username' => 'muchsyim',
                'password' => bcrypt('muchsyim'),
                'address' => 'Lorem Ipsum',
                'photo' => 'photos/profiles/1.jpg',
                'role' => 'doctor',
                'specialist' => 'Dokter Umum',
                'practice_time' => 'Senin - Sabtu, 14:00 - 20:00'
            ],
            [
                'name' => 'dr. Neta Oktiyani Poerin',
                'username' => 'neta',
                'password' => bcrypt('oktiyani'),
                'address' => 'Lorem Ipsum',
                'photo' => 'photos/profiles/2.jpg',
                'role' => 'doctor',
                'specialist' => 'Dokter Umum',
                'practice_time' => 'Senin, Selasa, Kamis, 08:00 - 14:00'
            ],
            [
                'name' => 'Bagas Aditama',
                'username' => 'bagas',
                'password' => bcrypt('aditama'),
                'address' => 'Lorem Ipsum',
                'photo' => 'photos/profiles/avatar.png',
                'role' => 'patient',
                'specialist' => NULL,
                'practice_time' => NULL
            ]
        ];

        User::insert($users);

        $services = [
            [
                'name' => 'Bedah Minor',
                'description' => 'Pelaksanaan bedah minor di klinik ini bersifat efektif(terjadwal).',
                'icon' => 'photos/services/icon.png',
                'is_lab' => false
            ],
            [
                'name' => 'Khitan/Sunat',
                'description' => 'Sunat/Khitan adalah proses pelepasan kulit yang ada di ujung penis.',
                'icon' => 'photos/services/icon-1.png',
                'is_lab' => false
            ],
            [
                'name' => 'Suntik KB',
                'description' => 'Menyuntikkan hormon ke dalam tubuh untuk mencegah ovulasi di masa subur.',
                'icon' => 'photos/services/icon-2.png',
                'is_lab' => false
            ],
            [
                'name' => 'Pengobatan Umum',
                'description' => 'Pengobatan umum diperuntukkan untuk anak dan dewasa.',
                'icon' => 'photos/services/icon-3.png',
                'is_lab' => false
            ],
            [
                'name' => 'Surat Keterangan Sehat',
                'description' => 'Surat tertulis pasien setelah menjalani pemeriksaan sesuai aturan yang berlaku.',
                'icon' => 'photos/services/icon-4.png',
                'is_lab' => false
            ],
            [
                'name' => 'Asam Urat',
                'description' => 'Pemeriksaan yang dilakukan untuk mengetahui kadar asam urat di dalam darah atau urine.',
                'icon' => 'photos/services/icon-5.png',
                'is_lab' => true
            ],
            [
                'name' => 'Gula Darah',
                'description' => 'Pemeriksaan tes gula darah untuk mengetahui kadar gula (glukosa) dalam darah.',
                'icon' => 'photos/services/icon-5.png',
                'is_lab' => true
            ],
            [
                'name' => 'Kolesterol',
                'description' => 'Pemeriksaan tes kolesterol yang dilakukan untuk mengukur kadar lemak dalam darah.',
                'icon' => 'photos/services/icon-5.png',
                'is_lab' => true
            ]
        ];
        
        Service::insert($services);
        
        $events = [
            [
                'name' => 'Kegiatan 1',
                'description' => 'Lorem ipsum dolor sit amet ut doseui tempor nec faucibus',
                'photo' => 'photos/events/event-1.jpg'
            ],
            [
                'name' => 'Kegiatan 2',
                'description' => 'Lorem ipsum dolor sit amet ut doseui tempor nec faucibus',
                'photo' => 'photos/events/event-2.jpg'
            ],
            [
                'name' => 'Kegiatan 3',
                'description' => 'Lorem ipsum dolor sit amet ut doseui tempor nec faucibus',
                'photo' => 'photos/events/event-3.jpg'
            ]
        ];

        Event::insert($events);

        $diseases = [
            [
                'name' => '-'
            ],
            [
                'name' => 'Asam Urat'
            ]
        ];
        Disease::insert($diseases);

        Queue::insert([['is_open' => true]]);

        $treatments = [
            [
                'patient_id' => '1',
                'complaint' => 'Lorem ipsum dolor sit amet ut doseui tempor',
            ]
        ];

        Treatment::insert($treatments);



    }
}
