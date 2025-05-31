run:
	sudo port select --set php php82
	symfony server:start;

stop:
	symfony server:stop;

clear:
	php bin/console cache:clear;

diff:
	php bin/console doctrine:migrations:diff;

mig:
	php bin/console doctrine:migrations:migrate;

mig_p:
	php bin/console doctrine:migrations:migrate prev

watch:
	npm run watch;

t:
	php bin/console translation:download;
	php bin/console app:translation-version:update;

r_debug:
	php bin/console debug:router

dump_routes:
	php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json

run_fixture:
	php bin/console  sylius:fixtures:load vote_analitycs_attributes
