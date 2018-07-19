<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | Display version of the application in the footer of the dashboard. This
    | is not in the reference of the actual package, this is what version of
    | the application you are building is.
    |
    */

    'version' => '0.0.1',

    /*
    |--------------------------------------------------------------------------
    | Registration Open
    |--------------------------------------------------------------------------
    |
    | Choose whether new users/admins are allowed to register.
    | This will show up the Register button in the menu and allow access to the
    | Register functions in AuthController.
    |
    | By default the registration is open only on localhost.
    */
    'registration_open' => env('REGISTRATION_OPEN', env('APP_ENV') === 'local'),

    /*
    |--------------------------------------------------------------------------
    | Impersonating users
    |--------------------------------------------------------------------------
    |
    | Allowing admins to sign in as other users.
    | Update App/Http/Kernel class to enable this feature.
    */
    'impersonate' => env('IMPERSONATE', false),

    /*
    |--------------------------------------------------------------------------
    | Menu Logos
    |--------------------------------------------------------------------------
    */
    'logo_lg'   => '<b>Admin</b>LTE',
    'logo_mini' => '<b>A</b>LTE',

    /*
    |--------------------------------------------------------------------------
    | Footer Credits
    |--------------------------------------------------------------------------
    |
    | By default this will be used for the copyright on the inside of the
    | admin panel. This will also output the current year so the copyright
    | stays up to date, you can easily override this inside the view itself.
    |
    */

    'credits' => 'Powered By: <a target="_blank" href="mailto:user@example.com">Developer</a>',

    /*
    |--------------------------------------------------------------------------
    | AdminLTE Theme
    |--------------------------------------------------------------------------
    |
    | You will be able to decide easily which theme you want to load for the
    | AdminLTE Dashboard template. There are multiple colors to choose from
    | that are already pre-built, or you can create your own as well. The
    | following themes are available by default:
    |
    | - skin-black-light
    | - skin-black
    | - skin-blue-light
    | - skin-blue
    | - skin-green-light
    | - skin-green
    | - skin-purple-light
    | - skin-purple
    | - skin-red-light
    | - skin-red
    | - skin-yellow-light
    | - skin-yellow
    |
    */

    'theme' => 'skin-blue',
];
