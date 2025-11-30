<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('overview', 'Home::index');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('yearly', 'Home::changeCurrentYear');
$routes->get('yearly/(:any)', 'Home::changeCurrentYear/$1');
$routes->get('legal/(:any)', 'Auth::pageLegal/$1');
$routes->get('notifications', 'Home::listingOfNotifications');
$routes->match(['POST', 'GET'], 'root', 'Auth::accessRoot');
$routes->match(['POST', 'GET'], 'search', 'Home::search');

/*================ PWA ROUTES ===========*/
$routes->get('/service-worker.js', 'ServiceWorkerController::index');
$routes->get('/offline.html', 'ServiceWorkerController::offline');

/*================ AUTH AND PASSWORD ROUTES ===========*/
$routes->get('school-welcome', 'Auth::schoolWelcome');
$routes->match(['POST', 'GET'], 'register', 'Auth::registerSchool');
$routes->match(['POST', 'GET'], 'login', 'Auth::login');
$routes->match(['POST', 'GET'], 'logout', 'Auth::logout');
$routes->match(['POST', 'GET'], 'lockAccount', 'Auth::lockAccount');
$routes->match(['POST', 'GET'], 'password/(:segment)', 'Auth::password/$1');
$routes->match(['POST', 'GET'], 'verifyResetTokenLink/(:any)', 'Auth::confirmResetRequest/$1');
$routes->match(['POST', 'GET'], 'resetPassword', 'Auth::resetPassword');
$routes->match(['POST', 'GET'], 'confirmResetRequest', 'Auth::confirmResetRequest');
$routes->match(['POST', 'GET'], 'changeDefaultPassword', 'Auth::changeDefaultPassword');

/*================ STUDENTS AND PARENTS ROUTES ===========*/
$routes->get('signup', 'Auth::signup');
$routes->match(['POST', 'GET'], 'signupCheckCredentials', 'Auth::signupCheckCredentials');
$routes->match(['POST', 'GET'], 'signupRegistration', 'Auth::signupRegistration');
$routes->match(['POST', 'GET'], 'signupGettingStarted', 'Auth::signupGettingStarted');

/*================ CUSTOMERS ROUTES ===========*/
$routes->match(['POST', 'GET'], 'resetOwnerPassword', 'Auth::resetCustomerPassword');
$routes->match(['POST', 'GET'], 'verifyResetPassword/(:any)', 'Auth::confirmCustomerResetRequest/$1');
$routes->match(['POST', 'GET'], 'confirmPasswordRequest', 'Auth::confirmCustomerResetRequest');
$routes->match(['POST', 'GET'], 'changePassword', 'Auth::changeCustomerDefaultPassword');

$routes->match(['POST', 'GET'], 'admincustomer/dashboard', 'Customer::dashboard');
$routes->match(['POST', 'GET'], 'admincustomer/createschool', 'Customer::addNewSchool');
$routes->match(['POST', 'GET'], 'admincustomer/registerschool', 'Customer::addNewSchool');
$routes->match(['POST', 'GET'], 'admincustomer/changelogo/(:any)', 'Customer::updateSchool/$1');
$routes->match(['POST', 'GET'], 'admincustomer/editschool/(:any)', 'Customer::updateSchool/$1');
$routes->match(['POST', 'GET'], 'admincustomer/startedSession/(:any)', 'Customer::detailsSchool/$1');
$routes->match(['POST', 'GET'], 'admincustomer/schools', 'Customer::page/schools');
$routes->match(['POST', 'GET'], 'admincustomer/finances', 'Customer::page/finances');
$routes->match(['POST', 'GET'], 'admincustomer/students', 'Customer::page/students');
$routes->match(['POST', 'GET'], 'admincustomer/statistics', 'Customer::page/statistics');

$routes->match(['POST', 'GET'],'customer-profile', 'Customer::accountManage');
$routes->match(['POST', 'GET'],'customer-password', 'Customer::passwordManage');
$routes->match(['POST', 'GET'],'school-finances/(:any)', 'AjaxController::customerSchoolFinances/$1');
$routes->match(['POST', 'GET'],'school-students-yearly/(:any)', 'AjaxController::customerSchoolStudents/$1');

/*================ ADMIN ROUTES ===========*/

$routes->match(['POST', 'GET'], 'admin/view/(:segment)', 'Admin::listing/$1');
$routes->match(['POST', 'GET'], 'admin/details/(:any)', 'Admin::details/$1/$2');
$routes->match(['POST', 'GET'], 'admin/edit/(:any)', 'Admin::edit/$1/$2');
$routes->match(['POST', 'GET'], 'admin/create/(:segment)', 'Admin::create/$1');
$routes->match(['POST', 'GET'], 'admin/remove/(:any)', 'Admin::remove/$1/$1');
$routes->match(['POST', 'GET'], 'admin/resetAccountPassword/(:any)', 'Admin::resetAccountPassword/$1');
$routes->match(['POST', 'GET'], 'admin/grantUserAccess/(:any)', 'Admin::grantUserAccess/$1/$2');
$routes->match(['POST', 'GET'], 'admin/saveAccount', 'Admin::saveAccount');
$routes->match(['POST', 'GET'], 'admin/updateAccount/(:any)', 'Admin::updateAccount/$1');
$routes->match(['POST', 'GET'], 'admin/changeStatus/(:any)', 'Admin::changeStatus/$1/$2');
$routes->match(['POST', 'GET'], 'admin/saveRole/(:any)', 'Admin::saveRole/$1/$2');
$routes->match(['POST', 'GET'], 'create-user-branch', 'Admin::createUserSectionBranch/$1');
$routes->match(['POST', 'GET'], 'admin/changeAccountStatus/(:any)', 'Admin::changeAccountStatus/$1/$2');
/*$routes->match(['POST', 'GET'], 'admin/publish/(:any)', 'Admin::publish/$1/$2/$3');
$routes->match(['POST', 'GET'], 'admin/responseMessage/(:any)', 'Admin::responseMessage/$1');
$routes->match(['POST', 'GET'], 'admin/saveNewsletter', 'Admin::saveNewsletter');
$routes->match(['POST', 'GET'], 'admin/saveCustomer/(:any)', 'Admin::saveCustomer/$1/$1');
$routes->match(['POST', 'GET'], 'admin/saveCategory/(:any)', 'Admin::saveCategory/$1/$2');
$routes->match(['POST', 'GET'], 'admin/saveSector/(:any)', 'Admin::saveSector/$1/$2');
$routes->match(['POST', 'GET'], 'admin/savedomain/(:any)', 'Admin::savedomain/$1/$2');
$routes->match(['POST', 'GET'], 'admin/saveCity/(:any)', 'Admin::saveCity/$1/$2');
$routes->match(['POST', 'GET'], 'admin/saveExchangeRate/(:any)', 'Admin::saveExchangeRate/$1/$2');
$routes->match(['POST', 'GET'], 'admin/saveCityDelivery/(:any)', 'Admin::saveCityDelivery/$1/$2');
*/

/*=============PROFILE ROUTES=====================*/
$routes->match(['POST', 'GET'], 'profile/page/(:segment)', 'Profile::page/$1');
$routes->match(['POST', 'GET'], 'profile/create/(:segment)', 'Profile::create/$1');
$routes->match(['POST', 'GET'], 'profile/edit/(:any)', 'Profile::edit/$1/$2');
$routes->match(['POST', 'GET'], 'profileUpdateAccount/(:any)', 'Profile::updateAccount/$1');
$routes->match(['POST', 'GET'], 'profileChangePicture/(:any)', 'Profile::changePicture/$1');
$routes->match(['POST', 'GET'], 'profileChangePassword/(:any)', 'Profile::changePassword/$1');
$routes->match(['POST', 'GET'], 'profileUpdateSecurity/(:any)', 'Profile::updateSecurity/$1');
/*=============SCHOOL ROUTES=====================*/
$routes->match(['POST', 'GET'], 'school-infosheet', 'Main::index');
$routes->match(['POST', 'GET'], 'create-school', 'Main::saveSchool');
$routes->match(['POST', 'GET'], 'create-school-year', 'Main::saveSchoolYear');
$routes->match(['POST', 'GET'], 'edit-school-year/(:any)', 'Main::saveSchoolYear/$1');
$routes->match(['POST', 'GET'], 'config/(:segment)', 'Main::config/$1');
$routes->match(['POST', 'GET'], 'config/details/(:any)', 'Main::details/$1');
$routes->match(['POST', 'GET'], 'create-classe-section', 'Main::saveClasseSection');
$routes->match(['POST', 'GET'], 'edit-classe-section/(:any)', 'Main::saveClasseSection/$1');
$routes->match(['POST', 'GET'], 'create-classe-option', 'Main::saveClasseOption');
$routes->match(['POST', 'GET'], 'edit-classe-option/(:any)', 'Main::saveClasseOption/$1');
$routes->match(['POST', 'GET'], 'create-classe-degrees', 'Main::saveClasseDegrees');
$routes->match(['POST', 'GET'], 'edit-classe-degrees/(:any)', 'Main::saveClasseDegrees/$1');
$routes->match(['POST', 'GET'], 'create-classe', 'Main::saveClasse');
$routes->match(['POST', 'GET'], 'edit-classe/(:any)', 'Main::saveClasse/$1');
$routes->match(['POST', 'GET'], 'main/changeStatus/(:any)', 'Main::changeStatus/$1/$2/$3');
$routes->match(['POST', 'GET'], 'school/update/(:any)', 'Main::saveSchool/$1');
$routes->match(['POST', 'GET'], 'school/changelogo/(:any)', 'Main::saveSchool/$1');
$routes->match(['POST', 'GET'], 'main/remove/(:any)', 'Main::remove/$1/$2');

/*=============STUDENT ENTRY ROUTES=====================*/
$routes->match(['POST', 'GET'], 'student/municipality', 'Student::municipality');
$routes->match(['POST', 'GET'], 'student/municipalityDistrict', 'Student::municipalityDistrict');
$routes->match(['POST', 'GET'], 'student/municipalityAddress', 'Student::municipalityAddress');
$routes->match(['POST', 'GET'], 'basculementAnnuelClasse', 'Student::createYearlyRegistration');
$routes->match(['POST', 'GET'], 'basculementAnnuelGlobal', 'Student::saveBasculementGlobal');
$routes->match(['POST', 'GET'], 'register-student', 'Student::saveRegistration');
$routes->match(['POST', 'GET'], 'edit-parent/(:any)', 'Student::saveParent/$1');
$routes->match(['POST', 'GET'], 'student-create-parent', 'Student::saveParent/create');
$routes->match(['POST', 'GET'], 'edit-student-registration/(:any)', 'Student::updateRegistration/$1');
$routes->match(['POST', 'GET'], 'add-school-career/(:any)', 'Student::saveParcours/$1');
$routes->match(['POST', 'GET'], 'student/changeStatus/(:any)', 'Student::changeStatus/$1/$2/$3');
$routes->match(['POST', 'GET'], 'student/remove/(:any)', 'Student::remove/$1/$2');
$routes->match(['POST', 'GET'], 'student/editForm/(:any)', 'Student::editForm/$1/$2');
$routes->match(['POST', 'GET'], 'student/details/(:any)', 'Student::details/$1/$2');
$routes->match(['POST', 'GET'], 'addNewDocument/(:any)', 'Student::addNewDocument/$1');
$routes->match(['POST', 'GET'], 'studentAddDocuments/(:any)', 'Student::addSchoolDocuments/$1/$2');
$routes->match(['POST', 'GET'], 'onlineStudentRegistration', 'Student::onlineStudentRegistration');
$routes->match(['POST', 'GET'], 'registerOldStudent', 'Student::registerOldStudent');
$routes->match(['POST', 'GET'], 'student/(:segment)', 'Student::page/$1');
$routes->match(['POST', 'GET'], 'studentRegister', 'Pubs::checkStudentRegistration');

/*=============AJAX REQUEST ROUTES=====================*/
$routes->get('ajaxStudentListingClasse/(:any)', 'AjaxController::studentListingClasse/$1/$2');
$routes->get('ajaxFeesClasse/(:any)', 'AjaxController::feesClasseDetails/$1');
$routes->get('ajaxStudentRequest/(:any)', 'AjaxController::studentRequest/$1');
$routes->get('ajaxFeesPaid/(:any)', 'AjaxController::feesPaid/$1');
$routes->get('cashbox/(:any)', 'AjaxController::financesCashbox/$1');
$routes->get('banks/(:any)', 'AjaxController::banksTransaction/$1');
$routes->get('search-student', 'AjaxController::searchStudent');
$routes->get('reporting-hidden', 'AjaxController::reportingHideContent');
$routes->get('cashboxHiddenAgent/(:any)', 'AjaxController::cashboxHiddenAgent/$1');
$routes->get('print-bill-payments', 'AjaxController::printBillPayments');
$routes->match(['POST', 'GET'],'addPaymentFee/(:any)', 'AjaxController::addPaymentFee/$1/$2');

$routes->match(['POST', 'GET'], 'editingreport/(:segment)', 'AjaxController::reportingPage/$1');
$routes->match(['POST', 'GET'], 'studentreport/(:any)', 'AjaxController::studentReporting/$1');
$routes->match(['POST', 'GET'], 'sectionRequest/(:any)', 'AjaxController::sectionRequest/$1');
$routes->match(['POST', 'GET'], 'cashboxOperation/(:any)', 'AjaxController::cashboxOperation/$1');
$routes->match(['POST', 'GET'], 'accessModule/(:any)', 'AjaxController::accessModule/$1');

/*=============REPORTING REQUEST ROUTES=====================*/
$routes->match(['POST', 'GET'], 'reporting', 'Reporting::index');
$routes->match(['POST', 'GET'], 'reporting/(:segment)', 'Reporting::listing/$1');
$routes->match(['POST', 'GET'], 'reporting/filter/(:segment)', 'Reporting::filter/$1');
$routes->match(['POST', 'GET'], 'export/(:segment)', 'Reporting::export/$1');

/*=============FEES REQUEST ROUTES=====================*/
$routes->get('fees/details/(:any)', 'Fees::details/$1/$2');
$routes->get('fees/config/(:any)', 'Fees::create/$1/$2');
$routes->get('fees/create/(:any)', 'Fees::create/$1/$2');
$routes->match(['POST', 'GET'], 'fees/(:segment)', 'Fees::listing/$1');
$routes->match(['POST', 'GET'], 'fees-payment', 'Fees::payment/$1');
$routes->match(['POST', 'GET'], 'create-feetype', 'Fees::saveFeeType');
$routes->match(['POST', 'GET'], 'update-feetype/(:any)', 'Fees::saveFeeType/$1');
$routes->match(['POST', 'GET'], 'fees/changeStatus/(:any)', 'Fees::changeStatus/$1/$2/$3');
$routes->match(['POST', 'GET'], 'create-feedetails/(:any)', 'Fees::addDetailsFees/$1');
$routes->match(['POST', 'GET'], 'update-feedetails/(:any)', 'Fees::updateDetailsFees/$1');
$routes->match(['POST', 'GET'], 'config-fees-classe/(:any)', 'Fees::createClasseFees/$1');
$routes->match(['POST', 'GET'], 'create-exemption', 'Fees::saveFeeExemption');
$routes->match(['POST', 'GET'], 'update-exemption/(:any)', 'Fees::saveFeeExemption/$1');
$routes->match(['POST', 'GET'], 'fees/remove/(:any)', 'Fees::remove/$1/$2');
$routes->match(['POST', 'GET'], 'config-scholarship-student/(:any)', 'Fees::configStudentScholarship/$1');
$routes->match(['POST', 'GET'], 'config-exemption-classe/(:any)', 'Fees::configClasseExemption/$1');
$routes->match(['POST', 'GET'], 'config-fees-exemption/(:any)', 'Fees::configDiscountExemption/$1');

$routes->match(['POST', 'GET'], 'create-currency', 'Fees::currency');
$routes->match(['POST', 'GET'], 'update-currency/(:any)', 'Fees::currency/$1');
$routes->match(['POST', 'GET'], 'create-exchange', 'Fees::exchange');
$routes->match(['POST', 'GET'], 'update-exchange/(:any)', 'Fees::exchange/$1');

/*=============PAYMENT REQUEST ROUTES=====================*/
$routes->get('payments', 'Payment::index');
$routes->get('payment/details/(:any)', 'Payment::details/$1/$2');
$routes->get('payment/create/(:any)', 'Payment::create/$1/$2');
$routes->get('payment/remove/(:any)', 'Payment::remove/$1/$2');
$routes->get('payment/cancelPaydetails/(:any)', 'Payment::cancelPaydetails/$1');
$routes->get('payment/printbill/(:any)', 'Payment::printbill/$1');
$routes->get('payments-bills', 'Payment::bills');
$routes->match(['POST', 'GET'], 'create-payment/(:any)', 'Payment::createFeesPayment/$1/$2');
$routes->get('qrcode/(:any)', 'Payment::generateQRCode/$1');
$routes->get('payment/bill/(:any)', 'Payment::billdetail/$1');
$routes->get('paymentDateApplying', 'Payment::paymentDateApplying');
$routes->get('encodingBillPayment', 'Payment::encodingBillPayment');
/*=============FINANCE REQUEST ROUTES=====================*/

$routes->get('finances/(:segment)', 'Finance::listing/$1');
$routes->get('finances/details/(:any)', 'Finance::details/$1/$2');
$routes->get('finances/create/(:any)', 'Finance::create/$1/$2');
$routes->get('finances/edit/(:any)', 'Finance::edit/$1/$2');
$routes->get('finances/changeStatus/(:any)', 'Finance::changeStatus/$1/$2/$3');
$routes->get('finances/remove/(:any)', 'Finance::remove/$1/$2');
$routes->get('finances/printexpense/(:any)', 'Finance::printbill/$1');
$routes->match(['POST', 'GET'], 'create-bank-account/(:any)', 'Finance::bankAccount/$1');
$routes->match(['POST', 'GET'], 'update-bank-account/(:any)', 'Finance::bankAccount/$1/$2');
$routes->match(['POST', 'GET'], 'cashbox-create-expense', 'Finance::cashboxExpense');
$routes->match(['POST', 'GET'], 'cashbox-update-expense/(:any)', 'Finance::cashboxExpense/$1');
$routes->match(['POST', 'GET'], 'cashbox-create-operation', 'Finance::cashboxOperation');
$routes->match(['POST', 'GET'], 'cashbox-cancel-expense/(:any)', 'Finance::cancelExpenseOperation/$1');
$routes->match(['POST', 'GET'], 'create-bank-account', 'Finance::bankAccount');
$routes->match(['POST', 'GET'], 'update-bank-account/(:any)', 'Finance::bankAccount/$1');
$routes->match(['POST', 'GET'], 'bank-create-transaction', 'Finance::transactionsAccountBanking');
$routes->match(['POST', 'GET'], 'bank-cancel-transaction/(:any)', 'Finance::cancelBankTransaction/$1');

/*=============SYSTEM BACKUP DB REQUEST ROUTES=====================*/

$routes->match(['POST', 'GET'], 'databases', 'Database::index');
$routes->match(['POST', 'GET'], 'dbmigrate', 'Database::migrate');
$routes->match(['POST', 'GET'], 'dbexport', 'Database::export');
$routes->match(['POST', 'GET'], 'dbimportsql', 'Database::import');
$routes->match(['POST', 'GET'], 'dbimport/(:any)', 'Database::import/$1');
$routes->match(['POST', 'GET'], 'dbremovebackup/(:any)', 'Database::removeFileBackup/$1');
$routes->match(['POST', 'GET'], 'dbimportinit', 'Auth::importDabataseFile');
$routes->match(['POST', 'GET'], 'dbsysmigrate', 'Auth::checkDatabase');
$routes->match(['POST', 'GET'], 'dbkmigrate', 'Auth::migrateDabatase');

/*=============SUPPORT REQUEST ROUTES=====================*/
$routes->get('support', 'Support::index');
$routes->get('support/(:segment)', 'Support::page/$1');
$routes->match(['POST', 'GET'], 'feedback', 'Support::schoolFeedbackUser');
/*=============USERS ROUTES=====================*/
$routes->match(['POST', 'GET'], 'user/support/(:segment)', 'User::support/$1');
$routes->match(['POST', 'GET'], 'user/sendContactMessage', 'User::sendContactMessage');
$routes->match(['POST', 'GET'], 'user/sendAppFeedback', 'User::sendAppFeedback');
$routes->get('user', 'User::index');
/*=============MESSAGES REQUEST ROUTES=====================*/
$routes->get('messages', 'Message::index');
$routes->get('messages-validity', 'Message::page/packs');
$routes->get('message/(:segment)', 'Message::page/$1');
$routes->match(['POST', 'GET'], 'resend-message/(:any)', 'Message::sendDraftMessage/$1');
$routes->match(['POST', 'GET'], 'sendemail', 'Message::sendEmailComposition');
$routes->match(['POST', 'GET'], 'sendsms', 'Message::sendSMSComposition');
$routes->match(['POST', 'GET'], 'sendingsms-activation', 'Message::sendingActivation');
$routes->match(['POST', 'GET'], 'messaging', 'Message::sendUsersMessaging');
$routes->match(['POST', 'GET'], 'sendMessageBroadcast', 'Message::sendBroadcast');
$routes->match(['POST', 'GET'], 'create-message-contact', 'Message::createContact');

/*=============PUBS REQUEST ROUTES=====================*/
$routes->get('pubs', 'Teaching::index');
$routes->get('teaching/(:segment)', 'Teaching::page/$1');
$routes->match(['POST', 'GET'], 'teaching-timing', 'Teaching::timing');
$routes->match(['POST', 'GET'], 'teaching-encoding', 'Teaching::encoding');
$routes->match(['POST', 'GET'], 'teaching-schoolary', 'Teaching::schoolary');
$routes->match(['POST', 'GET'], 'teaching-pubs', 'Teaching::pubs');
$routes->match(['POST', 'GET'], 'teaching-annualperiod', 'Teaching::yearlyPeriod');
$routes->match(['POST', 'GET'], 'teaching-criteria', 'Teaching::criteria');
$routes->match(['POST', 'GET'], 'teaching/status/(:any)', 'Teaching::status/$1/$2/$3');
$routes->match(['POST', 'GET'], 'teaching/remove/(:any)', 'Teaching::remove/$1/$2');
$routes->match(['POST', 'GET'], 'teaching/resultStatus/(:any)', 'Teaching::resultAvailibility/$1');
$routes->match(['POST', 'GET'], 'resultsearch', 'Teaching::resultsearch');
$routes->match(['POST', 'GET'], 'studentresults', 'Pubs::resultsearch');
$routes->match(['POST', 'GET'],'onlineStudentResults', 'Pubs::studentResults');


/*=============EDUCATION REQUEST ROUTES=====================*/

$routes->match(['POST', 'GET'], 'education-teacher', 'Education::storeTeacher');
$routes->match(['POST', 'GET'], 'education-branch', 'Education::storeBranch');
$routes->match(['POST', 'GET'], 'education-course', 'Education::storeCourse');
$routes->match(['POST', 'GET'], 'education/courseclasses/(:any)', 'Education::configCourseClasses/$1');
$routes->match(['POST', 'GET'], 'education/schedules', 'Education::configCourseClasseSchedule');
$routes->match(['POST', 'GET'], 'education/availability', 'Education::configTeacherAvailability');
$routes->match(['POST', 'GET'], 'education/attribution', 'Education::configTeacherAttribution');
$routes->match(['POST', 'GET'], 'education/studentquote', 'Education::addStudentQuotes');
$routes->match(['POST', 'GET'], 'education/studentslipnote/(:any)', 'Education::studentSlipnote/$1');
$routes->match(['POST', 'GET'], 'education/maxima', 'Education::configCourseMaxima');
$routes->match(['POST', 'GET'], 'education/incident', 'Education::studentIncident');
$routes->match(['POST', 'GET'], 'education/sanction', 'Education::studentSanction');
$routes->match(['POST', 'GET'], 'education/evaluation', 'Education::studentsEvaluations');

$routes->get('education', 'Education::index');
$routes->get('education/remove/(:any)', 'Education::remove/$1/$2');
$routes->get('education/details/(:any)', 'Education::details/$1/$2');
$routes->get('education/(:segment)', 'Education::page/$1');
$routes->get('education/changeStatus/(:any)', 'Education::changeStatus/$1/$2/$3');

/*=============EMPLOYEES REQUEST ROUTES=====================*/
$routes->get('gesem/(:segment)', 'HRManagment::listing/$1');
$routes->match(['POST', 'GET'], 'gesem-employee', 'HRManagment::employee');
$routes->match(['POST', 'GET'], 'gesem-category', 'HRManagment::category');
$routes->match(['POST', 'GET'], 'gesem-contract', 'HRManagment::contract');
$routes->match(['POST', 'GET'], 'gesem-attendance', 'HRManagment::attendance');
$routes->match(['POST', 'GET'], 'gesem-leavetype', 'HRManagment::leavetype');
$routes->match(['POST', 'GET'], 'gesem-leave', 'HRManagment::leave');
$routes->match(['POST', 'GET'], 'gesem-payroll', 'HRManagment::payroll');
$routes->match(['POST', 'GET'], 'gesem/status/(:any)', 'HRManagment::changeStatus/$1/$2/$3');
$routes->match(['POST', 'GET'], 'gesem/remove/(:any)', 'HRManagment::deleteData/$1/$2');
/*================ GUEST ROUTES ===========*/
$routes->get('guest/student/(:any)', 'GuestController::studentPage/$1');
/*================ PAYROLL ROUTES ===========*/
$routes->match(['POST', 'GET'], 'worker/attendances/create', 'Payroll::storeAttendance');
$routes->match(['POST', 'GET'], 'worker/overtimehours/create', 'Payroll::overtimeHours');
$routes->match(['POST', 'GET'], 'worker/attendances/(:any)', 'Payroll::attendancesWorkerDetails/$1');
$routes->match(['POST', 'GET'], 'worker/create/contract', 'Payroll::storeContract');
$routes->match(['POST', 'GET'], 'worker/cancel/contract/(:any)', 'Payroll::updateContract/cancel/$1');
$routes->match(['POST', 'GET'], 'worker/update/contract/(:any)', 'Payroll::updateContract/update/$1');
$routes->match(['POST', 'GET'], 'worker/create/agent', 'Payroll::createAgent/agent');
$routes->match(['POST', 'GET'], 'worker/create', 'Payroll::createAgent');
$routes->match(['POST', 'GET'], 'worker/remove/(:any)', 'Payroll::remove/$1/$2');
$routes->match(['POST', 'GET'], 'worker/picture/(:any)', 'Payroll::modifyAgent/picture/$1');
$routes->match(['POST', 'GET'], 'worker/edit/(:any)', 'Payroll::modifyAgent/edit/$1');
$routes->match(['POST', 'GET'], 'worker/update/(:any)', 'Payroll::modifyAgent/update/$1');
$routes->match(['POST', 'GET'], 'worker/category/create', 'Payroll::saveCategorySalary/create');
$routes->match(['POST', 'GET'], 'worker/category/update/(:any)', 'Payroll::saveCategorySalary/update/$1');
$routes->match(['POST', 'GET'], 'worker/agent/(:any)', 'Payroll::getWorkerDetails/$1');
$routes->match(['POST', 'GET'], 'worker/request/create', 'Payroll::salaryRequest/create');
$routes->match(['POST', 'GET'], 'worker/request/(:any)', 'Payroll::salaryRequest/$1/$2');
$routes->match(['POST', 'GET'], 'worker/payment/create', 'Payroll::salaryPayment/create');
$routes->match(['POST', 'GET'], 'worker/payment/(:any)', 'Payroll::salaryPayment/$1/$2');
$routes->match(['POST', 'GET'], 'payroll/(:segment)', 'Payroll::list/$1');