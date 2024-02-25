<?php

namespace QF;

class Constants {

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
    const STUDENT_STATUS_ACTIVE = 1;
    const STUDENT_STATUS_FREEZED = 2;
    const STUDENT_STATUS_STOPPED = 3;
    const STUDENT_STATUS_LEFT = 4;

    /******** ACTIVITIES:SHOULD MATCH THE DATABASE ********/
    const ACTIVITY_CREATE_ANNOUNCEMENT = 1;
    const ACTIVITY_APPROVE_ANNOUNCEMENT = 2;
    const ACTIVITY_MANAGE_WEEKS = 3;

    /******** IMAGES TYPES ********/
    const SUPPORTED_IMAGES_EXTENSIONS = ['jpg', 'jpeg', 'png'];

    /******** ANNOUNCEMENT IMAGES STORE PATH ********/
    const ANNOUNCEMENT_IMAGES_STORE_PATH = '/images/announcements';

    /******** PERMISSIONS ********/
    const PERMISSIONS = [
        self::ROLE_HEAD => [
            self::ACTIVITY_APPROVE_ANNOUNCEMENT,
            self::ACTIVITY_CREATE_ANNOUNCEMENT,
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


