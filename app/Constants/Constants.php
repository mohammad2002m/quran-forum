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


    /******** STUDENTS STATUSES ********/
    const STUDENT_STATUS_ACTIVE = 1;
    const STUDENT_STATUS_FREEZED = 2;
    const STUDENT_STATUS_STOPPED = 3;
    const STUDENT_STATUS_LEFT = 4;

    /******** ACTIVITIES:SHOULD MATCH THE DATABASE ********/
    const ACTIVITY_CREATE_ANNOUNCEMENT = 1;
    const ACTIVITY_APPROVE_ANNOUNCEMENT = 2;

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
}


