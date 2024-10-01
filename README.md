# Guia de Configuração com Laravel Sail

Este guia fornece instruções passo a passo para configurar e executar um projeto Laravel usando o Laravel Sail, uma ferramenta para gerenciamento de Docker Compose em projetos Laravel.

## Instalação e Configuração

### 1. Instalação do Sail e Dependências

Para instalar o Laravel Sail e suas dependências, utilize o seguinte comando:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

Este comando garantirá que todas as dependências do projeto sejam instaladas corretamente.
<br>

### 2. Inicialização dos Containers

Após a instalação das dependências, você pode subir os containers Docker utilizando o seguinte comando:
```bash
mv .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

Isso inicializará todos os containers necessários para o seu projeto Laravel, permitindo que você execute o aplicativo em um ambiente Dockerizado com o banco rodando.
<br>

### 3. Explicação

Procurei realizar uma abordagem direta com as informações que tinha dos payloads. Compilei o que achei pertinente e criei o serviço de forma que independente do payload enviado, o sistema se vira para reunir as informações requeridas e grava tudo no banco impedindo que o mesmo id seja cadastrado novamente. 
<br>
Foi criado um provider para implementar da forma correta o singleton.
<br>
Todo o sistema foi criado pensando apenas em gravar os dados como requerido no teste, ou seja, não existe um endpoint para resgatar esses dados.
<br>
Achei mais interessante utilizar o docker com o Laravel Sail, criando dois containers, um pro banco e o outra pra aplicação. Nesse readme está o passo a passo para utilizar o docker da forma correta.
<br>
Na raiz do projeto tem um arquivo do insomnia para testar cada um dos payloads.