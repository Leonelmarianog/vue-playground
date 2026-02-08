# Kanban Board - Backend

This is the backend application for the Kanban Board project. It provides the data persistence and business logic required to manage boards, lists, and cards, among other resources.

# Requirements

- [PHP](https://www.php.net/)
- [Node.js](https://nodejs.org/)
- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/)

## Setup

Run, in order:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

## Usage

The project uses Docker to run services required by the application (like MySQL) which can be managed using the following commands:

```bash
make build # Build docker images
make up # Start containers in the background 
make stop # Stop containers
make down # Stop containers and remove volumes
```

Once the services are running, you can start the Laravel development server:

```bash
php artisan serve
```

## Linting & Formatting

```bash
composer run format # Format code
composer run format:check # Check for formatting errors
composer run lint:check # Check for linting errors
```

## Testing

We use **Pest** for testing and **Docker** for database isolation during feature tests.

### Local Configuration

Ensure you have a `.env.testing` file configured.

```bash
cp .env.example .env.testing
```

> Make sure to differentiate your testing environment variables from the one you may have in `.env` to avoid any potential issue.

### Running Tests

```bash
make coverage # Run tests with coverage
make test-unit # Run unit tests
make test-feature # Run feature tests
```

> The `test-feature` and `coverage` commands automatically spin up a dedicated MySQL container, run the tests, and tear everything down once finished.
