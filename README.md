### Running the application
```
php artisan serve
```

### API Endpoints
```
/api/orders
```

### Running the tests
```
php artisan test
```

### building the docker image
```
docker-compose up --build
```

### running the docker container
```
docker run -p 8000:8000 order-validation-api
```

<hr>

## SOLID 原則

1. ** Single Responsibility Principle **：
    - `OrderRequest` 負責處理表單驗證。
    - `OrderController` 負責處理業務邏輯。

2. ** Open/Closed Principle **：
    - `OrderRequest` 繼承自 `FormRequest`，可以通過擴展來添加更多驗證規則，而不需要修改已有代碼。

3. ** Liskov Substitution Principle **：
    - `OrderRequest` 繼承自 `FormRequest`，並且可以在任何需要 `FormRequest` 的地方替換使用。

4. ** Interface Segregation Principle **：
    - controller 和 class 沒有冗餘的方法，每個class只實現它們所需的方法。

5. ** Dependency Inversion Principle **：
    - `OrderController` 依賴於 `OrderRequest` 的抽象驗證，而不是具體的驗證實現。

## 設計模式

1. **工廠模式 (Factory Pattern)**：
    - Laravel 的服務容器用於創建 `OrderRequest` 實例。

2. **裝飾者模式 (Decorator Pattern)**：
    - 使用 `FormRequest` 對輸入進行驗證和處理，擴展了基礎的請求功能。