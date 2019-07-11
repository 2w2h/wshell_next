help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  build"
	@echo "  start"
	@echo "  stop"
	@echo "  enter"
build:
	@docker-compose build
start:
	@docker-compose up -d
stop:
	@docker-compose stop
enter:
	@docker exec -it -u workspace wshell_workspace_1 zsh