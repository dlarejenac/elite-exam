## Elite Software and Data Security Inc.
Technical Examination

## Requirements
- PHP^8.1+
- Composer
- MySQL
- Node.js & npm (Tailwind CSS & Flowbite)
- Laravel^10.x (Latest version of Laravel will be installed upon setup)
- XAMPP/WAMP
- Git

## Setup Instructions
**1. Clone the Repository**
```bash
git clone https://github.com/dlarejenac/elite-exam.git
cd elite-exam
```
**2. Project Setup**
```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```
**3. Run the Web Application**
```bash
php artisan serve
npm run dev
```
**NOTE: Incase you want to refresh the database migration**
```bash
php artisan migrate:fresh --seed
```
