PORT ?= 8000
start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT) -t public

install:
	composer setup

setup:
	composer install
	php artisan key:gen
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm ci
	npm run build

validate:
	composer validate
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app tests
	./vendor/bin/phpstan analyse
lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app tests
test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text