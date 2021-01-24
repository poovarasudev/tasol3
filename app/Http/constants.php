<?php

// DateTime Formats
define('DATE_TIME_FORMAT_TWELVE_HOURS', 'd.m.Y h:i A');

// General
define('COPYRIGHT_NAME', 'Poovarasu');

// Gender for profile & photo get attr
define('GENDER_MALE', 'Male');
define('GENDER_FEMALE', 'Female');
define('GENDER_OTHER', 'Other');

// Menu Type
define('MENU_FOR_BREAKFAST', 'Breakfast');
define('MENU_FOR_LUNCH', 'Lunch');

// Roles & Permissions
define('SUPER_ADMIN_ROLE', 'Super Admin');
define('PERMISSION_GROUP_USER', 'User');
define('PERMISSION_GROUP_TEAM', 'Team');
define('PERMISSION_GROUP_ROLE', 'Role');
define('PERMISSION_GROUP_ASSIGN_ROLE', 'Assign Role');
define('PERMISSION_GROUP_MENU', 'Menu');
define('PERMISSION_GROUP_NOTIFICATION', 'Notification');
define('PERMISSION_GROUP_DAY', 'Day');

// Menu Type
define('TEAM_GUEST', 'Guest');
define('TEAM_OTHERS', 'Others');
define('CONSTANT_TEAMS', [TEAM_GUEST, TEAM_OTHERS]);

// Bill Types
define('BILL_TYPE_PER_UNIT', 'Per Unit');
define('BILL_TYPE_EQUALLY_DIVIDED', 'Equally Divided');

// Menu Types
define('ORDER_TYPE_SINGLE', 'Single');
define('ORDER_TYPE_MULTIPLE', 'Multiple');

// Notification
define('DEFAULT_NOTIFICATION_DESCRIPTION', '<p>-</p>');

// General is used as default in notifications table
define('NOTIFICATION_TYPE_GENERAL', 'General');
define('NOTIFICATION_TYPE_INDIVIDUAL', 'Individual');

// Max number of notifications
define('MAXIMUM_NOTIFICATION_COUNT_IN_SIDEBAR', 7);
define('MAXIMUM_NOTIFICATION_COUNT_IN_NOTIFICATION_PAGE', 5);

// Constant Days
define('SUNDAY', 'Sunday');
define('MONDAY', 'Monday');
define('TUESDAY', 'Tuesday');
define('WEDNESDAY', 'Wednesday');
define('THURSDAY', 'Thursday');
define('FRIDAY', 'Friday');
define('SATURDAY', 'Saturday');
define('DAYS', [SUNDAY, MONDAY, TUESDAY, WEDNESDAY, THURSDAY, FRIDAY, SATURDAY]);
