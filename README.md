# Sistema de Rota Para Codeigniter 3
O **Ciroute** é simples, ele apenas oferece uma interface Orientada a Objetos, mais organizada e amigável para criação de Rotas para o ambiente de desenvolvimento. Em produção será usada as rodas normais do Codeigniter, pois o mesmo converte todas as rotas, e as gravas no arquivo padrão de rotas.

> AVISO!
> Quando estiver usando  **Ciroute** não pode mais escrever no arquivo padrão de rotas, pois o mesmo será sobrescrito todas as vezes que for executado em ambiente de desenvolvimento 

## Instalar
Precisamos instalar o pacote via composer.

```sh 
composer require dsisconeto/ciroute
```
## Configurando
No arquivo index.php do seu projeto, vamos instancia Ciroute em ambiente de desenvolvimento e apenas no mesmo. no final do arquivo antes do require do **Codeigniter** adicione o seguinte código
```php
if (ENVIRONMENT == 'development') {             
    require_once(__DIR__.'/vendor/autoload.php');
    
    new \DSisconeto\Ciroute\Ciroute(
        __DIR__."/$application_folder/config/routes.php",
        __DIR__."/$application_folder/cache/",
        __DIR__."/$application_folder/routes/"
        );
    }
```
A classe **Ciroute** tem três parâmetros

`Ciroute($arquivoDeRotas, $pastaCache, $pastaRotas)`
### Paramentros da Classe Ciroute
 1. Endereço completo onde está o arquivo de rotas padrão
 2. Endereço completo onde está a pasta de cache padrão
 3. Endereço completo onde vai ficar a pasta de arquivo de rotas do **Ciroute**
### Arquivos de Rotas

Precisamos criar a pasta onde ficará os arquivos de rotas, que é o terceiro parâmetro da classe **Ciroute**, no código acima foi passado a pasta **/apliication/routes/**, agora basta criar quantos arquivos de rotas você quiser dentro, os nomes dos arquivos são de sua escolha. Exemplo

- /application/routes/site.php 
- /application/routes/admin.php
- /application/routes/api.php
## Modo de Usar
Agora vamos usar a classe **Route** para criar nossas Rotas, dentro de qualquer arquivo rotas que esteja dentro da pasta de que definimos. Para facilitar o acesso a classe de um "use" na classe Route no começo do seu arquivo de rotas.
```php
use DSisconeto\Ciroute\Route; 
```
### Hello World

```php
Route::get('hello-world', 'Hello_word/index');
```
O código vai gerar a seguinte saida no arquivo de rotas padrão;
```php
$route["hello-world"]["GET"] = ["Hello_word");
```
Os métodos de criação de rotas aceitam dois parametros.
```php
Route::get($rota, $controler_metodo)]```
```
1. Rota
2. Controler o metodo do mesmo

Básicamente você pode escrever os dois argurmento como escreveria no sistema padrão de rotas do **CodeIgniter**
### Usando os verbos HTTP
Existe diversos métodos na classe Route para criação de rotas, cada um criar com um verbo HTTP diferente
```php
Route::get('eventos/cadastrar', 'create');
Route::post('eventos/cadastrar', 'store');
Route::get('eventos/:num/editar', 'edit/$1');
Route::put('eventos/:num/editar', 'update/$1');
Route::delete('eventos/:num', 'delete/$1');
```
a saida no arquivo padrão de rotas

```php
$route["eventos/cadastrar"]["GET"]="eventos/create"; 
$route["eventos/cadastrar"]["POST"]="eventos/store"; 
$route["eventos/:num/editar"]["GET"]="eventos/edit/$1"; 
$route["eventos/:num/editar"]["PUT"]="eventos/update/$1"; 
$route["eventos/:num"]["DELETE"]="eventos/delete/$1"; 
```



















