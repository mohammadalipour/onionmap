say_hello:
	@echo "starting Onionmap project"

docker:
	@docker-compose build

docker_up:
	@docker-compsoe up -d

init_env:
	@mv .env.example .env

install_composer_package:
	@docker-compsoe exec php bash composer install

init_databases:
	@docker-compose exec php bash php bin/console doctrine:schema:update -f

clear_cache:
	@docker-compose exec php bash php bin/console cache:clear