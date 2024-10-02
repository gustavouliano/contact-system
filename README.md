## Execução do Projeto

Após clonar/baixar o projeto, acesse o diretório principal (onde está o arquivo *docker-compose.yml*) e execute o comando:

```
docker compose up --build -d
```

Quando os containers estiverem rodando, será possível acessar o frontend pela url **localhost:3000** no navegador.

* Obs: As portas **3000**, **8001**, e **5432** devem estar livres.

* Obs²: Quando testado no Windows foi necessário alterar a quebra de linha de **CRLF** para **LF** no arquivo *entrypoint.sh* dentro da pasta **api**. A alteração pode ser feita abrindo o arquivo no vscode e clicando na parte inferior direita da tela onde está escrito **CRLF** que abrirá a lista de opções para selecionar **LF**.