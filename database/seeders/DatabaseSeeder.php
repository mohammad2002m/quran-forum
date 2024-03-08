<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accomplishment;
use App\Models\Activity;
use App\Models\Role;
use App\Models\User;
use App\Models\AnnouncementType;
use App\Models\College;
use App\Models\Excuse;
use App\Models\Execuse;
use App\Models\Group;
use App\Models\Image;
use App\Models\Recitation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use QF\Constants as QFConstants;
use QF\QuestionsAnswers as QFQuestionsAnswers;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DatabaseSeeder::seedActivites();
        DatabaseSeeder::seedImages();
        DatabaseSeeder::seedWeeks();
        DatabaseSeeder::seedColleges();
        DatabaseSeeder::seedRoles();
        DatabaseSeeder::seedGroups();
        DatabaseSeeder::seedUsers();
        DatabaseSeeder::seedAnnouncementTypes();
        DatabaseSeeder::seedRecitation();
        DatabaseSeeder::seedExecuses();
    }
    function seedGroups()
    {
        Group::factory()->create([
            'name' => 'نور الرحمن',
        ]);
        Group::factory()->create([
            'name' => 'أحباب القرآن',
        ]);
        Group::factory()->create([
            'name' => 'نور على نور',
        ]);
        Group::factory()->create([
            'name' => 'أهل الجنة',
        ]);
        Group::factory()->create([
            'name' => 'الصابرين',
        ]);
        Group::factory()->create([
            'name' => 'حفظة القرآن',
        ]);
        Group::factory()->create([
            'name' => 'الطيبات',
        ]);
        Group::factory()->create([
            'name' => 'الإسلام العظيم',
        ]);
        Group::factory()->create([
            'name' => 'بالقرآن نحيا',
        ]);
        Group::factory()->create([
            'name' => 'أصدقاء القرآن',
        ]);
        Group::factory()->create([
            'name' => 'وجلت قلوبهم',
        ]);
        Group::factory()->create([
            'name' => 'علمه البيان',
        ]);
        Group::factory()->create([
            'name' => 'رياض الصالحين',
        ]);
        Group::factory()->create([
            'name' => 'يبشرهم ربهم',
        ]);
        Group::factory()->create([
            'name' => 'همتي لأمتي',
        ]);
        Group::factory()->create([
            'name' => 'بالقرآن نحيا ونرتقي',
        ]);
        Group::factory()->create([
            'name' => 'الإخلاص',
        ]);
        Group::factory()->create([
            'name' => 'سفينة النجاة',
        ]);
        Group::factory()->create([
            'name' => 'أمانينا الجنة',
        ]);
        Group::factory()->create([
            'name' => 'سباق نحو الجنان',
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
        $doesntExist = [86, 97, 105, 138, 148, 150, 205, 207, 224, 226, 245, 246, 262, 285, 286, 298, 303, 332, 333, 346, 359, 394, 414, 422, 438, 462, 463, 470, 489, 540, 561, 578, 587, 589, 592, 595, 597, 601, 624, 632, 636, 644, 647, 673, 697, 706, 707, 708, 709, 710, 711, 712, 713, 714, 720, 725, 734, 745, 746, 747, 748, 749, 750, 751, 752, 753, 754, 759, 761, 762, 763, 771, 792, 801, 812, 843, 850, 854, 895, 897, 899, 917, 920, 934, 956, 963, 968];
        $notAppropriate = [31, 64, 65, 129, 325, 373, 375, 395, 399, 446, 449, 454, 497, 548, 501, 550, 580, 590, 596, 604, 628, 633, 646, 656, 660, 680, 686, 691, 742, 758, 760, 768, 777, 778, 786, 793, 800, 804, 818, 821, 823, 822, 832, 836, 839, 838, 837, 841, 855, 874, 978, 996, 1000];

        for ($id = 1; $id <= 100; $id++) {
            if (in_array($id, $doesntExist) || in_array($id, $notAppropriate)) {
                continue;
            }

            Image::factory()->create([
                "full_path" => "https://picsum.photos/id/$id/400/400",
                "stored" => false,
                "for" => "profile"
            ]);
            Image::factory()->create([
                "full_path" => "https://picsum.photos/id/$id/1200/600",
                "stored" => false,
                "for" => "cover",
            ]);
        }
    }
    public static function seedActivites()
    {
        Activity::factory()->create(
            ['description' => 'إدخال الأسابيع']
        );
        Activity::factory()->create(
            ['description' => 'إقتراح أعلان']
        );
        Activity::factory()->create(
            ['description' => 'نشر إعلان']
        );
        Activity::factory()->create(
            ['description' => 'موافقة إعلان']
        );
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
        $genders = QFQuestionsAnswers::WhatIsYourGender;
        $years = QFQuestionsAnswers::WhatIsYourStudyYear;
        $schedules = QFQuestionsAnswers::WhatIsYourSchedule;
        $majorityFalse = [true, false, false, false, false, false, false, false, false, false];
        $canBeTeacher = [true, false];
        for ($rep = 1; $rep <= 100; $rep++) {
            $num = rand(0, 1);
            $firstName = $num == 0 ? DatabaseSeeder::getRandomMaleName() : DatabaseSeeder::getRandomFemaleName();
            $name = $firstName . ' ' . DatabaseSeeder::getRandomMaleName() . ' ' . DatabaseSeeder::getRandomMaleName();

            $role = rand(1, 15);
            $email = 'test' . strval($rep) . '@gmail.com';

            $user = User::factory()->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('mozart'),
                'gender' => $genders[$num],
                'locked' => $majorityFalse[rand(0, 9)],
                'year' => $years[rand(0, 6)],
                'schedule' => $schedules[rand(0, 2)],
                'can_be_teacher' => $canBeTeacher[rand(0, 1)],
                'force_information_update' => $majorityFalse[rand(0, 9)],
                'tajweed_certificate' => $majorityFalse[rand(0, 9)],
                'college_id' => rand(1, 10),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'phone_number' => '0569' . strval(rand(99999, 999999)),
                'group_id' => strval((($rep - 1) % 20) + 1),
            ]);

            $user->roles()->attach($role);
            $user->roles()->attach(QFConstants::ROLE_STUDENT);
        }

        for ($rep = 0; $rep < Group::all()->count(); $rep++) {
            $group = Group::all()[$rep];
            $group->supervisor_id = $rep + 1;
            $group->monitor_id = $rep + 2;
            $group->save();
        }
    }
    public static function seedAnnouncementTypes()
    {
        AnnouncementType::factory()->create([
            'name' => 'عام',
        ]);
        AnnouncementType::factory()->create([
            'name' => 'الحصاد',
        ]);
        AnnouncementType::factory()->create([
            'name' => 'المسابقات',
        ]);
        AnnouncementType::factory()->create([
            'name' => 'الندوات',
        ]);
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
}
