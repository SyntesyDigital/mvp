<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'BWO_RH');

// Project repository
set('repository', 'git@bitbucket.org:syntesy/architect_v2.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('bitbucket@bwo-interim.ablop.com')
    ->set('deploy_path', '/var/www/bwo-interim.ablop.com');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

desc('Send my SSH key to the server');
task('ssh:sendmykey', function () {
    run("ssh-copy-id -i ~/.ssh/id_rsa bitbucket@195.244.21.141");
});
