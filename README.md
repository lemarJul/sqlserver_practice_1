# Project Documentation

## Overview

Training project using PHP and Azure SQL Edge for managing products. Originally intended as an SQL Server training project, but moved to Azure SQL Edge due to architecture conflict (Apple Silicon ARM64). Azure Data Studio and a container based on the `mcr.microsoft.com/azure-sql-edge:latest` image are used for database management.
## Files and Structure

### `ajouter_produit.php`

Handles product addition to the database via POST request, validates data, and inserts into `produits` table.

### `config.php`

Azure SQL Edge database connection configuration: server name, database name, user ID, password.

### `css/style.css`

CSS styles for the web application: body, containers, headings, tables, forms, buttons.

## Usage

1. Azure SQL Edge running, `test_db` database created.
2. `config.php` in the same directory as `ajouter_produit.php`.
3. `css/style.css` in the `css` directory.
4. Access web application via web server to add products.

## Database

`produits` table schema:

- `id` (int, primary key)
- `nom` (varchar)
- `description` (text)
- `prix` (float)
- `quantite` (int)
- `date_creation` (datetime, nullable)

## Contributing

Pull requests or issues welcome.

## License

MIT License.