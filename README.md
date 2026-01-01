# CIPA STORE 🛍️

**CIPA STORE** is a modern, responsive, and full-featured E-Commerce application built with **Laravel 10** and **Tailwind CSS**. It is designed for fashion retailers, offering a seamless shopping experience and a powerful admin management dashboard.

![Cipa Store](https://via.placeholder.com/1200x600?text=Cipa+Store+Preview)

## 🚀 Features

### For Customers
*   **🛒 Shopping Cart**: Add items, adjust quantities, and view real-time totals.
*   **💳 Secure Checkout**: Integrated with **Midtrans Payment Gateway** for seamless payments.
*   **📦 Order Tracking**: Real-time order status tracking with Resi (Tracking Number).
*   **📱 Responsive Design**: Optimized for Desktop, Tablet, and Mobile.
*   **🔔 Email Notifications**: Receive updates when your order is shipped.

### For Admins
*   **📊 Dashboard**: Overview of sales, recent orders, and inventory status.
*   **📦 Product Management**: CRUD operations for Products and Categories with image uploads.
*   **🚚 Order Fulfillment**: Update status (Pending -> Shipping -> Delivered) and input Tracking Numbers.
*   **🖨️ Shipping Labels**: Print professional shipping labels directly from the dashboard.

## 🛠️ Tech Stack

*   **Framework**: [Laravel 10](https://laravel.com)
*   **Frontend**: [Blade Templates](https://laravel.com/docs/blade) + [Tailwind CSS 3](https://tailwindcss.com)
*   **Database**: MySQL
*   **Payment Gateway**: [Midtrans Snap API](https://midtrans.com)
*   **Icons**: Heroicons

## ⚙️ Installation

Follow these steps to set up the project locally:

### 1. Prerequisites
*   PHP >= 8.1
*   Composer
*   Node.js & NPM
*   MySQL

### 2. Clone & Install
```bash
git clone https://github.com/yourusername/cipa-store.git
cd cipa-store

# Install PHP dependencies
composer install

# Install JS dependencies
npm install
```

### 3. Configuration
Copy the `.env.example` file to `.env` and configure your database and Midtrans keys:
```bash
cp .env.example .env
```

Open `.env` and update:
```ini
DB_DATABASE=cipa_store
DB_USERNAME=root
DB_PASSWORD=

# Midtrans Configuration (Get keys from midtrans.com)
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false
```

### 4. Database Setup
Run migrations and seed the database with default data (Admin account & Sample products):
```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```

### 5. Run Application
Start the development servers:
```bash
# Terminal 1 (Laravel Server)
php artisan serve

# Terminal 2 (Vite Assets)
npm run dev
```

Visit `http://127.0.0.1:8000` in your browser.

## 🔑 Default Credentials

**Admin Account:**
*   **Email**: `admin@cipastore.com`
*   **Password**: `password`

**Customer Account:**
*   Register a new account or use the seeder generated users.

## 📄 License
The Cipa Store is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
