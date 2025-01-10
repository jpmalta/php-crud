# php-crud
Sistema CRUD simples para gerenciamento de usuários utilizando PHP + MySQL

# Sistema CRUD de Usuários

Este é um sistema simples para gerenciar o cadastro de usuários (CRUD: Create, Read, Update, Delete) utilizando:

- **Frontend**: HTML, CSS e JavaScript
- **Backend**: PHP (puro ou com Laravel)
- **Banco de Dados**: MySQL

## **Configuração do Ambiente Local**

Siga os passos abaixo para configurar e rodar o projeto na sua máquina local.

---

### **1. Requisitos**

Certifique-se de ter os seguintes softwares instalados:

- [XAMPP](https://www.apachefriends.org/) (para rodar Apache e MySQL).
- [Git](https://git-scm.com/) (para clonar o repositório).

---

### **2. Clonar o Repositório**

1. Abra o terminal de sua preferência (Prompt de Comando, PowerShell, Git Bash, etc.).
2. Navegue até a pasta onde deseja salvar o projeto, por exemplo:
   ```bash
   cd C:\xampp\htdocs
   ```
3. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/sistema-crud-usuarios.git
   ```
4. Acesse a pasta do projeto:
   ```bash
   cd sistema-crud-usuarios
   ```

---

### **3. Configurar o Banco de Dados**

1. Acesse o phpMyAdmin:

   - Abra o navegador e digite `http://localhost/phpmyadmin`.

2. Crie um banco de dados chamado `desafio`:

   - Clique em **Databases**.
   - Insira o nome `desafio`.
   - Escolha o collation `utf8_general_ci`.
   - Clique em **Create**.

3. Importe a estrutura da tabela:

   - No menu lateral, selecione o banco de dados `desafio`.
   - Clique na aba **SQL** e insira o seguinte comando:
     ```sql
     CREATE TABLE usuarios (
         id INT AUTO_INCREMENT PRIMARY KEY,
         nome VARCHAR(100) NOT NULL,
         email VARCHAR(100) NOT NULL UNIQUE,
         senha VARCHAR(255) NOT NULL,
         criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```
   - Clique em **Go**.

---

### **4. Configurar o Projeto**

1. Certifique-se de que o XAMPP está rodando:

   - No painel de controle do XAMPP, clique em **Start** no Apache e MySQL.

2. Verifique se o projeto está acessível:

   - No navegador, acesse `http://localhost/sistema-crud-usuarios/`.

3. Configure o arquivo de conexão com o banco:

   - Abra o arquivo `conexao.php` no diretório do projeto.
   - Certifique-se de que os dados de conexão estão corretos:
     ```php
     <?php
     $host = 'localhost';
     $user = 'root';
     $password = ''; // Sem senha padrão no XAMPP
     $database = 'desafio';

     $conn = new mysqli($host, $user, $password, $database);

     if ($conn->connect_error) {
         die('Falha na conexão: ' . $conn->connect_error);
     }
     ?>
     ```

4. Teste a conexão:

   - Acesse `http://localhost/sistema-crud-usuarios/teste.php`.
   - Se a mensagem **"Conexão bem-sucedida!"** aparecer, tudo está configurado corretamente.

---

### **5. Funcionalidades Disponíveis**

- **Listar Usuários**: Exibe todos os usuários cadastrados no banco de dados.
- **Cadastrar Usuário**: Permite adicionar novos usuários.
- **Editar Usuário**: Atualiza os dados de um usuário já existente.
- **Excluir Usuário**: Remove usuários do sistema.

---

### **6. Estrutura do Projeto**

```plaintext
sistema-crud-usuarios/
├── assets/
│   ├── style.css       # Arquivo de estilos CSS
│   └── script.js       # Arquivo de funções JavaScript (opcional)
├── conexao.php          # Arquivo de conexão com o banco de dados
├── index.php            # Página inicial do sistema
├── listar_usuarios.php  # Lista os usuários cadastrados
├── cadastrar_usuario.php# Formulário para cadastrar novos usuários
├── editar_usuario.php   # Página para edição de usuários
└── excluir_usuario.php  # Script para exclusão de usuários
```

---

### **7. Tecnologias Utilizadas**

- **Frontend**: HTML, CSS
- **Backend**: PHP
- **Banco de Dados**: MySQL

---

### **8. Contribuição**

Contribuições são bem-vindas! Para contribuir:

1. Faça um fork do repositório.
2. Crie uma branch com sua funcionalidade/correção: `git checkout -b minha-feature`.
3. Faça um commit das alterações: `git commit -m 'Minha nova funcionalidade'`.
4. Envie suas alterações: `git push origin minha-feature`.
5. Abra um Pull Request.

---

Se tiver dúvidas ou problemas, entre em contato pelo e-mail ou abra uma issue no repositório.

 
