# Laravel CRM Application - Teams Module

This repository contains the **Teams Module** for a Laravel-based CRM application. It allows the creation, management, and soft deletion of teams, as well as tracking activity logs for auditing.

## 🧩 Features

- Create, Edit, and Delete Teams  
- Assign multiple team members  
- Soft delete support  
- Activity logging using Spatie's Activitylog  

## 🏗️ Folder Structure Overview

app/
├── Models/
│ └── Team.php
├── Http/
│ ├── Controllers/
│ │ └── TeamsController.php
│ └── Requests/
routes/
├── web.php
database/
├── migrations/
resources/
├── views/teams/



## ⚙️ Requirements

- PHP >= 8.1  
- Laravel >= 10.x  
- Composer  

## 🚀 Installation

1. **Clone this repo**

```bash
git clone https://github.com/your-username/laravel-teams-module.git
cd laravel-teams-module


    Install dependencies

composer install

    Setup .env and app key

cp .env.example .env
php artisan key:generate

    Run migrations

php artisan migrate

    Serve

php artisan serve

🧪 Example Routes

Update your routes/web.php:

use App\Http\Controllers\TeamsController;

Route::resource('teams', TeamsController::class);

📝 Model Overview

Team.php

    Uses SoftDeletes, HasFactory, and LogsActivity

    Logs changes to name, description, and team_members

📦 Packages Used

    spatie/laravel-activitylog — For activity tracking

✅ Sample Fields

    name: string

    description: text

    team_members: JSON array or relationship (customizable)

    deleted_at: soft delete timestamp

📄 License

MIT License. See LICENSE for more details.
