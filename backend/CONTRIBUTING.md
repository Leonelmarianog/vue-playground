# Development Guidelines

This document outlines the architectural and development standards for the Kanban Board Laravel backend. The project follows an MVC architecture enhanced with Hexagonal and Domain-Driven Design (DDD) principles to ensure scalability, testability, and maintainability.

---

### 1. Repository Pattern & Persistence
*   **Eloquent Models**: Located in `app/Models`. They are strictly for database persistence and Eloquent-specific logic (e.g., relationships, casts).
*   **Repositories**: Located in `app/Repositories`. All data access must be abstracted through repositories (e.g., `UserRepository`, `BoardRepository`).
*   **Domain Objects**: Repositories must receive and return Domain objects. Internally, they are responsible for mapping Domain objects to/from Eloquent models.
*   **Business Logic**: Business logic interacts with repositories to retrieve or store data, never directly with Eloquent models.
*   **Domain Isolation**: Each core domain entity (User, Board, List, Card, Label) must have a corresponding repository.

### 2. Domain-Driven Entities
*   **Rich Domain Objects**: Located in `app/Domain`. These classes (e.g., `App\Domain\Board`) encapsulate business logic and rules.
*   **Decoupling**: Domain entities must not have direct knowledge of Eloquent models, services, or repositories. They can, however, interact with other domain entities.
*   **Behavior**: Entities are not anemic; they should contain methods that enforce business rules and maintain a valid state.

### 3. Request & Response Handling
*   **Validation**: All incoming API requests must be validated using **FormRequest** classes (e.g., `app/Http/Requests/Api/V1/StoreBoardRequest`).
*   **Serialization**: All outgoing API responses must be transformed via **JsonResource** classes (e.g., `app/Http/Resources/Api/V1/BoardResource`) to ensure a consistent and decoupled API contract.

### 4. Service Layer (Use Cases)
*   **Orchestration**: Service classes (e.g., `app/Services/BoardService`) should be used to coordinate complex business logic, orchestrate interactions between multiple repositories, and manage domain entity lifecycles.
*   **Domain Objects**: Services must receive and return Domain Objects (or DTOs that do not leak HTTP layer details). They should not work with raw request data or Eloquent models.

### 5. Authentication & Authorization
*   **Authentication**: Leverage Laravel's built-in authentication system. Use **Laravel Sanctum** for SPA-to-API authentication.
*   **Authorization**: Use **Laravel Policies** (`app/Policies`) to centralize authorization logic for all resource actions.

### 6. API Versioning
*   **Structure**: Controllers, FormRequests, and JsonResources must be organized into versioned folders.
    *   Example: `app/Http/Controllers/Api/V1/`
    *   Example: `app/Http/Requests/Api/V1/`

### 7. SOLID Principles & Service Decoupling
*   **Interfaces**: Define clear interfaces for any external service integrations (e.g., `app/Contracts/MailService`).
*   **Dependency Injection**: Use Laravel's service container to bind interfaces to concrete third-party implementations, facilitating easy swapping and mocking during testing.

### 8. Testing & Quality
*   **Pest**: Use Pest for all unit and feature tests.
*   **Static Analysis**: Maintain a clean baseline with **PHPStan**.
*   **Coverage**: Target a high percentage of code coverage for domain and service layers.
