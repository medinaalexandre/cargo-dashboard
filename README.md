# Cargo Dashboard

Aplicação fictícia para analisar os dados de um pátio de containers para exportação.

[![Conventional Commits](https://img.shields.io/badge/Conventional%20Commits-1.0.0-%23FE5196?logo=conventionalcommits&logoColor=white)](https://conventionalcommits.org)
[![api test](https://github.com/medinaalexandre/cargo-dashboard/actions/workflows/run-tests.yml/badge.svg)](https://github.com/medinaalexandre/cargo-dashboard/actions/workflows/run-tests.yml)
---

<img src="./docs/assets/cargo-dashboard-devices.jpg">

## Executando a aplicação
Para executar a aplicação, é necessário possuir o [Docker](https://www.docker.com/) instalado e rodar os seguintes comandos:
```shell
chmod +x build.sh
./build.sh
```

## Sumário
- [Front-end](#front-end)
  - [Tecnologias utilizadas](#tecnologias-utilizadas)
  - [Funcionalidades](#funcionalidades)
    - [Gráficos](#gráficos)
    - [Single Page Application](#single-page-application)
    - [HTTP State](#http-state)
- [Back-end](#back-end)
  - [Tecnologias utilizadas](#tecnologias-utilizadas-1)
  - [Clean Architecture](#clean-architecture) 
  - [Explicando a Listagem de Containers](#explicando-a-listagem-de-containers)
  - [Regras da Aplicação](#regras-da-aplicação)
  - [Regras de Domínio](#regras-de-domínio)
  - [Testes](#testes)
- [Desenvolvimento](#desenvolvimento)
  - [Tecnologias utilizadas](#tecnologias-utilizadas-2)

# Front-end
## Tecnologias utilizadas
- **Framework:** [Vue3](https://vuejs.org/)
- **UI:** [Vuetify](https://vuetifyjs.com/en/)
- **Routing:** [VueRouter](https://router.vuejs.org/)
- **Data fetching:** [VueQuery](https://tanstack.com/query/latest/docs/framework/vue/installation)
- **Code formatting**: [ESLint](https://eslint.org/) / [Prettier](https://prettier.io/)

## Funcionalidades
### Gráficos
Os gráficos foram gerados utilizando a biblioteca [apexcharts](https://apexcharts.com/), que possibilita ao usuário
realizar o download dos dados do gráfico em CSV.

### Single Page Application
Utilizando o [VueRouter](https://router.vuejs.org/), foi construida uma aplicação SPA, o que reduz a quantidade de dados
trafegados ao utilizar a aplicação, visto que a barra superior e lateral são carregadas apenas uma vez.

### HTTP State
Com a obtenção dos dados através do [VueQuery](https://tanstack.com/query/latest/docs/framework/vue/installation), a resposta
fica salva em um cache local. Assim, se o usuário vai para uma página e volta em menos de 30 segundos (esse tempo pode ser alterado),
os dados serão recuperados do cache sem a necessidade de consultar na API novamente. Um bom caso de uso é durante a paginação.
 


# Back-end
## Tecnologias utilizadas
- **Framework:** [Laravel](https://laravel.com/)
- **Database:** [PostgreSQL](https://www.postgresql.org/)
- **Testing:** [PestPHP](https://pestphp.com/)

### Clean Architecture
Em vez de seguir o padrão tradicional do Laravel, onde o fluxo geralmente é:
```mermaid
flowchart LR
FormRequest-->Controller-->Service-->JsonResource
```

Optei por implementar a API utilizando [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html) do Uncle Bob.

Dado que esta aplicação é uma Dashboard que pode ser utilizada por uma equipe de BI, existe a possibilidade de que os
dados venham de diversas fontes além do banco de dados da aplicação. Com a Clean Architecture, graças a
**Inversão de Dependência** de forma fácil e rápida podemos trocar as fontes de dados sem alterar as regras de negócio
da aplicação. Caso aumente o uso da dashboard que possui consultas pesadas, podemos facilmente adicionar uma camada
de cache utilizando Redis por exemplo, assim aumentando a **escabilidade** da aplicação.

## Explicando a Listagem de Containers

```mermaid
flowchart LR
ListContainersController-->ListContainerUseCase-->ContainerRepository-->ListContainerOutputPort
```

A Aplicação fica responsável por montar o UseCase e definir como deve ser o comportamento, ou seja, a aplicação que define
qual vai ser o repositório concreto que vai buscar os dados dos containers e qual porta de saída irá retornar os dados.

A aplicação monta o output do ListContainersUseCase no [AppServiceProvider](api/app/Providers/AppServiceProvider.php)
e o repositório em [RepositoryServiceProvider](api/app/Providers/AppServiceProvider.php):
````php
// app/Providers/AppServiceProvider.php
$this->app->bind(ListContainerOutputPort::class, ListContainersArrayOutput::class);

// app/Providers/RepositoryServiceProvider.php
$this->app->bind(ContainerRepository::class, function ($app) {
    return new EloquentContainerRepository(new Container());
});
````

## Regras da Aplicação
As regras de aplicação ficaram dentro do UseCase, são elas:
- Se não for passada uma página nos filtros, então será retornada a primeira.
- Se não for passada uma quantidade de itens por página, então será 10.

## Regras de Domínio
As regras de domínio ficaram dentro da camada de domínio:
- O limite do pátio em ContainerYard para calcular o espaço utilizado.

## Testes
Os testes da API estão com uma cobertura de **94.8%**. Para reduzir a quantidade de código escrito e facilitar os testes
dos filtros, foi utilizado o [Dataset](https://pestphp.com/docs/datasets)
[ListContainerFilterParamsData](api/tests/Datasets/ListContainerFilterParamsData.php).

A cobertura completa dos testes gerados pelo php-code-coverage pode ser baixada
[no artefato gerado](https://github.com/medinaalexandre/cargo-dashboard/actions/workflows/run-tests.yml) pelo workflow.


# Desenvolvimento
## Tecnologias utilizadas
- [Docker](https://www.docker.com/)
- [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/)
