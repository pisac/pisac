DEFAULT_GOAL := help
help:
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z0-9_-]+:.*?##/ { printf "  \033[36m%-27s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

build: ## build project
	composer i --ignore-platform-reqs
	php --define phar.readonly=0 compile.php
	docker build -t docker.pkg.github.com/pisac/pisac/pisac:latest .
	docker push docker.pkg.github.com/pisac/pisac/pisac:latest
