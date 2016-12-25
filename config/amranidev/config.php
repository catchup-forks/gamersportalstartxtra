<?php

  return [

    /*
    |--------------------------------------------------------------------
    | Allowed environments
    |--------------------------------------------------------------------
    |
    | Here is where you can register your allowed env-s.
    | By default is ['local']
    |
    */

    'env' => [
        'local',
    ],

     /*
     |--------------------------------------------------------------------
     | Default package Name
     |--------------------------------------------------------------------
     |
     | Here is where you can register your current package.
     | By default is Laravel
     |
     */

     'package' => 'StarterKit',

     /*
     |--------------------------------------------------------------------
     | Default Files Storage , (Models , Views , Controllers , Migrations)
     |--------------------------------------------------------------------
     |
     | Here is where you can register your storage paths.
     |
     */

     'model' => base_path('Modules') . 'StarterKit' . '/Models',

     'views' => base_path('Modules') . 'StarterKit' . '/resources/views',

     'controller' => base_path('Modules') . 'StarterKit' . '/app/Http/Controllers',

     'migration' => base_path('Modules') . 'StarterKit' . '/database/migrations',

     /*
     |--------------------------------------------------------------------
     | Database migration path.
     |--------------------------------------------------------------------
     |
     | Here is where you can register your migrations path to migrate
     | the schema via migrate artisan command.
     |
     */

     'database' => null,

     /*
     |-------------------------------------------------------------------
     | Default route file
     |-------------------------------------------------------------------
     |
     | Here is where you can register your route file.
     |
     */

     'routes' => base_path('Modules') . 'StarterKit' . '/routes/routes.php',

     /*
     |--------------------------------------------------------------------
     | Default package namespace and loaders
     |--------------------------------------------------------------------
     |
     | By default scaffold-interface interact with your app without
     | specify any namespace. otherwise, if there is a module or a package
     | that you may want scaffold-interface interact with, you must define
     | namespaces.
     |
     */

     'controllerNameSpace' => 'StarterKit\\Http\\Controllers',

     'modelNameSpace' => 'StarterKit',

      /*
      |-------------------------------------------------------------------
      | Views loader
      |-------------------------------------------------------------------
      |
      | Here is where you can register your default views loader.
      | By default is null
      |
      */

      'loadViews' => null,

    ];
