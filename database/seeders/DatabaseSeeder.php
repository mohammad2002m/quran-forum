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
        DatabaseSeeder::seedAnnouncements();
        DatabaseSeeder::seedRecitation();
    }
    function seedGroups()
    {
        $names = [
            'نور الرحمن',
            'أحباب القرآن',
            'نور على نور',
            'أهل الجنة',
            'الصابرين',
            'حفظة القرآن',
            'الطيبات',
            'الإسلام العظيم',
            'بالقرآن نحيا',
            'أصدقاء القرآن',
            'وجلت قلوبهم',
            'علمه البيان',
            'رياض الصالحين',
            'يبشرهم ربهم',
            'همتي لأمتي',
            'بالقرآن نحيا ونرتقي',
            'الإخلاص',
            'سفينة النجاة',
            'أمانينا الجنة',
            'سباق نحو الجنان',
        ];

        foreach ($names as $name) {
            Group::factory()->create([
                'name' => $name . " ذكور",
                'gender' => "ذكور",
            ]);
            Group::factory()->create([
                'name' => $name . " إناث",
                'gender' => "إناث",
            ]);
        }
    }
    public static function seedRecitation()
    {
        $users = User::all();
        $students = [];

        foreach ($users as $user) {
            $roles = $user->roles;
            if (in_array(QFConstants::ROLE_STUDENT, $roles->pluck('id')->toArray())) {
                $students[] = $user;
            }
        }

        foreach ($students as $student) {
            for ($week_id = 1; $week_id <= 60; $week_id++) {
                $rand = rand(1, 100);
                if ($rand <= 80 && ($student->status != QFConstants::STUDENT_STATUS_FREEZED)) {
                    Recitation::factory()->create([
                        'user_id' => $student->id,
                        'week_id' => $week_id,
                        'memorized_pages' => rand(1, 5),
                        'repeated_pages' => rand(1, 5),
                        'tajweed_mark' => rand(1, 10),
                        'memorization_mark' => rand(1, 10),
                        'notes' => $rand > 50 ? '' : 'ملاحظة' . strval($rand),
                    ]);
                } else {
                    $addExcuse = rand(0, 1);
                    if ($addExcuse === 1) {
                        Excuse::factory()->create([
                            'user_id' => $student->id,
                            'week_id' => $week_id,
                            'status' => ['مقبول', 'مرفوض'][rand(0, 1)],
                            'excuse' => ['لا أستطيع الحضور لظروف خاصة', 'مرض', 'مشكلة مواعيد', 'لا عذر'][rand(0, 3)],
                            'notes' => ['لا ملاحظات', ''][rand(0, 1)]
                        ]);
                    }
                }
            }
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
        $rep = 65;
        while ($rep--) {
            addNextWeek();
        }
    }
    public static function seedImages()
    {

        $width = getimagesize(public_path("images/default/cover.jpg"))[0];
        $height = getimagesize(public_path("images/default/cover.jpg"))[1];

        Image::factory()->create([
            "full_path" => QFConstants::APP_URL . "/images/default/cover.jpg",
            "stored" => false,
            "for" => "cover",
            "width" => $width,
            "height" => $height,
        ]);

        $width = getimagesize(public_path("images/default/profile.jpg"))[0];
        $height = getimagesize(public_path("images/default/profile.jpg"))[1];

        Image::factory()->create([
            "full_path" => QFConstants::APP_URL . "/images/default/profile.jpg",
            "stored" => false,
            "for" => "profile",
            "width" => $width,
            "height" => $height,
        ]);

        for ($c = 1; $c <= 20; $c++) {
            // get image width and height from full_path
            $width = getimagesize(public_path("images/$c.jpg"))[0];
            $height = getimagesize(public_path("images/$c.jpg"))[1];


            Image::factory()->create([
                "full_path" =>  QFConstants::APP_URL . "/images/$c.jpg",
                "stored" => false,
                "for" => "announcement",
                "width" => $width,
                "height" => $height,
            ]);
        }
        for ($c = 1; $c <= 10; $c++) {
            // get image width and height from full_path
            $width = getimagesize(public_path("images/cover-$c.jpg"))[0];
            $height = getimagesize(public_path("images/cover-$c.jpg"))[1];


            Image::factory()->create([
                "full_path" =>  QFConstants::APP_URL . "/images/cover-$c.jpg",
                "stored" => false,
                "for" => "cover",
                "width" => $width,
                "height" => $height,
            ]);
        }
        for ($c = 1; $c <= 10; $c++) {
            // get image width and height from full_path
            $width = getimagesize(public_path("images/profile-$c.jpg"))[0];
            $height = getimagesize(public_path("images/profile-$c.jpg"))[1];


            Image::factory()->create([
                "full_path" =>  QFConstants::APP_URL . "/images/profile-$c.jpg",
                "stored" => false,
                "for" => "profile",
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

        $emails = [
            'quran.forum.hu@gmail.com',
            'sub.head@gmail.com',
            'supervisor@gmail.com',
            'monitor@gmail.com',
            'tajweed@gmail.com',
            'media@gmail.com',
            'student.manager.male@gmail.com',
            'student.manager.female@gmail.com',
            'data@gmail.com',
        ];

        $role_to_attach = [
            QFConstants::ROLE_HEAD,
            QFConstants::ROLE_VICE_HEAD,
            QFConstants::ROLE_SUPERVISOR,
            QFConstants::ROLE_MONITORING_COMMITTE_MEMBER,
            QFConstants::ROLE_TAJWEED_COMMITTE_MANAGER,
            QFConstants::ROLE_MEDIA_COMMITTE_MEMBER,
            QFConstants::ROLE_STUDENTS_MANAGER,
            QFConstants::ROLE_STUDENTS_MANAGER,
            QFConstants::ROLE_DATA_COMMITTE_MEMBER
        ];

        $names = [
            'رئيس ملتقى القرآن الكريم',
            'نائب رئيس ملتقى القرآن الكريم',
            'مشرف',
            'عضو لجنة متابعة',
            'مسؤول التجويد',
            'مسؤول لجنة إعلامية',
            'مسؤول الطلاب للذكور',
            'مسؤول الطلاب للإناث',
            'مسؤول لجنة البيانات',
        ];

        $phone_numbers = [
            '0599122476',
            '0592122486',
            '0593122459',
            '0594121451',
            '0595153452',
            '0596153456',
            '0597123456',
            '0598123456',
            '0599123456'
        ];

        $genders = ['ذكر', 'ذكر', 'ذكر', 'ذكر', 'ذكر', 'ذكر', 'ذكر', 'أنثى', 'أنثى'];

        $years = ['خريج', 'أولى', 'ثانية', 'ثالثة', 'رابعة', 'خامسة', 'خريج', 'خريج', 'أولى'];

        $statuses = ["نشط/ة", "نشط/ة", "نشط/ة", "نشط/ة", "نشط/ة", "مجمد/ة",  "مجمد/ة", null, null, null];

        $schedules = [
            'مستقرة بالحرم الجامعي',
            'تدريب خارج الجامعة',
            'أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة',
            'مستقرة بالحرم الجامعي',
            'تدريب خارج الجامعة',
            'أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة',
            'أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة',
            'مستقرة بالحرم الجامعي',
            'مستقرة بالحرم الجامعي',
        ];

        $students_numbers = [
            '22011233',
            '22012233',
            '22013233',
            '22014233',
            '22015233',
            '22016233',
            '22017233',
            '22018233',
            '22019233',
        ];

        $can_be_teachers = [true, false, true, false, false, true, true, true, false];

        $tajweed_certificates = [true, false, false, false, true, false, false, true, false];
        $banned = [false, false, false, false, true, false, false, true, false];

        $force_information_update = [true, true, false, false, true, false, false, true, false];

        $view_notify_on_landing_page = [true, true, false, false, true, false, false, true, false];

        $college_ids = [1, 2, 3, 4, 5, 6, 7, 8, 9];


        for ($i = 0; $i < 9; $i++) {
            $user = User::create([
                'email' => $emails[$i],
                'password' => bcrypt('mozart'), // You may want to use a stronger password hashing mechanism
                'name' => $names[$i],
                'phone_number' => $phone_numbers[$i],
                'gender' => $genders[$i],
                'year' => $years[$i],
                'status' => $statuses[$i],
                'student_number' => $students_numbers[$i],
                'schedule' => $schedules[$i],
                'can_be_teacher' => $can_be_teachers[$i],
                'tajweed_certificate' => $tajweed_certificates[$i],
                'banned' => $banned[$i],
                'force_information_update' => $force_information_update[$i],
                'view_notify_on_landing_page' => $view_notify_on_landing_page[$i],
                'college_id' => $college_ids[$i],
                'group_id' => null,
                'cover_image_id' => 1,
                'profile_image_id' => 2,
                'email_verified_at' => '2024-01-01 00:00:00',
            ]);

            $user->roles()->attach($role_to_attach[$i]);
        }

        // add more students using factory
        User::factory()->count(60)->create();

        $group_male_ids = Group::where('gender', "ذكور")->pluck('id')->toArray();
        $group_female_ids = Group::where('gender', "إناث")->pluck('id')->toArray();
        foreach (User::all() as $user) {
            if ($user->status) {
                $user->roles()->attach(QFConstants::ROLE_STUDENT);
                $rand = rand(1, 10);
                if ($rand > 1) {
                    if ($user->gender == "ذكر") {
                        $group_ids = $group_male_ids;
                    } else {
                        $group_ids = $group_female_ids;
                    }
                    $user->group_id = $group_ids[rand(0, count($group_ids) - 1)];
                    $user->save();
                }
            }
        }

        $supervisors = User::factory()->count(50)->create();
        foreach ($supervisors as $supervisor) {
            $supervisor->roles()->attach(QFConstants::ROLE_SUPERVISOR);
        }
        $monitors = User::factory()->count(50)->create();
        foreach ($monitors as $monitor) {
            $monitor->roles()->attach(QFConstants::ROLE_MONITORING_COMMITTE_MEMBER);
        }
        // create supervisors  and assign them to groups

    }
    public static function seedAnnouncementTypes()
    {
        AnnouncementType::factory()->create(["name" => "عام",]);
        AnnouncementType::factory()->create(['name' => "الحصاد",]);
        AnnouncementType::factory()->create(['name' => "مسابقات",]);
        AnnouncementType::factory()->create(['name' => "لقاءات إلكترونية",]);
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
    public static function seedAnnouncements()
    {


        $descriptions = [
            "لا يَزالُ قارئُ القُرآنِ فِي جنةٍ مِن الدُّنيا ما دامَ يَسـقي قِلبهُ معينَ الآياتْ ، ويَترنمُ بكلامِ ربّ البرياتْ ، إنَّه يَسير بين النَّاس فِي الأرضِ ، أمَّا الروحُ فَسماويةٌ تُرفرفُ هناكْ .  ",
            "ستُنسيك لذّة ختم القرآن كلّ لحظات المجاهدة والمُصابرة والتخفّف من المُلهيات ابتغاء ضبط الآيات؛ فتصبّر حتى تقرّ عينك ويكتسي قلبك حلّة الثلاثين نورًا",
            "أما وآن الأوان للقناديل أن تشعّ نورًا.. 💫
                نوافيكم مشاركي مسابقة قناديل النور ٢ بمواعيد الاختبار بناء على المستوى الذي شاركتم به.
                اسرجوا قناديلكم، الهمة الهمة، وحُسن الاستعداد للاختبار، والله ولي التوفيق وحسبكم أن الأجر عليه!",
            "عن عائشة رضي اللَّه عنها أنها قالت: «كان رسولُ اللَّه صَلّى اللهُ عَلَيْهِ وسَلَّم إذَا دَخَلَ الْعشْرُ أحيا اللَّيْلَ، وأيقظ أهْله، وجدَّ وشَدَّ المِئْزَرَ»
            ندعوكم لحضور ندوتنا الرّمضانية الثالثة،حول فضل العشر الأواخر من شهرنا الكريم.",
            "قضىٰ الله بحكمته أنَّ الصبر قرين الفرج، وأن العسر لا يغلب يسرين؛ وإنما هذه البلاءات مُربيات لعباد الله المؤمنين قبل تمكينهم بإذن الله!
            أهل الملتقى الكرام ندعوكم لحضور ندوتنا الرّمضانية الثانية، بعنوان: (لن تُمكن حتى تُبتلى)
            #ملتقى_القرآن_الكريم_جامعة_الخليل",

            "جاءت أعظم آية في الدعاء بعد ذكر الصوم، تنبِئ عن قرب الله سبحانه، ووعده بإجابة الداعي، ولتبين مكانة الدعاء أيام الصيام.🍃",
            "فَتدبَّرِ القُرآنَ إِن رُمتَ الهُدى 
            فالعِلمُ تحتَ تَدبُّرِ القُرآنِ..🌙
            •صَحب المُلتقى ومن يَطيب بهم اللقا؛ ندعوكم لحضور ندوتنا الأولى في شهر رَمضان المبـارَك؛
            وأفضل ما نبدأ به هذه العبادة العظيمة هو تدبر كلام الله عنها، مع الدكتور الفاضل تيسـير الدويـك. ",
        ];

        $titles = [
            "الحصاد الأسبوعي للأسبوع الرابع",
            "الحصاد الأسبوعي للأسبوع الثالث",
            "إعلان مسابقة قناديل النور",
            "ندوة فضل العشر الأواخر",
            "ندوة لن تُمكن حتى تُبتلى",
            "ندوة تدبر القرآن",
            "ندوة الدعاء في رمضان",
        ];

        $images_ids = Image::where('for', 'announcement')->pluck('id')->toArray();
        $types_ids = AnnouncementType::all()->pluck('id')->toArray();
        for ($rep = 0; $rep < 50; $rep++) {
            Announcement::factory()->create([
                // random title
                'title' => $titles[$rep % 7],
                'description' => $descriptions[$rep % 7],
                'status' => QFConstants::ANNOUNCEMENT_STATUS_APPROVED,
                'type_id' => $types_ids[$rep % 4],
                'image_id' => $images_ids[($rep % 20)],
            ]);
        }
    }
}
