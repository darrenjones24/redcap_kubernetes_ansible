<?php

/**
 * Set this variable to TRUE if you are having problems and need to see as much error logging information as
 * possible. This will cause all errors/warnings/notices to be logged to your web server's error log. Once
 * the issue has been resolved, we recommend setting this back to FALSE to avoid unnecessary logging of warnings.
 */
global $log_all_errors;
$log_all_errors = FALSE;


include '/dbconnect.php';

//********************************************************************************************************************
// DATA TRANSFER SERVICES (DTS):
// If using REDCap DTS, uncomment the lines below and provide the database connection values for connecting to
// the MySQL database containing the DTS tables (even if the same as the values above).

// $dtsHostname 	= 'your_dts_host_name';
// $dtsDb 			= 'your_dts_db_name';
// $dtsUsername 	= 'your_dts_db_username';
// $dtsPassword 	= 'your_dts_db_password';
