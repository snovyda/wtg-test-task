
# Test Task Solution


## Download
First, clone project:
``` bash
# clone
git clone git@github.com:snovyda/wtg-test-task.git <folder-name>

# Access project
cd <folder-name>
```

## Local Installation

``` bash
# Create file .env
cp .env.example .env
Then update required parameters (marked as <REQUIRED>)

# Docker Build (this step may take a while...)
docker compose build --no-cache

# Run Containers
docker compose up -d

# Navigate to Docker php container in new Terminal window
docker exec -it php bash
 
# Install dependencies
composer install

# Generate Application key
php artisan key:generate

# Run migrations and seed database with sample data
php artisan migrate --seed
```

`baseURL = http://127.0.0.1:8001`

## Start Queue Worker (to check queued import process)
``` bash
php artisan queue:work
```

## About preventing Race Condition

To prevent multiple users from reserving the same offer simultaneously (Race Condition)
I used Pessimistic Locking on Database Level. 
Laravel executes a SELECT ... FOR UPDATE SQL query. This instructs MySQL to lock the selected row for other 
transactions until the current transaction is completed (via commit or rollback).

- **Pros:** Guarantees absolute data consistency at the database level.</li>
- **Cons:** Under extreme traffic (e.g., a flash sale for a major concert), it can create a queue of waiting database connections, heavily loading MySQL.
