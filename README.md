This is a starter kit designed to work just alongside a fresh or old Laravel 5.3 application.
- All routes have `unstarter` prefix to avoid conflicts with your development work.

There are only few convergence points which interfere with the app. These points are 

- A route file registered in your `app\Providers\RouteServiceProvider.php`. The file is provided in the `unrulynatives/helpers` package, you need to publish it (see the package's readme.md).

- Package service providers and facadae declared in your `config/app.php`. The packages are registered out-of-the-box. Don't want a package? Just comment out the service provider and delete the package from `composer.json`.

- Traits declared in the `app/User.php` model. Among them `use Unrulynatives\Helpers\UserExtensions;`.

- some of the dependencies, such as `"Amranidev/scaffold-interface` have their own routes defined not in routes file, but in the package itself (`users`, `admin` in case of this one). 
One way of dealing with such conflicts is to move `App\Providers\RouteServiceProvider::class,` to position below the package service provide declaration.




# INSTALLATION

## Variant 1: Merging into your existing project

Note: all files and changes made to the original Laravel 5.3 laravel app are made in a way allowing you to get rid of some or all functions. 

    - All view files are stored in `starter` folder with exception of
    - `auth` folder which is created by the native Laravel command `php artisan make:auth`

    - all routes for the Starter functions are placed in `routes/starter.app`. You can comment out the routes in bulk or unregister the route file in `app/Providers/RouteServiceProvider.php`

    - Controllers for the Starter App are stored in subfolder `app/Http/Controllers/Starter`

## Variant 2: Setting up a new app

1. Pull this starter kit to your local drive

2. run `composer install`. You need to install the Composer itself to do that. See [Composer Download Page](https://getcomposer.org/download/).

3. clone the file `.env.example` and rename it to `.env`

4. Fill .env file with vital db information

5. Generate application key with shell command `artisan key:generate`

6. populate the database
You will need to create tables in your database. Use `php artisan migrate` to do that.
After that : `php artisan db:seed`

After seeding the staff table with an admin user, the password for the admin user is : '123456'





7. Initiate the Laravel's bundled authentication functions. As described here
use `php artisan make:auth` commmand. 



### LAST STEP
After completing the above steps the app should work. 
Point your browser to the `localhost/APP_FOLDER/public/`.. You should see the landing page. (This solution required DB connection to work properly)
Point your browser to the `localhost/APP_FOLDER/public/welcome`.. You should see the landing page. (You will see the standard welcome screen delivered by Laravel)




## Assorted solutions

    - A gravatar displaying code (see model `getGravatarAttribute` in `App/User.php`).

    - slugs for models powered by `cviebrock/eloquent-sluggable` package.

    - 'Two' themes pre-defined, powered by `igaster/laravel-theme`.

    - some examples of `intervention/image` for manipulating images.

    - login by invoking modal.

    - QR code generator for any page, reloads for changes of hashtag value (See JS feature above). Provided by `simplesoftwareio/simple-qrcode`

    - the app can recognizes type of user's device, thanks to `jenssegers/agent`.

    - Date presenters provided by `jenssegers/date` package. Extra helpers also available

    - A simple upvoting system powered by `rtconner/laravel-likeable`.

    - Model tagging powered by `rtconner/laravel-tagging`.

    - commenting of models powered by `slynova/laravel-commentable`.





## Admin  tools

    - Mass removal of records with field `status` == `null`. Easily adjustable for other purposes.

    - Wholesale recreation of slugs. Needed when you decide to implement slugs after a number of records is already submitted by users

    //- user tracking (`spatie/laravel-activitylog`) (PHP7!)


    - `/admin/server-status` - point your browser here to display server status, Laravel version and php version

    - DB and app backup powered by `spatie/laravel-backup`. A cron job pre-configured.

    - permission system provided by `spatie/laravel-permission`.

## Developer tools and features

    - Laravel debugbar
    - A very handy scaffolding interface, DB-powered. `Amranidev/scaffold-interface`.
    - some scaffolding methods provided by `laralib/l5scaffold`.
    - manage translation files - URL `translations`. Powered by `barryvdh/laravel-translation-manager`.
    - see logs of your app thanks to `arcanedev/log-viewer` package.


## CSS/JS hacks and improvements over used frameworks:

    - Bootstrap: dropdown on hover  (see `css/common_elements.css`)
    - Bootstrap: button with icon on one side. See example at `docs/components_common`.

    - CSS classes for common CSS elements which I use most frequently. All are listed here `docs/components_common`


## JS & jQuery SCRIPTS

    - A script to load DOM patches via jQuery (`js/minitool_dom_patch.js`). A variation of the script displays an JS alert (`js/minitool_dom_patch_with_confirm.js`)

    - A script to set hash value when switching between tabs on a page (`js/minitool_tabhas_bootstrap.js`).

    - 3 frontend solutions to show/reveal more content. (`js/minitool_showhide.js`). Example: an attribite `data-more-close` hides an element by use of jQuery `slideUp` at the page load.

    - A solution to load content into a modal. Content can be cloned from hidden DOM elements of loaded by AJAX (`js/minitool_modal_universal.js`).

## Other, less vital packages & features

    - Translate an address into GPS coordinates thanks to `spatie/geocoder`.

    - Creating expirable links, powered by `spatie/laravel-url-signer`.



# Future features

###Packages installed, but not configured and with no example usage


    - `spatie/laravel-link-checker`.
    - `spatie/laravel-or-abort`.
    - Social logins powered by `laravel/socialite`.
    - caching your queries thanks to `watson/rememberable`.
    - spatie/laravel-analytics
    - spatie/laravel-responsecache
    - unicodeveloper/laravel-password
    - arcanedev/no-captcha
    - arrilot/laravel-widgets
    - classygeeks/potion
    - User-2-user messages, powered by `cmgmyr/messenger`


###Code to write (contributors welcome!): 

    - return to the original page after login

    - User AVATAR supported locally instead of Gravatar - by user's choice

    - spam prevention: blocking certain email domains from registering as users. Sometimes needed to stop bot registration

    - advanced voteup/votedown system provided as an external package

    - solution for storing user options in a separate table linked to User model by hasMany relation


## A list of PACKAGES used in this project
A DB-fed list is available at the 
[DEMO app here](http://dev.unrulynatives.com/package)


    ### this is the `collective` equivalent - used temporarily for the still unreleased Laravel 5.3
        "laravie/html": "~5.3",

    ### Theme system. This App uses it for switching between CSS frameworks
        "igaster/laravel-theme": "~1",

    ### A complete roles/auth solution. 
        "spatie/laravel-permissions": "2.1.*@dev",
        See URL `admintools/assign-roles`


    ### detects if user is using a mobile or a desktop device
        "jenssegers/agent" : "~2.3",

    ### slugs
        "cviebrock/eloquent-sluggable": "dev-master",

    ### a simple admin panel
        "laraveldaily/quickadmin": "^1.1",

    ### tagging for models
        "rtconner/laravel-tagging": "2.*",

    ### comment system
        "slynova/laravel-commentable": "^2.0"
        This system supports replies at multiple level.

    ###Tracking user activity 
     "spatie/laravel-activitylog": "^1.2",
        See URL `admintools/user-track`



## integrating this package with bare Laravel app

This starter is designed to work alongside the bare Laravel app with as few modifications to the "blank" app as possible. The reason is simple: sometimes new versions of the Laravel come with changes to the app structure.

The majority of the files are copied by the `unrulynatives/helpers` package: as soon as you publish the package assets, all necessary foles would appear in your app: 

- Copy middlewares from `app/Http/Middleware` and register them in the `\app\Http\Kernel.php` field.

- Copy `app/Helpers` and `app\Models`.

- Copy `\config\project_specific.php` file to target app's `config\` folder.

### Integrating:

- register the middlewares you have copied. Open your `app\Http\Kernel.php` and add 

```
        'admins' => \App\Http\Middleware\AllowAdmins::class,
        'moderators' => \App\Http\Middleware\AllowModerators::class,
        'developers' => \App\Http\Middleware\AllowDevelopers::class,
```        
to the `protected $routeMiddleware`.


- add your morph class definitions in `app\Providers\AppServiceProvider.php`. Use the instructions in https://laravel.com/docs/5.3/upgrade


### Optional steps. The newest changes to MySQL 5.7 produce some annoying problems with the app. This is how to avoid them. Modify the DB connection definition with this:

```
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',

            // 'strict' => true,
            // 'engine' => null,
            // https://github.com/laravel/framework/issues/14908
            'strict' => true,
            'engine' => null,
            'modes' => [
            //'ONLY_FULL_GROUP_BY',
            'STRICT_TRANS_TABLES',
            'NO_ZERO_IN_DATE',
            'NO_ZERO_DATE',
            'ERROR_FOR_DIVISION_BY_ZERO',
            'NO_AUTO_CREATE_USER',
            'NO_ENGINE_SUBSTITUTION'],
        ],
```

- 


## Contribution guide

Just fork the project, adjust code or provide yours and do a pull request. 


## About this starter package

I am an amateur programmer, trying to create an sophisticated app for decisionmaking. The project is already launched in Poland in 2011. Now the code & content is adjusted to other languages. The gist: the app registers actions of public fugures and other actors present in public space to generate dynamic 'lesser evil' lists for the purpose of voter and consumer decision. The desired functionality is similar to the featured Buycott.com application.

If you like the idea standing behind such an app and are willing to contribute, please contact me.


# About Laravel framework

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.



## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
