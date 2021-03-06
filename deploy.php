<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Arilim');

// Project repository
set('repository', 'git@bitbucket.org:syntesy/arilim.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

set('keep_releases', 5);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
host('bitbucket@arilim-iga.syntesy.io')
    ->stage('stage')
    ->set('branch', 'master')
    ->set('deploy_path', '/var/www/arilim-iga.syntesy.io');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
after('deploy:symlink', 'artisan:config-clear');

/*
desc('Send my SSH key to the server');
task('ssh:sendmykey', function () {
    run("ssh-copy-id -i ~/.ssh/id_rsa bitbucket@195.244.21.141");
});
*/

desc('Reset config cache');
task('artisan:config-clear', function () {
    run("php  {{deploy_path}}/current/artisan config:clear");
});

task('artisan:view:cache', function () {});
