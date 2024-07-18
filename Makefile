DOCKER_COMPOSE = docker-compose
PHP_CONTAINER = app
##
## Project
## -----
##

build: ## Install and start the project
	$(DOCKER_COMPOSE) build

kill: ## Kill project
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --remove-orphans

down: ## Project down
	$(DOCKER_COMPOSE) down

start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project
	$(DOCKER_COMPOSE) stop

enter: ## Enter docker
	docker exec -it $(PHP_CONTAINER) bash

list-git-aliases: ## List git aliases
	git config --get-regexp ^alias

chown: ## Chown all
	sudo chown -R rundaer:rundaer *

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
