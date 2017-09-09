# Sistema de Rota Para Codeigniter 3
O **Ciroute** é simples, ele apenas oferece uma interface Orientada a Objetos, mais organizada e amigável para criação de Rotas para o ambiente de desenvolvimento. Em produção será usada as rodas normais do Codeigniter, pois o mesmo converte todas as rotas, e as gravas no arquivo padrão de rotas.

> AVISO!
> Quando estiver usando  **Ciroute** não pode mais escrever no arquivo padrão de rotas, pois o mesmo será sobrescrito todas as vezes que for executado em ambiente de desenvolvimento 

## Instalar e Configurar ##
Precisamos instalar o pacote via composer.

`composer require dsisconeto/ciroute`

No arquivo index.php do seu projeto, vamos instancia Ciroute em ambiente de desenvolvimento e apenas no mesmo. no final do arquivo antes do require do **Codeigniter** adicione o seguinte código

    if (ENVIRONMENT == 'development') {
        require_once(__DIR__.'/vendor/autoload.php');
        new \DSisconeto\Ciroute\Ciroute(
        __DIR__."/$application_folder/config/routes.php",
        __DIR__."/$application_folder/cache/",
        __DIR__."/$application_folder/routes/");
    }
    
A classe **Ciroute** tem três parâmetros

`Ciroute($arquivoDeRotas, $pastaCache, $pastaRotas)`

 1. Endereço completo onde está o arquivo de rotas padrão
 2. Endereço completo onde está a pasta de cache padrão
 3. Endereço completo onde vai ficar a pasta de arquivo de rotas do **Ciroute**

Estamos quase lá, agora só precisamos criar a pasta de arquivos de rotas, que é o terceiro parâmetro da **Ciroute**, no código acima foi passado a ***routes*** dentro da pasta da sua aplicação, agora basta criar quantos arquivos de rotas você quiser dentro da mesma, os nomes dos arquivos são a gosto. Exemplo

> /application/routes/site.php 
> /application/routes/admin.php
>  /application/routes/api.php
>  
