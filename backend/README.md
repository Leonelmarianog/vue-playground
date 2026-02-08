# Kanban Board - Backend

This is the REST API for the Kanban Board project. It provides the data persistence and business logic required to manage boards, lists, and cards, among other resources.

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

## Usage

The project uses Docker for required services (like MySQL):

*   `make up`: Starts the development containers in the background.
*   `make stop`: Stops the running containers.
*   `make down`: Stops and removes the containers and their volumes.
*   `make build`: Rebuilds the Docker images.

Once the services are running, you can start the Laravel development server:

```bash
php artisan serve
```

## Linting & Formatting

We use **Laravel Pint** to maintain a clean and consistent code style.

To automatically fix code style issues, run:

```bash
composer run format
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

You can run tests using the following commands:

*   **All Tests**: `make coverage`
*   **Unit Tests**: `make test-unit`
*   **Feature Tests**: `make test-feature`

> The `test-feature` and `test` commands automatically spin up a dedicated MySQL container, run the tests, and tear everything down once finished.
