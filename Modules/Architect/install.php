<?php 

// --------------------------------------------------------------------- //
//
//      Insurrance Architect installer
//
//      Author : nicolas.delcastillo@syntesy.io
//
// --------------------------------------------------------------------- //
function updateEnv($key,$value)
{
    $path = __DIR__ . '/../../.env';

    //Try to read the current content of .env
    $current = file_get_contents($path);   

    //Store the key
    $original = [];
    if (preg_match('/^'.$key.'=(.+)$/m', $current, $original)) { 
        $current = preg_replace('/^'.$key.'=.+$/m', "$key=$value", $current);
    } else {
        $current .= PHP_EOL."$key=$value";
    }

    return file_put_contents($path, $current);
}


// --------------------------------------------------------------------- //
//      DB MIGRATION
// --------------------------------------------------------------------- //
echo PHP_EOL;
echo "-> Migrate DB for module " . basename(__DIR__) . PHP_EOL;
exec('php artisan module:migrate ' . basename(__DIR__));
echo "-> OK " . PHP_EOL;
// --------------------------------------------------------------------- //


// --------------------------------------------------------------------- //
//      INSTALL NODE MODULES
// --------------------------------------------------------------------- //
echo PHP_EOL;
echo "-> Installing NPM packages for " . basename(__DIR__) . PHP_EOL;
exec("npm install");
echo "-> OK " . PHP_EOL;
// --------------------------------------------------------------------- //


// --------------------------------------------------------------------- //
//      ASSETS BUILDING
// --------------------------------------------------------------------- //
echo PHP_EOL;
echo "Would you want to build assets for production (prod) or development (dev) ? ";
$handle = fopen ("php://stdin","r");
$env = trim(fgets($handle)) == 'prod' ? 'prod' : 'dev';
echo "-> Buidling $env assets for module " . basename(__DIR__) . PHP_EOL;
exec("npm run $env");
// --------------------------------------------------------------------- //


// --------------------------------------------------------------------- //
//      INSTALL VENDORS
// --------------------------------------------------------------------- //
echo PHP_EOL;
echo "-> Installing vendors (composer) " . basename(__DIR__) . PHP_EOL;
exec("composer install");
// --------------------------------------------------------------------- //
