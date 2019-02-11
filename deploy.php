<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'vendor/deployer/recipes/recipe/yarn.php';


// Project name
set('application', 'yoga');

// Project repository
set('repository', 'git@github.com:yanster18/yoga_app.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', [
    '.env'
]);
add('shared_dirs', [
    'storage'
]);
// Writable dirs by web server
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

desc('Build frontend for production');
task('yarn:prod', function () {
    run("cd {{release_path}} && {{bin/yarn}} production");
});


// Hosts

host('yoga.yanster.one')
    ->stage('production')
    ->user('yanster')
    ->set('deploy_path', '/home/yanster/apps/yoga/');

// Tasks

//env for production
task('upload:env', function () {
    upload('.env.production', '{{deploy_path}}/shared/.env');
})->desc('Environment setup');

task('build', function () {
    run('cd {{release_path}} && build');
});

task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'upload:env',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:migrate',
    'yarn:install',
    'yarn:prod',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);


// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

