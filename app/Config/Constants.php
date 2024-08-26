<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);

/* Virtual Account SNAP VA */

define("X_CLIENT_KEY",                              "TNICEEW051");
define("NICEPAY_MERCHANT_KEY",                      "33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A==");
define("NICEPAY_PRIVATE_KEY",                       "MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAInJe1G22R2fMchIE6BjtYRqyMj6lurP/zq6vy79WaiGKt0Fxs4q3Ab4ifmOXd97ynS5f0JRfIqakXDcV/e2rx9bFdsS2HORY7o5At7D5E3tkyNM9smI/7dk8d3O0fyeZyrmPMySghzgkR3oMEDW1TCD5q63Hh/oq0LKZ/4Jjcb9AgMBAAECgYA4Boz2NPsjaE+9uFECrohoR2NNFVe4Msr8/mIuoSWLuMJFDMxBmHvO+dBggNr6vEMeIy7zsF6LnT32PiImv0mFRY5fRD5iLAAlIdh8ux9NXDIHgyera/PW4nyMaz2uC67MRm7uhCTKfDAJK7LXqrNVDlIBFdweH5uzmrPBn77foQJBAMPCnCzR9vIfqbk7gQaA0hVnXL3qBQPMmHaeIk0BMAfXTVq37PUfryo+80XXgEP1mN/e7f10GDUPFiVw6Wfwz38CQQC0L+xoxraftGnwFcVN1cK/MwqGS+DYNXnddo7Hu3+RShUjCz5E5NzVWH5yHu0E0Zt3sdYD2t7u7HSr9wn96OeDAkEApzB6eb0JD1kDd3PeilNTGXyhtIE9rzT5sbT0zpeJEelL44LaGa/pxkblNm0K2v/ShMC8uY6Bbi9oVqnMbj04uQJAJDIgTmfkla5bPZRR/zG6nkf1jEa/0w7i/R7szaiXlqsIFfMTPimvRtgxBmG6ASbOETxTHpEgCWTMhyLoCe54WwJATmPDSXk4APUQNvX5rr5OSfGWEOo67cKBvp5Wst+tpvc6AbIJeiRFlKF4fXYTb6HtiuulgwQNePuvlzlt2Q8hqQ==");
define("NICEPAY_CLIENT_SECRET",                     "1af9014925cab04606b2e77a7536cb0d5c51353924a966e503953e010234108a");

define("NICEPAY_REQ_URL",                           "https://dev.nicepay.co.id/nicepay/api/v1.0/transfer-va/create-va");
define("NICEPAY_ORDER_STATUS_URL",                  "https://dev.nicepay.co.id/nicepay/api/v1.0/transfer-va/status");
define("NICEPAY_ACCESS_TOKEN",                      "https://dev.nicepay.co.id/nicepay/v1.0/access-token/b2b");

define("NICEPAY_CALLBACK_URL",                      "https://dev.nicepay.co.id/IONPAY_CLIENT/paymentResult.jsp");
define("NICEPAY_DBPROCESS_URL",                     "https://dev.nicepay.co.id/IONPAY_CLIENT/paymentResult.jsp");


