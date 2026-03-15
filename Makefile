IMAGE = task
VERSION = review-service
WORK_DIR = /var/www

COMPOSER_IMAGE=registry.gitlab.com/img-docker/composer

export IMAGE
export VERSION
export WORK_DIR

.PHONY: logs build up down vendor php

build:
	@docker compose build --build-arg IMAGE=$(IMAGE) --build-arg VERSION=$(VERSION)
up:
	@docker compose up -d
down:
	@docker compose down --volumes

logs:
	@docker compose logs -f

composer:
	@docker run -it --rm -v .:$(WORK_DIR) $(COMPOSER_IMAGE) $(c)
vendor:
	@docker run -it --rm -v .:$(WORK_DIR) $(COMPOSER_IMAGE) install

php:
	@docker run -it --rm -v .:$(WORK_DIR) --network=web-network-task --user 1000:1000 $(IMAGE):$(VERSION) $(c)