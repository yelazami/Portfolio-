#!/bin/bash
set -o nounset
set -o errexit

OPTIND=1
env=''

if [ "$env" == '' ]; then
  [ ! -f .env ] && cp .env.dist .env;
else
  [ ! -f .env ] && cp .env"$env" .env;
fi
source .env


# Common operations
initialize() {
      down
      start
      install
      populate
    if [ "$env" == '' ]; then
        gitHooks
    fi
}

start() {
    docker-compose -f docker-compose"$env".yml up -d --remove-orphans
    sleep 1
    docker-compose -f docker-compose"$env".yml ps
}

gitHooks() {
    echo "add git hooks"
    cp -R .git-hooks/hooks/ .git/hooks
    chmod -R 744 .git/hooks
    git config core.hooksPath .git/hooks
}

install(){
  installBack
}

installBack() {
    echo 'Install Back'
    docker-compose -f docker-compose"$env".yml run --rm -T --user=root --no-deps --entrypoint="/bin/bash -c"  php-fpm "chown 33:33 /var/www -R"
    docker-compose -f docker-compose"$env".yml run -T --rm --user=www-data --no-deps --entrypoint="/bin/bash -c" php-fpm "composer install --prefer-dist --no-interaction --optimize-autoloader &&
                                                                                                                          npm i &&
                                                                                                                          npm run dev"
}

populate() {
    echo 'Populate'
    docker-compose -f docker-compose"$env".yml exec -T --user www-data php-fpm bash -c "bin/console do:sc:up -f &&
                                                                                        bin/console ha:fi:lo -n"
}

stop() {
    echo 'Stop docker'
    docker-compose -f docker-compose"$env".yml stop
}

down() {
    echo 'Down docker'
    docker-compose -f docker-compose"$env".yml down --remove-orphans
}

buildFront() {
    docker-compose -f docker-compose"$env".yml exec -T --user www-data php-fpm bash -c "npm run build"
}

watchFront() {
    docker-compose -f docker-compose"$env".yml exec -T --user www-data php-fpm bash -c "npm run watch"
}

csFixer() {
    paths=""
    config=".php_cs.dist"

    if [ "$#" -ge 1 ]; then
        paths="$1"
        docker run --rm --user www-data --env-file=.env.test -v ${PWD}/app/:/var/www/portfolio/ -w /var/www/portfolio/ portfolio_php-fpm-test bash -c "php -l $paths"

        if [ "$#" -eq 2 ]; then
            config="$2"
        fi
    fi
    docker run --rm --user www-data --env-file=.env.test -v ${PWD}/app/:/var/www/portfolio/ -w /var/www/portfolio/ portfolio_php-fpm bash -c "vendor/bin/php-cs-fixer fix --config=$config $paths -vv"
}


unitTestsBack() {
    echo -e "\n\n\nUnit Test : "
    docker run --rm --user www-data --env-file=.env.test -v ${PWD}/app/:/var/www/portfolio/ -w /var/www/portfolio/ php-fpm-test bash -c "vendor/bin/phpunit"
}

qualityTestsBack() {
    docker-compose -f docker-compose.test.yml up -d php-fpm-test

    echo -e "\n\n\nCs Fixer : App/"
    docker-compose -f docker-compose.test.yml exec -T --user www-data php-fpm-test vendor/bin/php-cs-fixer fix --config=.php_cs.dist --dry-run --diff -vv

    # Lint PHP files
    docker-compose -f docker-compose.test.yml exec -T --user www-data php-fpm-test php -l src/
    docker-compose -f docker-compose.test.yml exec -T --user www-data php-fpm-test php -l features/

    # Bundles security check
    docker-compose -f docker-compose.test.yml exec -T --user www-data php-fpm-test vendor/bin/security-checker security:check

    docker-compose -f docker-compose.test.yml down
}

functionalTestsBack() {
    if [ "$#" -ne 1 ]; then
        tags=''
    else
        tags="--tags $1"
    fi

    docker-compose -f docker-compose.test.yml up -d back-test
    docker-compose -f docker-compose.test.yml ps

    docker-compose -f docker-compose.test.yml exec -T --user root php-fpm-test bash -c "chmod 777 /tmp/screenshots"
    docker-compose -f docker-compose.test.yml exec -T --user www-data php-fpm-test bash -c "vendor/bin/behat $tags -v --format=progress"

    docker-compose -f docker-compose.test.yml down
}

#TODO: set deployment
#prodDeploy() {
#
#}

#TODO: set deployment
#prodRollback() {
#
#}

# Usage info
show_help() {
cat << EOF
Usage:  ${0##*/} [-e] [COMMAND]
Options:
  -e string        Specify env ("test"|"dev") (default "dev")

Commands:
  initialize                  Start the project no matter what state it is in
  start                       Start docker containers
  gitHooks                    Add hooks precommit
  install                     Run app installation scripts
  installBack                 Run back app installation scripts
  populate                    Load database schema and fixtures
  stop                        Stop docker containers
  down                        Remove docker containers
  csFixer                     Execute php-cs-fixer and php lint
  build                       Build the front to the public folder
  watch                       Watch the assets and compile to the public folder
  testsBack                   Run back unit tests and functional tests
  unitTestsBack               Run back unit tests
  qualityTestsBack            Run back quality tests
  functionalTestsBack         Run back functional tests
  pullImages                  Pull latest images from private repository
  pushImages                  Update registry image
  prodDeploy                  Deploys to prod
  prodRollback                Rollback to previous release
EOF
}
# Get cli options
while getopts "he:" opt; do
  case $opt in
    h)
        show_help
        exit 0
        ;;
    e)
        env=".$OPTARG"
        ;;
    *)
        show_help >&2
        exit 1
        ;;
  esac
done

# Shift off the options and optional --.
shift "$((OPTIND-1))"


# Show help if no argument was supplied
if [ $# -eq 0 ]
  then
    show_help >&2
    exit 1
fi

case "$1" in
 initialize)
        initialize
        ;;
 start)
        start
        ;;
 stop)
        stop
        ;;
 down)
        down
        ;;
 restart)
        stop
        start
        ;;
 gitHooks)
        gitHooks
        ;;
 install)
        install
        ;;
 installBack)
        installBack
        ;;
 testsBack)
        unitTestsBack
        qualityTestsBack
        functionalTestsBack
        ;;
 populate)
        populate
        ;;
 unitTestsBack)
        unitTestsBack
        ;;
 functionalTestsBack)
        functionalTestsBack
        ;;
 qualityTestsBack)
        qualityTestsBack
        ;;
 prodDeploy)
        prodDeploy
        ;;
 prodRollback)
        prodRollback
        ;;
 build)
        buildFront
        ;;
 watch)
        watchFront
        ;;
 csFixer)
        csFixer
        ;;
 *)
        show_help >&2
        exit 1
esac

exit 0
