# Cadastro Básico TI‑Proderj

Projeto de um CRUD simples de cadastro de pessoas, desenvolvido em Laravel com Blade e Bootstrap, para incluir, alterar, excluir e consultar registros contendo **Nome**, **Sexo**, **Telefone**, **Data de Nascimento** e **CPF**.

---

## Funcionalidades

- **Inclusão** de novos cadastros com validação completa (Form Request).  
- **Edição** de registros existentes.  
- **Exclusão** com confirmação.  
- **Listagem** paginada e busca por nome.  
- **Validação de CPF** com algoritmo de dígito verificador encapsulado em Rule personalizada.  
- **Máscaras de input** para CPF, telefone e data de nascimento via jQuery Mask.  
- **Formulários acessíveis** com labels vinculados e feedback visual de erros.  
- **Internacionalização**: mensagens em português (`pt_BR`).

---

## Estrutura do Projeto

app/
├── Http/
│ ├── Controllers/
│ │ └── RegistrationController.php
│ └── Requests/
│ └── RegistrationRequest.php
├── Models/
│ └── Registration.php
└── Rules/
└── CpfValido.php

config/
└── app.php (locale definido como pt_BR)

resources/views/
├── layouts/
│ └── app.blade.php
└── registrations/
├── form.blade.php
├── index.blade.php
├── create.blade.php
└── edit.blade.php

routes/
└── web.php (Route::redirect + Route::resource)

---

## Requisitos

- PHP >= 8.0  
- Composer  
- MySQL (ou outro banco compatível)

---

## Instalação

1. Clone este repositório:
   ```bash
   git clone https://github.com/Vitorfarani/Tela-de-Cadastro.git
   cd Tela-de-Cadastro

2. Instale dependências PHP:

   `composer install`

3. Copie o .env.example para .env e ajuste:
    ```bash
    APP_NAME="CadastroTIProderj"
    APP_URL=http://localhost
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cadastro
    DB_USERNAME=root
    DB_PASSWORD=

5. Gere a chave da aplicação:

    `php artisan key:generate`

6. Execute migrations:

    `php artisan migrate`

---

## Uso

1. Inicie o servidor local:

    php artisan serve

2. Acesse no navegador http://localhost:8000 ou http://127.0.0.1:8000.

3. Utilize a página Lista de Cadastros para buscar, editar ou excluir registros.

4. Clique em Novo Cadastro para abrir o formulário de inclusão.

---

## Boas Práticas Aplicadas

Rotas RESTful: Route::redirect para / e Route::resource para o CRUD.

Validação: classes de Form Request (RegistrationRequest) e mensagens em pt_BR.

Regras customizadas: CpfValido para validação do dígito verificador.

Reutilização de views: partial form.blade.php para evitar duplicação.

Formatação de dados: accessors no Model para CPF e telefone formatados.

Feedback ao usuário: mensagens flash e estilo is-invalid nos campos.

--- 

## Contribuição

Pull requests são bem-vindos! Para grandes mudanças, crie uma issue primeiro para discutirmos​ o escopo.

## Licença

Este projeto está licenciado sob a MIT License.

