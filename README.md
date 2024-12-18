# **Passo a Passo para Rodar a Aplicação Laravel com Docker Sail**
---

## **1. Pré-requisitos**

Antes de iniciar, certifique-se de ter os seguintes itens instalados no seu ambiente:

- **Docker** e **Docker Compose**
  - [Instalação do Docker](https://docs.docker.com/get-docker/)
  - [Instalação do Docker Compose](https://docs.docker.com/compose/install/)

---

## **2. Clonar o Projeto**

```bash
git clone https://github.com/rafaelssilva35/teste-php.git
cd teste-php
```

---

## **3. Instalar Dependências**

```bash
./vendor/bin/sail composer install
```
---

## **4. Copiar o Arquivo `.env`**

Crie o arquivo `.env` a partir do modelo `.env.example`:

```bash
cp .env.example .env
```

---

## **5. Gerar a Key para criptografia da aplicação**

```bash
./vendor/bin/sail artisan key:generate
```

---

## **6. Subir os Containers do Docker Sail**

```bash
./vendor/bin/sail up
```

> ⚠️ Deixe este comando rodando em um terminal. 
> Caso queira rodar em segundo plano, use:
> 
> ```bash
> ./vendor/bin/sail up -d
> ```

---

## **7. Configurar o Banco de Dados**

**migrations**:

```bash
./vendor/bin/sail artisan migrate
```

**seeders**:

```bash
./vendor/bin/sail artisan db:seed
```

## **8. Compilar Assets**

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```
---

## **9. Acessar a Aplicação**

A aplicação estará disponível no seguinte endereço:

```
http://localhost/
```

---

## **10. **Rodar Testes**

Para rodar os testes da aplicação, utilize:

```bash
./vendor/bin/sail test
```

---

## **11. Parar os Containers**

Para parar os containers do Docker Sail, execute:

```bash
./vendor/bin/sail down
```

---
