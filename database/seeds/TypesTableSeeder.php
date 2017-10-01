<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            "ปั๊ก - Pug",
            "พ็อมโบรค เวล์ช คอร์กี้ - Pembroke Welsh Corgi",
            "พุดเดิ้ล - Poodle",
            "เกรทเดน - Great Dane",
            "เกรทเทอร์ สวิสส์ เมาน์เทนด๊อก - Greater Swiss Mountain Dogs",
            "โกลเด้น รีทรีฟเวอร์ - Golden Retriever",
            "คอเคเซียน เชพเพิร์ด - Caucasian Shepherd",
            "คอลลี่ - Collie",
            "คาวาเลียร์ คิง ชาลส์ สแปเนียล - Cavalier King Charles Spaniel",
            "คีชอน - Keeshounds",
            "เคน คอร์โซ่ - Cane Corso",
            "เครนเทอร์เรีย - Cairn Terrier",
            "เคอร์รี บลู เทอร์เรีย - Kerry Blue Terriers",
            "โคมอนดอร์ - Komondor",
            "เจแปนนิส ชิน - Japanese Chins",
            "เจแปนนิส สปิตซ์ - Japanese Spitz",
            "แจ็ครัสเซลล์เทอร์เรีย - Jack Russell Terrier",
            "ชเนาเซอร์ - Schnauzer",
            "ชาเป่ย - Sharpei",
            "ชิบะ อินุ - Shiba Inu",
            "ชิวาวา - Chihuahua",
            "ชิสุ - Shih-Tzu",
            "เชดแลนด์ชิพด๊อก - Shetland Sheepdog",
            "เชา เชา - Chow Chow",
            "ไชนีส เครสเต็ด - Chinese Crested",
            "ซามอยด์ - Samoyed",
            "เซนต์เบอร์นาร์ด - St. Bernard",
            "ไซบีเรียน ฮัสกี้ - Siberian Husky",
            "ดัลเมเชียน - Dalmatian",
            "ไทยบางแก้ว - Thai Bangkaew",
            "บีเกิล - Beagle",
            "ปอมเมอเรเนียน - Pomeranian",
            "ปักกิ่ง - Pekingese",
            "อื่นๆ"
        ];
        
        $data = [];
        foreach ($types as $key => $value) {
            $data[] = ['name' => $value];
        }

        DB::table('types')->insert($data);
    }
}
