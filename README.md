# Laravel Products API

> A simple CRUD API built with **Laravel 10** for managing products.  
> Implemented as a technical task to demonstrate Laravel skills, code structure, validation, error handling, and testing.

---

## 🚀 Requirements
- **PHP** 8.1 or higher  
- **Composer**  
- **MySQL / MariaDB** (or SQLite)  
- **Git**

---

## ⚙️ Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/mhmdatya72/laravel-developer-task.git
   cd laravel-products-api
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   - Copy `.env.example` to `.env`
   - Update database credentials in `.env`

4. **Run migrations**
   ```bash
   php artisan migrate
   ```

5. **Run the local development server**
   ```bash
   php artisan serve
   ```

6. **Run tests**
   ```bash
   php artisan test
   ```

---

## 📡 API Endpoints

| Method | Endpoint            | Description            |
|--------|---------------------|------------------------|
| GET    | `/api/products`     | List all products (with optional filters) |
| POST   | `/api/products`     | Create a new product |
| GET    | `/api/products/{id}`| Show a specific product |
| PUT    | `/api/products/{id}`| Update an existing product |
| DELETE | `/api/products/{id}`| Delete a product |

---

### 🔎 Filters
You can filter products by price range:

```
GET /api/products?min_price=50&max_price=200
```

---

## 🛠 Example Requests

### Create a product
```bash
curl -X POST http://127.0.0.1:8000/api/products      -H "Content-Type: application/json"      -d '{"name":"iPhone 15","price":1200.50,"stock":15}'
```

### Get all products
```bash
curl http://127.0.0.1:8000/api/products
```

### Get products with filters
```bash
curl "http://127.0.0.1:8000/api/products?min_price=1000&max_price=1500"
```

### Update a product
```bash
curl -X PUT http://127.0.0.1:8000/api/products/1      -H "Content-Type: application/json"      -d '{"price":999.99,"stock":20}'
```

### Delete a product
```bash
curl -X DELETE http://127.0.0.1:8000/api/products/1
```

---

## 🧪 Testing
The project includes a **Feature Test** for product creation:

```bash
php artisan test
```

---

## 📖 Approach
- Used **Laravel 10** with `apiResource` for clean RESTful routes.  
- Created a dedicated `ProductRequest` class to handle validation rules.  
- Implemented price range filtering using query parameters (`min_price`, `max_price`).  
- Wrapped controller logic in `try/catch` blocks for clear error handling.  
- Wrote a **Feature Test** to validate product creation via the API.  
- Organized code in a clean and structured way (Models, Controllers, Requests, Tests).

---

## 📝 Notes
- `.env` and `vendor/` folders are excluded from Git.  
- Commit history is split into meaningful steps (migration, controller, test, docs).  
- Designed for clarity, maintainability, and scalability.
