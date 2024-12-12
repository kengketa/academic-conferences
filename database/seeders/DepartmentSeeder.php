<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = Department::factory()->create([
            'name' => 'คณะวิทยาการจัดการ'
        ]);
        $majors = [
            "การบริหารทรัพยากรมนุษย์",
            "คอมพิวเตอร์ธุรกิจ",
            "การจัดการธุรกิจการค้าสมัยใหม่",
            "การจัดการโลจิสติกส์และซัพพลายเชน",
            "การตลาด (แขนงวิชาดิจิทัลมาร์เกตติง)",
            "การตลาด (แขนงวิชาอิเวนต์มาร์เกตติง)",
            "การบัญชี",
            "การท่องเที่ยว"
        ];
        foreach ($majors as $major) {
            Major::factory()->create([
                'department_id' => $department->id,
                'name' => $major
            ]);
        }
        $department = Department::factory()->create([
            'name' => 'คณะครุศาสตร์'
        ]);
        $majors = [
            "คณิตศาสตร์",
            "วิทยาศาสตร์",
            "สังคมศึกษา",
            "การศึกษาปฐมวัย",
            "คอมพิวเตอร์ศึกษา",
            "พลศึกษา",
            "การสอนภาษาไทย",
            "การสอนภาษาอังกฤษ",
            "การประถมศึกษา",
            "การศึกษาพิเศษและการสอนภาษาไทย"
        ];
        foreach ($majors as $major) {
            Major::factory()->create([
                'department_id' => $department->id,
                'name' => $major
            ]);
        }

        $department = Department::factory()->create([
            'name' => 'คณะมนุษยศาสตร์และสังคมศาสตร์'
        ]);
        $majors = [
            "นาฏศิลป์ศึกษา",
            "ศิลปศึกษา",
            "ดนตรีศึกษา",
            "นิติศาสตร์",
            "นิเทศศาสตร์ดิจิทัล",
            "การจัดการรัฐกิจและการปกครองท้องถิ่น",
            "รัฐประศาสนศาสตร์",
            "ดนตรีสร้างสรรค์",
            "ภาษาอังกฤษ",
            "ภาษาไทย",
            "ภาษาญี่ปุ่น",
            "ประวัติศาสตร์",
            "การพัฒนาชุนชนและสังคม",
            "สหวิทยาการเพื่อการจัดการฮาลาล"
        ];
        foreach ($majors as $major) {
            Major::factory()->create([
                'department_id' => $department->id,
                'name' => $major
            ]);
        }

        $department = Department::factory()->create([
            'name' => 'คณะวิทยาศาสตร์และเทคโนโลยี'
        ]);
        $majors = [
            "วิทยาศาสตร์ศึกษา (แขนงวิชาฟิสิกส์)",
            "วิทยาศาสตร์ศึกษา (แขนงวิชาเคมี)",
            "วิทยาศาสตร์ศึกษา (แขนงวิชาชีววิทยา)",
            "เทคโนโลยีอุตสาหกรรม (วิชาเอก การจัดการเทคโนโลยีอุตสาหกรรม)",
            "เทคโนโลยีอุตสาหกรรม (วิชาเอก เทคโนโลยีระบบควบคุมการผลิตอัตโนมัติ)",
            "เกษตรศาสตร์",
            "เคมี",
            "วิทยาการคอมพิวเตอร์",
            "เทคโนโลยีสารสนเทศ",
            "อาชีวอนามัยและความปลอดภัย",
            "จุลชีววิทยา",
            "คหกรรมศาสตร์",
            "คณิตศาสตร์ประยุกต์",
            "วิทยาศาสตร์และการจัดการเทคโนโลยีอาหาร",
            "เทคโนโลยีการเกษตรสมัยใหม่",
            "เทคโนโลยีสิ่งแวดล้อม",
            "สาธารณสุขศาสตร์",
            "วิศวกรรมไฟฟ้า",
            "วิศวกรรมการจัดการ"
        ];
        foreach ($majors as $major) {
            Major::factory()->create([
                'department_id' => $department->id,
                'name' => $major
            ]);
        }
    }
}
