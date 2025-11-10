<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Row;

class PageSeeder extends Seeder
{
    public function run()
    {
        // ===================================================
        // 🏠 HOME
        // ===================================================
        $home = Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'image' => '/img-1.jpeg',
        ]);

        // Section 1 - Hero
        $hero = Section::create([
            'page_id' => $home->id,
            'title' => 'Welcome to Slide Moment',
            'description' => 'Abadikan setiap momen berharga Anda bersama kami.',
            'image' => '/img-1.jpeg',
        ]);

        // Section 2 - Our Product
        $product = Section::create([
            'page_id' => $home->id,
            'title' => 'Our Product',
            'description' => 'Layanan terbaik kami untuk setiap acara Anda.',
        ]);

        $rows = [
            ['title' => 'Photobooth', 'description' => 'Abadikan momen seru dan tak terlupakan bersama teman-teman.', 'order' => 1, 'image' => '/img-7.jpeg'],
            ['title' => 'Instaprint', 'description' => 'Cetak foto langsung dari media sosial atau galeri ponsel Anda.', 'order' => 2, 'image' => '/img-13.jpg'],
            ['title' => 'Photo on the Move', 'description' => 'Kami hadir mengabadikan setiap sudut acara Anda.', 'order' => 3, 'image' => '/img-15.jpeg'],
            ['title' => 'Template', 'description' => 'Pilih berbagai desain bingkai eksklusif.', 'order' => 4, 'image' => '/img-16.jpg'],
        ];
        foreach ($rows as $r) {
            Row::create(array_merge($r, [
                'page_id' => $home->id,
                'section_id' => $product->id,
            ]));
        }

        // Section 3 - Moment Gallery
        $moment = Section::create([
            'page_id' => $home->id,
            'title' => 'Our Moments',
            'description' => 'Kumpulan hasil karya terbaik kami.',
        ]);
        foreach (range(1, 6) as $i) {
            Row::create([
                'page_id' => $home->id,
                'section_id' => $moment->id,
                'title' => "Moment $i",
                'order' => $i,
                'image' => "/img-$i.jpeg",
            ]);
        }

        // ===================================================
        // 📸 PHOTOBOOTH
        // ===================================================
        $photobooth = Page::create([
            'title' => 'Photobooth',
            'slug' => 'photobooth',
            'image' => '/img-21.jpeg',
        ]);

        $photoSec1 = Section::create([
            'page_id' => $photobooth->id,
            'title' => 'Pose!',
            'description' => 'Setiap pose menceritakan kisah unik Anda.',
            'image' => '/img-22.jpeg',
        ]);

        $photoSec2 = Section::create([
            'page_id' => $photobooth->id,
            'title' => 'Pilihan Tema',
            'description' => 'Berbagai tema menarik untuk setiap acara.',
        ]);

        foreach (range(1, 4) as $i) {
            Row::create([
                'page_id' => $photobooth->id,
                'section_id' => $photoSec2->id,
                'title' => "Tema $i",
                'description' => "Deskripsi tema photobooth $i.",
                'order' => $i,
                'image' => "/img-2$i.jpeg",
            ]);
        }

        // ===================================================
        // 🖨️ INSTAPRINT
        // ===================================================
        $instaprint = Page::create([
            'title' => 'Instaprint',
            'slug' => 'instaprint',
            'image' => '/img-31.jpeg',
        ]);

        $instaSec1 = Section::create([
            'page_id' => $instaprint->id,
            'title' => 'Cetak Instan',
            'description' => 'Foto langsung dicetak dari media sosial Anda.',
            'image' => '/img-32.jpeg',
        ]);

        $instaSec2 = Section::create([
            'page_id' => $instaprint->id,
            'title' => 'Template Pilihan',
            'description' => 'Koleksi template instaprint yang dapat dipilih.',
        ]);

        foreach (range(1, 4) as $i) {
            Row::create([
                'page_id' => $instaprint->id,
                'section_id' => $instaSec2->id,
                'title' => "Template $i",
                'order' => $i,
                'image' => "/img-3$i.jpeg",
            ]);
        }

        // ===================================================
        // 🚙 PHOTO MOVE
        // ===================================================
        $photoMove = Page::create([
            'title' => 'Photo Move',
            'slug' => 'photo-move',
            'image' => '/img-41.jpeg',
        ]);

        $pmSec1 = Section::create([
            'page_id' => $photoMove->id,
            'title' => 'Photo Move',
            'description' => 'Studio foto berjalan untuk mobilitas tinggi.',
            'image' => '/img-42.jpeg',
        ]);

        $pmSec2 = Section::create([
            'page_id' => $photoMove->id,
            'title' => 'Kegiatan Kami',
            'description' => 'Galeri dokumentasi Photo Move.',
        ]);
        foreach (range(1, 4) as $i) {
            Row::create([
                'page_id' => $photoMove->id,
                'section_id' => $pmSec2->id,
                'title' => "Gallery $i",
                'order' => $i,
                'image' => "/img-4$i.jpeg",
            ]);
        }

        // ===================================================
        // 🎉 EVENT GALLERIES
        // ===================================================
        $galleries = Page::create([
            'title' => 'Event Galleries',
            'slug' => 'event-galleries',
            'image' => '/img-51.jpeg',
        ]);

        $galSec1 = Section::create([
            'page_id' => $galleries->id,
            'title' => 'Kumpulan Event',
            'description' => 'Galeri dari berbagai event Slide Moment.',
        ]);
        foreach (range(1, 6) as $i) {
            Row::create([
                'page_id' => $galleries->id,
                'section_id' => $galSec1->id,
                'title' => "Event $i",
                'order' => $i,
                'image' => "/img-5$i.jpeg",
            ]);
        }

        // ===================================================
        // 🗓️ EVENT
        // ===================================================
        $event = Page::create([
            'title' => 'Event',
            'slug' => 'event',
            'image' => '/img-61.jpeg',
        ]);

        Section::create([
            'page_id' => $event->id,
            'title' => 'Daftar Event',
            'description' => 'Informasi berbagai event dan kegiatan kami.',
            'image' => '/img-62.jpeg',
        ]);

        // ===================================================
        // 📅 SESI
        // ===================================================
        $sesi = Page::create([
            'title' => 'Sesi',
            'slug' => 'sesi',
            'image' => '/img-71.jpeg',
        ]);

        $sesiSec = Section::create([
            'page_id' => $sesi->id,
            'title' => 'Atur Jadwal Sesi',
            'description' => 'Pilih waktu terbaik Anda untuk pemotretan.',
            'image' => '/img-72.jpeg',
        ]);

        foreach (['Pagi', 'Siang', 'Sore'] as $i => $label) {
            Row::create([
                'page_id' => $sesi->id,
                'section_id' => $sesiSec->id,
                'title' => "Sesi $label",
                'order' => $i + 1,
                'image' => "/img-7" . ($i + 1) . ".jpeg",
            ]);
        }
    }
}
