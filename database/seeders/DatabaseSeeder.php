<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accomplishment;
use App\Models\Activity;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\AnnouncementType;
use App\Models\College;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DatabaseSeeder::seedActivites();
        DatabaseSeeder::seedImages();
        // DatabaseSeeder::seedAccomplishments();
        DatabaseSeeder::seedColleges();
        DatabaseSeeder::seedRoles();
        DatabaseSeeder::seedUsers();
        DatabaseSeeder::seedAnnouncementTypes();
    }
    public static function seedImages(){
        $doesntExist = [86, 97, 105, 138, 148, 150, 205, 207, 224, 226, 245, 246, 262, 285, 286, 298, 303, 332, 333, 346, 359, 394, 414, 422, 438, 462, 463, 470, 489, 540, 561, 578, 587, 589, 592, 595, 597, 601, 624, 632, 636, 644, 647, 673, 697, 706, 707, 708, 709, 710, 711, 712, 713, 714, 720, 725, 734, 745, 746, 747, 748, 749, 750, 751, 752, 753, 754, 759, 761, 762, 763, 771, 792, 801, 812, 843, 850, 854, 895, 897, 899, 917, 920, 934, 956, 963, 968];
        $notAppropriate = [31, 64, 65, 129, 325, 373, 375, 395, 399, 446, 449, 454, 497, 548, 501, 550, 580, 590, 596, 604, 628, 633, 646, 656, 660, 680, 686, 691, 742, 758, 760, 768, 777, 778, 786, 793, 800, 804, 818, 821, 823, 822, 832, 836, 839, 838, 837, 841, 855, 874, 978, 996, 1000];

        for ($id = 1; $id <= 100; $id++){
            if (in_array($id, $doesntExist) || in_array($id, $notAppropriate)){
                continue;
            }

            Image::factory() -> create([
                "full_path" => "https://picsum.photos/id/$id/400/400",
                "stored" => false,
                "for" => "profile"
            ]);
            Image::factory() -> create([
                "full_path" => "https://picsum.photos/id/$id/1200/600",
                "stored" => false,
                "for" => "cover",
            ]);
        }
    }
    public static function seedUsersRoles(){
        RoleUser::factory() -> create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
        RoleUser::factory() -> create([
            'user_id' => 2,
            'role_id' => 6,
        ]);
    }
    public static function seedActivites(){
        Activity::factory() -> create(
            [ 'description' => 'إدخال الأسابيع' ]
        );
        Activity::factory() -> create(
            [ 'description' => 'إقتراح أعلان' ]
        );
        Activity::factory() -> create(
            [ 'description' => 'نشر إعلان' ]
        );
        Activity::factory() -> create(
            [ 'description' => 'موافقة إعلان' ]
        );
    }

    public static function seedColleges(){
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
        foreach($colleges as $college){
            College::factory()->create([
                'name' => $college
            ]);
        }
    }
    public static function seedAccomplishments(){
        Accomplishment::factory() -> create([
            [
                'name' => 'حفظ الجزء الأول',
                'rating' => 2,
            ]
        ]);
        Accomplishment::factory() -> create([
            [
                'name' => 'حفظ جزء عمة',
                'rating' => 1,
            ]
        ]);
        Accomplishment::factory() -> create([
            [
                'name' => 'حفظ القرآن كاملًا',
                'rating' => 40,
            ]
        ]);
        Accomplishment::factory() -> create([
            [
                'name' => 'حفظ خمس أجزاء',
                'rating' => 10,
            ]
        ]);
    }
    public static function seedUsers()
    {

        User::factory()->create([
            'name' => 'محمد الشريف',
            'email' => 'mohammed.alshareef2002@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'أولى',
            'status' => 1,
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
        User::factory()->create([
            'name' => 'محمد الشريف',
            'email' => 'a@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'أولى',
            'status' => 1,
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'محمد الشريف',
            'email' => 'b@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'خريج',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'محمد الشريف',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'mohammdd',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'bilal',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'saleem',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'kareem',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'motaz',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'mozart',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'osama',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'monatser',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'anas',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'raed',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'amjad',
            'email' => 'c@gmail.com',
            'phone_number' => '0569171474',
            'gender' => 'ذكر',
            'password' => bcrypt('mozart'),
            'locked' => false,
            'year' => 'ثالثة',
            'schedule' => 'خارج الجامعة',
            'can_be_teacher' => false,
            'first_login' => false,
            'tajweed_certificate' => false,
            'college_id' => 1,
        ]);
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
    public static function seedPlans(){
    }
}
