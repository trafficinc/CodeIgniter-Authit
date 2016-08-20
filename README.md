CodeIgniter Authit
==================

A lightweight and flexible CodeIgniter authentication library. It comes packaged with an example `Auth` class and related views so that you can get your CI project up and running in minutes. For password resets you can see the email preview functionality that allows you to tweak emails you send for each action by viewing it on ...auth/sentemails.  See config/authit to turn on for development, off for production.

Requirements
------------

* CodeIgniter 3.0+
* PHP 5.5+
* MySQL

Installation
------------

1. Download and unpack the contents of the application folder to your CodeIgniter project.
2. That's it! Visit `/auth` to signup and login.
3. If you want you can edit `application/config/authit.php` to change some settings, but the defaults are fine.

Usage
-----

See [example Auth controller](application/controllers/Auth.php) which provides a functioning example of login, sign up, logout and forget/reset password. The Authit library provides several API methods:

`logged_in()` - Returns `true` if the current user logged in, `false` otherwise.

`login($email, $password)` - Attempts to login a user with a given `$email` and `$password`. Returns `true` if successful and `false` otherwise.

`logout([$redirect = false])` - Logs out the current user (by destroying the session). Accepts an optional `$redirect` parameter to redirect to a given URI after logout.

`signup($email, $password)` - Attempts to create a user with a given `$email` and `$password`. Returns `true` if successful and `false` otherwise.

`reset_password($user_id, $new_password)` - Resets the password of the user with the given `$user_id`.

The [Authit helper](application/helpers/authit_helper.php) includes the following helper functions:

`logged_in()` - Returns `true` if the current user logged in, `false` otherwise (shortcut to the Authit library `logged_in()` function).

`user([$key = ''])` - Returns the session data for the currently logged in user. If you specifiy a `$key` you can get specific info, for exmaple `user('id')` returns the currently logged in user ID.