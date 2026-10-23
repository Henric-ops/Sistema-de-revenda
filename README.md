<div align="center">

# 🛍️ SystemRevenda

### Gestão de clientes, vendas, pagamentos e controle financeiro

**Aplicação web em Laravel para organizar operações de revenda, acompanhar recebimentos e oferecer uma área de consulta aos clientes.**

![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-compat%C3%ADvel-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-suportado-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-8-646CFF?style=for-the-badge&logo=vite&logoColor=white)

![Tipo](https://img.shields.io/badge/Tipo-aplica%C3%A7%C3%A3o_web-blue?style=flat-square)
![Arquitetura](https://img.shields.io/badge/Arquitetura-MVC-informational?style=flat-square)

[Sobre](#-sobre-o-projeto) · [Funcionalidades](#-funcionalidades) · [Tecnologias](#-tecnologias) · [Instalação](#-instalação-e-configuração) · [Como usar](#-como-utilizar) · [Limitações](#-observações-e-limitações)

</div>

---

## 📖 Sobre o projeto

O **SystemRevenda** é um sistema web para gestão de revendas e controle de vendas a clientes. Centraliza o cadastro de clientes, registro de compras, lançamento de pagamentos e acompanhamento de valores recebidos e pendentes.

Conta com **área administrativa**, onde são feitas as operações de gestão, e **área do cliente**, destinada à consulta de compras e pagamentos vinculados ao usuário autenticado.

O painel administrativo apresenta indicadores financeiros, pagamentos recentes e gráficos dos últimos seis meses. Relatórios podem ser consultados e exportados para **PDF e CSV**.

## ✨ Funcionalidades

| Módulo | Recursos |
| --- | --- |
| 🔐 **Autenticação** | Login por e-mail ou telefone e senha, logout e perfis `admin` e `cliente` |
| 👥 **Clientes** | Cadastro, listagem, edição, exclusão, observações e associação a usuário |
| 🛒 **Compras** | Lançamento de produtos, valor total, forma de pagamento, parcelas, data e status |
| 💳 **Pagamentos** | Registro de valores pagos, método, data e observações; atualização do status da compra |
| 📊 **Dashboard** | Total de clientes, compras, recebimentos, saldo em aberto e gráficos financeiros |
| 📄 **Relatórios** | Compras por período, pagamentos e inadimplentes; exportações PDF/CSV disponíveis |
| 👤 **Área do cliente** | Visualização das próprias compras, pagamentos e valores em aberto |
| 📱 **Acesso por telefone** | Login pelo número de celular e fluxo de reenvio de acesso via WhatsApp |

### 📈 Regras financeiras

O sistema calcula o saldo restante de uma compra a partir do valor total menos os pagamentos registrados. O status das compras pode ser:

- **Pendente:** ainda não há valor pago.
- **Parcialmente pago:** o total pago é maior que zero, mas inferior ao valor da compra.
- **Pago:** os pagamentos atingem ou superam o valor total.

> O sistema registra pagamentos manualmente. Não foi identificada integração com gateway para cobrança ou pagamento online.

## 🧰 Tecnologias

| Camada | Tecnologia |
| --- | --- |
| Backend | PHP 8.3+, Laravel 13 |
| Interface | Blade, HTML, CSS, JavaScript |
| Estilização/build | Tailwind CSS 4, Vite 8 |
| Persistência | Eloquent ORM; SQLite ou MySQL conforme configuração |
| Relatórios PDF | `barryvdh/laravel-dompdf` |
| Relatórios CSV | Respostas de exportação CSV no PHP |
| Autenticação | Laravel Auth, sessões e middlewares |
| Testes | PHPUnit |
| Dependências | Composer, npm |

## 🗂️ Estrutura do projeto

```text
systemrevenda/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Clientes, compras, pagamentos, dashboards, relatórios
│   │   ├── Middleware/        # Regras de acesso
│   │   └── Requests/          # Validações
│   ├── Models/                # User, Cliente, Compra, Pagamento
│   └── Policies/              # Políticas de autorização
├── database/
│   ├── migrations/            # Estrutura do banco de dados
│   ├── factories/
│   └── seeders/
├── public/                    # Arquivos públicos e CSS/JS
├── resources/views/           # Templates Blade
├── routes/web.php             # Rotas web
├── tests/                     # Testes automatizados
├── composer.json
├── package.json
└── vite.config.js
```

## ⚙️ Instalação e configuração

### 1. Pré-requisitos

Certifique-se de ter instalado:

- **PHP 8.3+** com extensões exigidas pelo Laravel (incluindo PDO e o driver do banco utilizado);
- **Composer**;
- **Node.js e npm** compatíveis com Vite 8;
- **SQLite ou MySQL**;
- **Git** (para clonagem).

> **Importante:** o `composer.json` configura uma plataforma PHP `8.4.25` para resolução de dependências. Recomenda-se **PHP 8.4+** para reproduzir o ambiente do projeto; com PHP 8.3 pode ser necessário revisar as dependências e essa configuração.

### 2. Obter o projeto

Clone seu repositório (substitua a URL pelo endereço real) ou extraia o ZIP:

```bash
git clone <URL_DO_REPOSITORIO>
cd systemrevenda
```

### 3. Instalar dependências do PHP

```bash
composer install
```

### 4. Criar o arquivo de ambiente

No Linux/macOS/Git Bash:

```bash
cp .env.example .env
```

No PowerShell:

```powershell
Copy-Item .env.example .env
```

Gere uma chave exclusiva:

```bash
php artisan key:generate
```

### 5. Configurar o banco de dados

**Opção A — SQLite (mais simples para desenvolvimento)**

Crie o arquivo `database/database.sqlite` se ele não existir e ajuste `.env`:

```dotenv
APP_NAME=SystemRevenda
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

**Opção B — MySQL**

Crie um banco vazio, por exemplo `bdrevenda`, e configure o `.env`:

```dotenv
APP_NAME=SystemRevenda
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bdrevenda
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

A senha do MySQL deve ser informada de acordo com sua instalação. Nunca publique credenciais reais.

### 6. Revisar migração duplicada antes de migrar

**Atenção: o código enviado contém duas migrações que tentam adicionar a coluna `phone` à tabela `users`:**

```text
database/migrations/2026_05_14_182010_update_users_add_phone_and_fix_email.php
database/migrations/2026_05_14_183306_add_phone_to_users_table.php
```

A primeira já verifica se a coluna existe; a segunda tenta adicioná-la novamente. **Corrija a segunda migração** para verificar `Schema::hasColumn('users', 'phone')`, ou consolide as duas migrações **antes de criar um banco novo**. Não apague migrações já aplicadas sem avaliar o histórico do ambiente.

Em seguida:

```bash
php artisan migrate
```

> O seeder padrão cria apenas um usuário de teste comum e **não** cria um administrador. Não use `db:seed` esperando obter uma conta administrativa.

### 7. Criar o primeiro administrador

Com o banco migrado, abra o Tinker:

```bash
php artisan tinker
```

No console interativo, execute, substituindo os dados de exemplo pelos seus:

```php
\App\Models\User::create([
    'name' => 'Administrador',
    'email' => 'admin@exemplo.local',
    'phone' => null,
    'password' => \Illuminate\Support\Facades\Hash::make('TROQUE_POR_UMA_SENHA_FORTE'),
    'tipo' => 'admin',
]);
```

Saia digitando `exit`. **Não use a senha demonstrativa em um ambiente real.**

### 8. Instalar e compilar os recursos frontend

```bash
npm install
npm run build
```

Para desenvolvimento com atualização dos arquivos:

```bash
npm run dev
```

Mantenha esse terminal aberto se estiver usando o servidor de desenvolvimento do Vite.

### 9. Iniciar o Laravel

Em outro terminal:

```bash
php artisan serve
```

Acesse:

**http://127.0.0.1:8000/login**

Entre usando o e-mail e a senha da conta administrativa criada anteriormente.

## 🧑‍💻 Como utilizar

### 👑 Administrador

1. Entre no sistema pelo `/login` com sua conta de administrador.
2. Abra o **Dashboard** e consulte indicadores, pagamentos recentes e saldos pendentes.
3. Vá a **Clientes** para cadastrar uma pessoa, com nome, celular e observações.
4. Cadastre uma **Compra** vinculada a um cliente, informando produtos, valor, data e forma de pagamento.
5. Em **Pagamentos**, registre um recebimento associado à compra. O sistema atualiza o status conforme os valores pagos.
6. Acesse **Relatórios** para consultar compras por período, pagamentos e inadimplência, com opções de exportação.
7. Para disponibilizar o acesso ao cliente, use o recurso de usuário/acesso presente no cadastro e envie as credenciais pelo fluxo previsto no sistema.

### 👤 Cliente

1. Utilize o e-mail ou telefone vinculado ao usuário e a senha recebida.
2. Acesse a área `/cliente/dashboard` após o login.
3. Consulte suas compras, pagamentos e saldo em aberto.
4. Caso o acesso esteja bloqueado ou o cliente esteja inativo, procure o administrador.

### 📄 Relatórios e exportação

O projeto possui rotas para:

- Compras por período: visualização e exportação CSV;
- Relatório de pagamentos: PDF e CSV;
- Relatório de inadimplentes: PDF e CSV.

Os filtros por período incluem hoje, semana, mês e intervalo personalizado no relatório de compras.

## 🧪 Testes

Após configurar o ambiente, execute:

```bash
php artisan test
```

O repositório contém testes de clientes, compras e pagamentos. A presença dos arquivos de teste **não garante que todos passem**: os resultados devem ser validados no ambiente configurado.

## 🔒 Segurança e boas práticas

- Não publique `.env`, senhas, chaves, dumps com dados reais nem bancos contendo informações pessoais.
- Use `APP_DEBUG=false` em produção e configure `APP_URL` corretamente.
- Use HTTPS e mantenha PHP, Laravel e dependências atualizados.
- Execute migrations e outras rotinas administrativas somente em ambientes autorizados e com backup.
- Mantenha a raiz pública do servidor apontada para a pasta `public/` do Laravel.
- **Revise as permissões das rotas de relatórios e de reenvio de acesso:** no código analisado, elas estão declaradas fora do grupo administrativo protegido por middleware. Isso deve ser corrigido antes de publicar.
- O reenvio de acesso gera uma nova senha e a inclui na mensagem destinada ao WhatsApp. Avalie substituir esse mecanismo por redefinição de senha com token de uso único.

## ⚠️ Observações e limitações

1. **Migração duplicada:** a criação da coluna `phone` precisa de ajuste antes de uma instalação limpa.
2. **Primeiro usuário:** não há seeder administrativo pronto; é necessário criar a conta inicial.
3. **Banco de dados:** o sistema oferece migrations e suporta SQLite/MySQL, mas a execução completa não foi validada aqui.
4. **Proteção de rotas:** algumas rotas sensíveis precisam de revisão de autorização.
5. **Cobrança:** registra recebimentos, mas não há gateway de pagamento integrado identificado.
6. **Hospedagem:** configurações de produção variam conforme o provedor; o `.env` deve ser criado no servidor, nunca enviado ao repositório.

## 🔭 Melhorias futuras

- Recuperação segura de senha por token;
- Auditoria de alterações financeiras;
- Notificações automáticas sobre vencimentos;
- Controle de parcelas e datas de vencimento;
- Filtros e painéis mais avançados;
- Ampliação da cobertura de testes automatizados;
- Revisão de permissões e endurecimento da segurança para produção.

## 👨‍💻 Autor

**Henric Baccin**

[![GitHub](https://img.shields.io/badge/GitHub-Henric--ops-181717?style=for-the-badge&logo=github)](https://github.com/Henric-ops)
[![Portfólio](https://img.shields.io/badge/Portf%C3%B3lio-Visitar-22C55E?style=for-the-badge&logo=githubpages&logoColor=white)](https://henric-ops.github.io/henric-portifolio/)

---

<div align="center">


</div>
