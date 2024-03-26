<?php

namespace QF;

class Constants {
    const APP_URL = 'http://localhost:8000';

    /******** ROLES:SHOULD MATCH THE DATABASE ********/
    const ROLE_HEAD = 1;
    const ROLE_VICE_HEAD = 2;
    const ROLE_STUDENT = 3;
    const ROLE_SUPERVISOR = 4;
    const ROLE_STUDENTS_MANAGER = 5;
    const ROLE_MEDIA_COMMITTE_MEMBER = 6;
    const ROLE_DATA_COMMITTE_MEMBER = 7;
    const ROLE_RAQABA = 8;
    const ROLE_SECRETARY_GENERAL = 9;
    const ROLE_TREASURER = 10;
    const ROLE_EXAMINING_COMMITTE_MEMBER = 11;
    const ROLE_TAJWEED_COMMITTE_MEMBER = 12;
    const ROLE_MONITORING_COMMITTE_MEMBER = 13;
    const ROLE_EXAMINING_COMMITTE_MANAGER = 14;
    const ROLE_TAJWEED_COMMITTE_MANAGER = 15;
    const ROLE_MONITORING_COMMITTE_MANAGER = 16;

    /******** ROUTE NAMES ********/
    const ROUTE_NAME_ATTEMPT_LOGIN = 'attempt.login';
    const ROUTE_NAME_ATTEMPT_LOGOUT = 'attempt.logout';
    const ROUTE_NAME_HOME_PAGE = 'home';
    const ROUTE_NAME_REGISTER_PAGE = 'register';
    const ROUTE_NAME_LOGIN_PAGE = 'login';
    const ROUTE_NAME_STORE_ANNOUNCEMENT = 'store.announcement';
    const ROUTE_NAME_CREATE_ANNOUNCEMENT_PAGE = 'create.announcement';
    const ROUTE_NAME_SHOW_ANNOUNCEMENT = 'show.announcement';
    const ROUTE_NAME_ABOUT_PAGE = 'about';
    const ROUTE_NAME_RULES_PAGE = 'rules';
    const ROUTE_NAME_CONTACTS_US_PAGE = 'contacts_us';
    const ROUTE_NAME_EDIT_WEEK_PAGE = 'edit.week';
    const ROUTE_NAME_UPDATE_WEEK = 'update.week';
    const ROUTE_NAME_STORE_WEEK = 'store.week';
    
    const ROUTE_NAME_RESET_PASSWORD_PAGE = 'password.reset';
    const ROUTE_NAME_RESET_PASSWORD_SUBMIT = 'password.reset.submit';

    const ROUTE_NAME_FORGOT_PASSWORD_PAGE = 'forgot.password';
    const ROUTE_NAME_FORGOT_PASSWORD_SUBMIT = 'forgot.password.submit';

    const ROUTE_NAME_NOTIFICATION_NOTICE = 'verification.notice';
    const ROUTE_NAME_VERIFY_EMAIL = 'verification.verify';
    const ROUTE_NAME_RESEND_VERIFICATION_EMAIL = 'verification.send';


    const ROUTE_NAME_MONITORING_INDEX = 'monitoring.index';
    const ROUTE_NAME_MONITORING_UPDATE = 'monitoring.update';

    const ROUTE_NAME_RECITATION_INDEX = 'recitation.index';
    const ROUTE_NAME_RECITATION_UPDATE = 'recitation.update';
    
    const ROUTE_NAME_MESSAGES_INDEX = 'messages.index';
    const ROUTE_NAME_MESSAGES_SHOW = 'messages.show';


    const ROUTE_NAME_API_WEEKLY_REPORT = 'api.reports.report';
    const ROUTE_NAME_API_WEEKS = 'api.weeks';
    const ROUTE_NAME_API_EXECUSES = 'api.execuses';
    const ROUTE_NAME_API_RECITATIONS = 'api.recitations';
    const ROUTE_NAME_API_SUPERVISORS = 'api.supervisors';

    const ROUTE_NAME_UNAUTHORIZED = 'unauthorized';

    const ROUTE_NAME_ARCHIVED_ANNOUNCEMENTS = 'annoucnement.archived.index';
    const ROUTE_NAME_REGISTRATION_GUIDE = 'registration.guide';
    const ROUTE_NAME_STUDNET_REGISTER_PAGE = 'registration.student';
    const ROUTE_NAME_STUDNET_REGISTER_SUBMIT = 'registration.student.submit';
    const ROUTE_NAME_VOLUNTEER_REGISTER_PAGE = 'registration.volunteer';
    const ROUTE_NAME_VOLUNTEER_REGISTER_SUBMIT = 'registration.volunteer.submit';

    const ROUTE_NAME_PROFILE_INDEX = 'profile.index';
    const ROUTE_NAME_PROFILE_EDIT = 'profile.edit';
    const ROUTE_NAME_PROFILE_UPDATE = 'profile.update';
    const ROUTE_NAME_PROFILE_CHANGE_COVER_IMAGE = 'profile.change.cover.image';
    const ROUTE_NAME_PROFILE_CHANGE_PROFILE_IMAGE = 'profile.change.profile.image';
    const ROUTE_NAME_MANAGEMENT_INDEX = 'management.index';

    const ROUTE_NAME_FORCE_INFORMATION_UPDATE_FORCE = 'force-information-update.force';
    const ROUTE_NAME_FORCE_INFORMATION_UPDATE_INDEX = 'force-information-update.index';
    const ROUTE_NAME_FORCE_INFORMATION_UPDATE_UPDATE  = 'force-information-update.update';

    const ROUTE_NAME_GROUP_INDEX = 'group.index';
    const ROUTE_NAME_GROUP_STORE = 'group.store';
    const ROUTE_NAME_REPORTS_INDEX = 'reports.index';

    const ROUTE_NAME_API_GET_ANNOUNCEMENTS = 'api.announcements';

    /******** EXTRA ********/
    const MAX_WEEKS_ALLOWED = 10; // max number of extra years to add on current year date
    const WEEK_RANGE = 3;
    
    /******** ANNOUNCEMENT STATUSES ********/
    const ANNOUNCEMENT_STATUS_APPROVED = 1;
    const ANNOUNCEMENT_STATUS_REJECTED = 2;
    const ANNOUNCEMENT_STATUS_PENDING = 3;
    const ANNOUNCEMENT_STATUS_DELETED = 4;
    
    /******** ANNOUNCEMENT TYPES:SHOULD MATCH THE DATABASE ********/
    const ANNOUNCEMENT_TYPE_GENERAL = 1;
    const ANNOUNCEMENT_TYPE_WEEKLY_REPORT = 2;
    const ANNOUNCEMENT_TYPE_CONTEST = 3;
    const ANNOUNCEMENT_TYPE_SEMINAR = 4;

    /******** ERROR MESSAGES ********/
    const ERROR_MESSAGE_INVALID_CREDINTIALS = 'كلمة المرور أو البريد الإلكتروني خاطئ';

    /******** SUCCESS MESSAGES ********/
    const SUCCESS_MESSAGE_SAVED_SUCCESSFULLY = 'تم الحفظ بنجاح';
    const SUCCESS_MESSAGE_WEEKS_ADDED = 'تم إضافة 53 أسبوعًا بنجاح';

    /******** STUDENTS STATUSES ********/
    const STUDENT_STATUS_ACTIVE = 'نشط';
    const STUDENT_STATUS_FREEZED = 'مجمد';
    const STUDENT_STATUS_STOPPED = 'موقوف';
    const STUDENT_STATUS_LEFT = 'منسحب';

    const STUDENT_STATUSES = [
        self::STUDENT_STATUS_ACTIVE,
        self::STUDENT_STATUS_FREEZED,
        self::STUDENT_STATUS_STOPPED,
        self::STUDENT_STATUS_LEFT,
    ];


    /******** ACTIVITIES:SHOULD MATCH THE DATABASE ********/
    const ACTIVITY_CREATE_ANNOUNCEMENT = 1;
    const ACTIVITY_APPROVE_ANNOUNCEMENT = 2;
    const ACTIVITY_MANAGE_WEEKS = 3;
    const ACTIVITY_RECITATION = 4;
    const ACTIVITY_MONITORING = 5;
    const ACTIVITY_REPORTS = 6;
    const ACTIVITY_GET_SUPERVISORS = 7;
    const ACTIVITY_MANAGE_GROUPS = 8;
    const ACTIVITY_MANAGE_FORUM = 9;

    const ACTIVITY_API_WEEKS = 10;
    const ACTIVITY_API_EXECUSES = 11;
    const ACTIVITY_API_RECITATIONS = 12;
    const ACTIVITY_API_SUPERVISORS = 13;
    const ACTIVITY_API_ANNOUNCEMENTS = 14;

    /******** IMAGES TYPES ********/
    const SUPPORTED_IMAGES_EXTENSIONS = ['jpg', 'jpeg', 'png'];

    /******** IMAGES FOR VALUES ********/
    const IMAGE_FOR_COVER = 'cover';
    const IMAGE_FOR_PROFILE = 'profile';
    const IMAGE_FOR_ANNOUNCEMENT = 'announcement';

    /******** ANNOUNCEMENT IMAGES STORE PATH ********/
    const ANNOUNCEMENT_IMAGES_STORE_PATH = 'images';
    const WEEKLY_REPORTS_STORE_PATH = 'app/reports';

    /******** PERMISSIONS ********/
    const PERMISSIONS = [
        self::ROLE_HEAD => [
            self::ACTIVITY_APPROVE_ANNOUNCEMENT,
            self::ACTIVITY_REPORTS,
            self::ACTIVITY_MANAGE_WEEKS,
            self::ACTIVITY_MANAGE_FORUM,
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_VICE_HEAD => [
            self::ACTIVITY_APPROVE_ANNOUNCEMENT,
            self::ACTIVITY_REPORTS,
            self::ACTIVITY_MANAGE_WEEKS,
            self::ACTIVITY_MANAGE_FORUM,
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_STUDENT => [
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_SUPERVISOR => [
            self::ACTIVITY_RECITATION,
            self::ACTIVITY_API_ANNOUNCEMENTS,
            self::ACTIVITY_API_WEEKS,
            self::ACTIVITY_API_RECITATIONS, // FIXME: supervisor has access to all recitation for all other supervisors
        ],
        self::ROLE_STUDENTS_MANAGER => [
            self::ACTIVITY_REPORTS,
            self::ACTIVITY_GET_SUPERVISORS, 
            self::ACTIVITY_MANAGE_GROUPS,
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_MEDIA_COMMITTE_MEMBER => [
            self::ACTIVITY_CREATE_ANNOUNCEMENT,
            self::ACTIVITY_REPORTS,
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_DATA_COMMITTE_MEMBER => [
            self::ACTIVITY_MANAGE_WEEKS,
            self::ACTIVITY_REPORTS,
            self::ACTIVITY_MANAGE_FORUM,
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_SECRETARY_GENERAL => [
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_TREASURER => [
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_EXAMINING_COMMITTE_MEMBER => [
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_TAJWEED_COMMITTE_MEMBER => [
            self::ACTIVITY_REPORTS,
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_MONITORING_COMMITTE_MEMBER => [
            self::ACTIVITY_MONITORING,
            self::ACTIVITY_API_ANNOUNCEMENTS,
            self::ACTIVITY_API_WEEKS,
            self::ACTIVITY_API_EXECUSES, // FIXME: monitoring memeber has access to all execuses for all other monitors
        ],
        self::ROLE_EXAMINING_COMMITTE_MANAGER => [
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_TAJWEED_COMMITTE_MANAGER => [
            self::ACTIVITY_REPORTS,
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_MONITORING_COMMITTE_MANAGER => [
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
        self::ROLE_RAQABA => [
            self::ACTIVITY_REPORTS,
            self::ACTIVITY_API_ANNOUNCEMENTS,
        ],
    ];
    
    /******** OTHER ********/
    // number of weeks to add in store

    const NUMBER_OF_WEEKS_TO_ADD_IN_STORE = 53;

    /******** WEEKS_NAMES ********/
    const WEEKS_NAMES = [
        '',
        'الأسبوع الأول',
        'الأسبوع الثاني',
        'الأسبوع الثالث',
        'الأسبوع الرابع',
        'الأسبوع الخامس',
        'الأسبوع السادس',
        'الأسبوع السابع',
        'الأسبوع الثامن',
        'الأسبوع التاسع',
         'الأسبوع العاشر',
         'الأسبوع الحادي عشر',
         'الأسبوع الثاني عشر',
         'الأسبوع الثالث عشر',
         'الأسبوع الرابع عشر',
         'الأسبوع الخامس عشر',
         'الأسبوع السادس عشر',
         'الأسبوع السابع عشر',
         'الأسبوع الثامن عشر',
         'الأسبوع التاسع عشر',
         'الأسبوع العشرون',
         'الأسبوع الحادي والعشرون',
         'الأسبوع الثاني والعشرون',
         'الأسبوع الثالث والعشرون',
         'الأسبوع الرابع والعشرون',
         'الأسبوع الخامس والعشرون',
         'الأسبوع السادس والعشرون',
            'الأسبوع السابع والعشرون',
            'الأسبوع الثامن والعشرون',
            'الأسبوع التاسع والعشرون',
            'الأسبوع الثلاثون',
            'الأسبوع الحادي والثلاثون',
            'الأسبوع الثاني والثلاثون',
            'الأسبوع الثالث والثلاثون',
            'الأسبوع الرابع والثلاثون',
            'الأسبوع الخامس والثلاثون',
            'الأسبوع السادس والثلاثون',
            'الأسبوع السابع والثلاثون',
            'الأسبوع الثامن والثلاثون',
            'الأسبوع التاسع والثلاثون',
            'الأسبوع الأربعون',
            'الأسبوع الحادي والأربعون',
            'الأسبوع الثاني والأربعون',
            'الأسبوع الثالث والأربعون',
            'الأسبوع الرابع والأربعون',
            'الأسبوع الخامس والأربعون',
            'الأسبوع السادس والأربعون',
            'الأسبوع السابع والأربعون',
            'الأسبوع الثامن والأربعون',
            'الأسبوع التاسع والأربعون',
            'الأسبوع الخمسون',
            'الأسبوع الحادي والخمسون',
            'الأسبوع الثاني والخمسون',
            'الأسبوع الثالث والخمسون',
            'الأسبوع الرابع والخمسون',
            'الأسبوع الخامس والخمسون',
            'الأسبوع السادس والخمسون',
            'الأسبوع السابع والخمسون',
            'الأسبوع الثامن والخمسون',
            'الأسبوع التاسع والخمسون',
            'الأسبوع الستون',
            'الأسبوع الحادي والستون',
            'الأسبوع الثاني والستون',
            'الأسبوع الثالث والستون',
            'الأسبوع الرابع والستون',
            'الأسبووع الخامس والستون',
            'الأسبوع السادس والستون',
            'الأسبوع السابع والستون',
            'الأسبوع الثامن والستون',
            'الأسبوع التاسع والستون',
            'الأسبوع السبعون',
            'الأسبوع الحادي والسبعون',
            'الأسبوع الثاني والسبعون',
            'الأسبوع الثالث والسبعون',
            'الأسبوع الرابع والسبعون',
            'الأسبوع الخامس والسبعون',
            'الأسبوع السادس والسبعون',
            'الأسبوع السابع والسبعون',
            'الأسبوع الثامن والسبعون',
            'الأسبوع التاسع والسبعون',
            'الأسبوع الثمانون',
            'الأسبوع الحادي والثمانون',
            'الأسبوع الثاني والثمانون',
            'الأسبوع الثالث والثمانون',
            'الأسبوع الرابع والثمانون',
            'الأسبوع الخامس والثمانون',
            'الأسبوع السادس والثمانون',
            'الأسبوع السابع والثمانون',
            'الأسبوع الثامن والثمانون',
            'الأسبوع التاسع والثمانون',
            'الأسبوع التسعون',
            'الأسبوع الحادي والتسعون',
            'الأسبوع الثاني والتسعون',
            'الأسبوع الثالث والتسعون',
            'الأسبوع الرابع والتسعون',
            'الأسبوع الخامس والتسعون',
            'الأسبوع السادس والتسعون',
            'الأسبوع السابع والتسعون',
            'الأسبوع الثامن والتسعون',
            'الأسبوع التاسع والتسعون',
            'الأسبوع المائة',
    ];
}


class QuestionsAnswers {
    const WhatIsYourSchedule = [
        'مستقرة بالحرم الجامعي',
        'تدريب خارج الجامعة',
        'أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة'
    ];
    const WhatIsYourStudyYear = [
        'أولى',
        'ثانية',
        'ثالثة',
        'رابعة',
        'خامسة',
        'سادسة',
        'خريج'
    ];

    const WhatIsYourGender = [
        'ذكر',
        'أنثى'
    ];

    const WhatIsTheSemester = [
        "الفصل الأول",
        "الفصل الثاني",
        "الفصل الصيفي",
        "بين الفصلين",
    ];
}