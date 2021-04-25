First download project
then rub migration for database
composer install
composer dump-autoload

after then:
inser queries: for dummy data

For event table:

INSERT INTO `events` (`id`, `title`, `event_date`, `interested_users`, `created_at`, `updated_at`) VALUES
(1, 'Bootstrap Code Event', '2021-04-25 06:35:51', '1,2', '2021-04-25 06:35:51', '2021-04-25 06:35:51'),
(2, 'React', '2021-04-30 06:54:36', '1', '2021-04-30 06:54:36', '2021-04-30 06:54:36'),
(3, 'Laravel', '2021-04-27 06:55:00', '1', '2021-04-27 06:55:00', '2021-04-27 06:55:00');

For user table:
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pratik', 'pratik016@gmail.com', '2021-04-25 05:52:26', '', NULL, '2021-04-25 05:52:26', '2021-04-25 05:52:26'),
(2, 'Rohit', 'rohit@gmail.com', '2021-04-25 07:43:20', '', NULL, '2021-04-25 07:43:20', '2021-04-25 07:43:20');


Event date range: 
25/04/2021 to 30/04/2021

After event list: just Click on Invite button

Jobs will be store in Job-queue table: So to execure:

php artisan queue:work
Then email will be sent:

You need to change config for that, otherwise, I can send you test email, if you want for the test.


