<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accomplishment;
use App\Models\Announcement;
use App\Models\Role;
use App\Models\User;
use App\Models\AnnouncementType;
use App\Models\College;
use App\Models\Excuse;
use App\Models\Group;
use App\Models\Image;
use App\Models\Recitation;
use Illuminate\Database\Seeder;
use QF\Constants as QFConstants;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DatabaseSeeder::seedImages();
        DatabaseSeeder::seedWeeks();
        DatabaseSeeder::seedColleges();
        DatabaseSeeder::seedRoles();
        DatabaseSeeder::seedGroups();
        DatabaseSeeder::seedUsers();
        DatabaseSeeder::seedAnnouncementTypes();
    }
    function seedGroups()
    {
        Group::factory()->create([
            'name' => 'نور الرحمن',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'أحباب القرآن',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'نور على نور',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'أهل الجنة',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'الصابرين',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'حفظة القرآن',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'الطيبات',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'الإسلام العظيم',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'بالقرآن نحيا',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'أصدقاء القرآن',
            'gender' => "ذكور"
        ]);
        Group::factory()->create([
            'name' => 'وجلت قلوبهم',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'علمه البيان',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'رياض الصالحين',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'يبشرهم ربهم',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'همتي لأمتي',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'بالقرآن نحيا ونرتقي',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'الإخلاص',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'سفينة النجاة',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'أمانينا الجنة',
            'gender' => "إناث"
        ]);
        Group::factory()->create([
            'name' => 'سباق نحو الجنان',
            'gender' => "إناث"
        ]);

    }
    public static function seedRecitation()
    {
        for ($rep = 1; $rep <= 500; $rep++) {
            Recitation::factory()->create([
                'user_id' => ($rep % 100) + 1,
                'week_id' => rand(1, 10),
                'memorized_pages' => rand(1, 5),
                'repeated_pages' => rand(1, 5),
                'tajweed_mark' => rand(1, 10),
                'memorization_mark' => rand(1, 10),
                'notes' => ''
            ]);
        }
    }
    public static function seedExecuses()
    {
        for ($rep = 1; $rep <= 200; $rep++) {
            Excuse::factory()->create([
                'user_id' => ($rep % 100) + 1,
                'week_id' => rand(1, 10),
                'status' => ['مقبول', 'مرفوض'][rand(0, 1)],
                'excuse' => ['لا أستطيع الحضور لظروف خاصة', 'مرض', 'مشكلة مواعيد', 'لا عذر'][rand(0, 3)],
                'notes' => ['لا ملاحظات', ''][rand(0, 1)]
            ]);
        }
    }
    public static function seedWeeks()
    {
        addFirstWeek();
        $rep = 60;
        while ($rep--) {
            addNextWeek();
        }
    }
    public static function seedImages()
    {
        
        $width = getimagesize(public_path("images/default/cover.jpg"))[0];
        $height = getimagesize(public_path("images/default/cover.jpg"))[1];

        Image::factory()->create([
            "full_path" => "http://localhost:8000/images/default/cover.jpg",
            "stored" => false,
            "for" => "cover",
            "width" => $width,
            "height" => $height,
        ]);

        $width = getimagesize(public_path("images/default/profile.jpg"))[0];
        $height = getimagesize(public_path("images/default/profile.jpg"))[1];

        Image::factory()->create([
            "full_path" => "http://localhost:8000/images/default/profile.jpg",
            "stored" => false,
            "for" => "profile",
            "width" => $width,
            "height" => $height,
        ]);

        for ($c = 1; $c <= 20; $c++){
            // get image width and height from full_path
            $width = getimagesize(public_path("images/$c.jpg"))[0];
            $height = getimagesize(public_path("images/$c.jpg"))[1];


            Image::factory()->create([
                "full_path" => "http://localhost:8000/images/$c.jpg",
                "stored" => false,
                "for" => "announcement",
                "width" => $width,
                "height" => $height,
            ]);
        }
    }

    public static function seedColleges()
    {
        $colleges = [
            'الطب',
            'الشريعة',
            'العلوم التكنولوجيا',
            'التربية',
            'التمريض',
            'تكنولوجيا المعلومات',
            'التمويل والإدارة',
            'الصيدلة والعلوم الطبية',
            'الآداب',
            'الحقوق والعلوم السياسية',
            'الزراعة',
            'المهن والعلوم التطبيقية',
            'الدراسات العليا',

        ];
        foreach ($colleges as $college) {
            College::factory()->create([
                'name' => $college
            ]);
        }
    }
    public static function seedAccomplishments()
    {
        Accomplishment::factory()->create([
            [
                'name' => 'حفظ الجزء الأول',
                'rating' => 2,
            ]
        ]);
        Accomplishment::factory()->create([
            [
                'name' => 'حفظ جزء عمة',
                'rating' => 1,
            ]
        ]);
        Accomplishment::factory()->create([
            [
                'name' => 'حفظ القرآن كاملًا',
                'rating' => 40,
            ]
        ]);
        Accomplishment::factory()->create([
            [
                'name' => 'حفظ خمس أجزاء',
                'rating' => 10,
            ]
        ]);
    }
    public static function getRandomMaleName()
    {
        $names = ['محمد', 'أحمد', 'عبد الله', 'عبد الرحمن', 'عبد العزيز', 'عبد اللطيف', 'عبد الحميد', 'عبد الكريم', 'عبد الوهاب', 'عبد الرزاق', 'عبد الرؤوف', 'عبد الرحيم', 'عبد السلام', 'عبد الصمد', 'عبد الصمد'];
        return $names[rand(0, count($names) - 1)];
    }
    public static function getRandomFemaleName()
    {
        $names = ['مريم', 'فاطمة', 'خديجة', 'عائشة', 'زينب', 'سمية', 'سميرة', 'سمر', 'سمراء', 'شهد', 'شيماء', 'شيماء', 'شيرين', 'تسنيم', 'طيبة'];
        return $names[rand(0, count($names) - 1)];
    }
    public static function seedUsers()
    {
        User::factory() -> count(20) -> create();
        foreach (User::all() as $user) {
            // for the ones who has status add roles student to them
            if ($user->status) {
                $user->roles()->attach(QFConstants::ROLE_STUDENT);
            }
        }

        // seed head
        $user = User::factory()->create([
            'email' => 'head@gmail.com',
            'password' => bcrypt('mozart'), // You may want to use a stronger password hashing mechanism
            'name' => 'رئيس ملتقى القرآن الكريم',
            'phone_number' => '0599123456',
            'gender' => "ذكر",
            'year' => "خريج",
            'status' => "نشط",
            'student_number' => '22011233',
            'schedule' => "تدريب خارج الجامعة",
            'can_be_teacher' => true,
            'tajweed_certificate' => true,
            'locked' => false,
            'force_information_update' => false,
            'view_notify_on_landing_page' => true,
            'college_id' => 1,
            'group_id' => null,
            'cover_image_id' => 1,
            'profile_image_id' => 2,
            'email_verified_at' => '2024-01-01 00:00:00',
        ]);

        $user -> roles() -> attach(QFConstants::ROLE_HEAD);
    }
    public static function seedAnnouncementTypes()
    {
        AnnouncementType::factory()->create([ "name" => "عام", ]);
        AnnouncementType::factory()->create([ 'name' => "الحصاد", ]);
        AnnouncementType::factory()->create([ 'name' => "المسابقات", ]);
        AnnouncementType::factory()->create([ 'name' => "لقاءات إلكترونية", ]);
    }
    public static function seedRoles()
    {
        Role::factory()->create([
            'id' => 1,
            'name' => 'الرئيس'
        ]);
        Role::factory()->create([
            'id' => 2,
            'name' => 'نائب الرئيس'
        ]);

        Role::factory()->create([
            'id' => 3,
            'name' => 'طالب'
        ]);
        Role::factory()->create([
            'id' => 4,
            'name' => 'مشرف'
        ]);
        Role::factory()->create([
            'id' => 5,
            'name' => 'مسؤول الطلاب'
        ]);

        Role::factory()->create([
            'id' => 6,
            'name' => 'اللجنة الإعلامية'
        ]);
        Role::factory()->create([
            'id' => 7,
            'name' => 'لجنة البيانات'
        ]);
        Role::factory()->create([
            'id' => 8,
            'name' => 'الهيئة الرقابية'
        ]);
        Role::factory()->create([
            'id' => 9,
            'name' => 'الأمين العام'
        ]);
        Role::factory()->create([
            'id' => 10,
            'name' => 'أمين الصندوق'
        ]);

        Role::factory()->create([
            'id' => 11,
            'name' => 'لجنة الاختبار'
        ]);
        Role::factory()->create([
            'id' => 12,
            'name' => 'لجنة التجويد'
        ]);
        Role::factory()->create([
            'id' => 13,
            'name' => 'لجنة المتابعة'
        ]);

        Role::factory()->create([
            'id' => 14,
            'name' => 'مسؤول لجنة الاختبار'
        ]);
        Role::factory()->create([
            'id' => 15,
            'name' => 'مسؤول لجنة التجويد'
        ]);
        Role::factory()->create([
            'id' => 16,
            'name' => 'مسؤول لجنة المتابعة'
        ]);
    }
    public static function seedPlans()
    {
    }
    public static function seedAnnouncements(){
        for ($rep = 1; $rep <= 100; $rep++){
            $announcement = Announcement::factory()->create([
                'title' => 'إعلان رقم ' . strval($rep),
                'description' => 'هذا الإعلان رقم ' . strval($rep),
                'status' => QFConstants::ANNOUNCEMENT_STATUS_APPROVED,
                'type_id' => rand(1, 4),
                'image_id' => rand(1, 13),
            ]);
        }
    }
}
