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
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DatabaseSeeder::seedActivites();
        // DatabaseSeeder::seedAccomplishments();
        DatabaseSeeder::seedColleges();
        DatabaseSeeder::seedRoles();
        DatabaseSeeder::seedUsers();
        DatabaseSeeder::seedAnnouncementTypes();
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
