# CIPA STORE - Project Planning Documentation

## 1. IDENTIFICATION & ANALYSIS

### Target Market Analysis
**Demographic:**
- **Age:** 18 - 35 years old (Gen Z & Millennials).
- **Gender:** Male & Female (Unisex approach or segmented categories).
- **Location:** Indonesia (Urban and Suburban areas).
- **Income Level:** Middle to Lower-Middle class (Affordable fashion).

**Psychographic:**
- Individuals who follow current fashion trends.
- Price-sensitive but quality-conscious consumers.
- Mobile-first users who prefer shopping via smartphones.

### Online Consumer Behavior
- **Visual Oriented:** High-quality images significantly influence buying decisions.
- **Trust Issues:** Customers require clear return policies and secure payment methods to build trust.
- **Convenience:** Preference for instant payment verification and real-time shipping tracking.
- **Social Proof:** Reliance on reviews and ratings before purchase.

---

## 2. TECHNICAL SPECIFICATIONS (Laravel & MySQL)

### Database Schema (ERD Design)
The system will use a Relational Database Management System (MySQL). Key entities and attributes:

#### a. Users
- `id` (Primary Key)
- `name` (Varchar)
- `email` (Varchar, Unique)
- `password` (Varchar, Bcrypt Encrypted)
- `role` (Enum: 'admin', 'customer')
- `phone_number` (Varchar)
- `address` (Text, optional for shipping default)
- `timestamps`

#### b. Products
- `id` (Primary Key)
- `category_id` (Foreign Key -> Categories)
- `name` (Varchar)
- `slug` (Varchar, Unique for SEO)
- `description` (Text)
- `price` (Decimal/BigInt)
- `stock` (Integer)
- `image` (Varchar, path)
- `timestamps`

#### c. Categories
- `id` (Primary Key)
- `name` (Varchar)
- `slug` (Varchar)

#### d. Transactions (Orders)
- `id` (Primary Key)
- `user_id` (Foreign Key -> Users)
- `code` (Varchar, Unique Transaction ID)
- `total_price` (Decimal)
- `shipping_status` (Enum: 'pending', 'shipping', 'delivered')
- `payment_status` (Enum: 'unpaid', 'paid', 'expired', 'failed')
- `payment_token` (For Gateway)
- `courier` (Varchar, e.g., 'JNE', 'J&T')
- `shipping_cost` (Decimal)
- `timestamps`

#### e. Transaction Details
- `id` (Primary Key)
- `transaction_id` (Foreign Key -> Transactions)
- `product_id` (Foreign Key -> Products)
- `quantity` (Integer)
- `price` (Decimal, snapshot of price at time of purchase)

### Payment Gateway Integration
To increase customer trust and automate status updates:
- **Provider:** Midtrans (Recommended for Indonesia) or Xendit.
- **Methods:** Bank Transfer (Virtual Account), E-Wallets (GoPay, OVO, ShopeePay), QRIS.
- **Flow:**
    1. Customer checks out orders.
    2. System requests payment token from Gateway.
    3. Customer pays on Gateway page.
    4. Gateway sends Webhook (Callback) to Laravel system to update `payment_status` to 'paid'.

### Logistics Integration
- **API Provider:** RajaOngkir (Standard/Pro).
- **Functionality:**
    - Real-time shipping cost calculation based on weight (gram) and destination/origin city.
    - Courier options: JNE, POS, TIKI, Sicepat (depending on license).
    - Waybill tracking (Resi) integration if available on Pro plan.

---

## 3. USER ROLE & SECURITY

### User Roles Features
**1. Admin (Management Side)**
- **Dashboard:** View sales statistics, recent orders, and stock alerts.
- **Product Management:** CRUD (Create, Read, Update, Delete) products, categories, and inventory.
- **Order Management:** View orders, update shipping status, verify payments (if manual), print shipping labels.
- **User Management:** Manage customer data.

**2. Customer (Storefront Side)**
- **Browse & Search:** Filter products by category, price, search by name.
- **Cart:** Add/remove items, update quantity.
- **Checkout:** Input shipping address, select courier, choose payment method.
- **Order History:** View past transaction status and details.
- **Profile:** Manage account info and addresses.

### Data Security & Encryption
- **Authentication:** Use Laravel's built-in Auth system (Breeze/Jetstream) or Fortify.
- **Password Hashing:** Passwords must be hashed using `Bcrypt` or `Argon2`.
- **Middleware:**
    - `auth`: Protect customer routes.
    - `admin`: Custom middleware to restrict access to Admin Dashboard.
- **CSRF Protection:** Laravel automatically protects against Cross-Site Request Forgery on all POST forms.
- **SQL Injection Prevention:** Use Eloquent ORM or Query Builder bindings to sanitize inputs.
- **Sensitive Data:** Do not store Credit Card information locally; offload to Payment Gateway.

---

## 4. IMPLEMENTATION & TESTING PLAN

### Development Roadmap
1.  **Phase 1: Setup & Planning** (Days 1-2)
    - Install Laravel, set up Git repository.
    - Configure Database and Environment (.env).
    - Setup Layouts (Tailwind CSS/Bootstrap).

2.  **Phase 2: Core Architecture & Auth** (Days 3-4)
    - Migrate Database Schema.
    - Implement Authentication (Login/Register).
    - Create Admin Middleware.

3.  **Phase 3: Product & Catalog** (Days 5-7)
    - Implement Admin CRUD for Products/Categories.
    - Build Homepage and Product Detail views for Customers.

4.  **Phase 4: Transaction System** (Days 8-12)
    - Implement Shopping Cart (Session/Database).
    - Integrate RajaOngkir for Shipping Cost.
    - Implement Checkout Logic (Order storage).

5.  **Phase 5: Payment Integration** (Days 13-14)
    - Integrate Midtrans Snap API.
    - Handle Webhooks for automated status updates.

6.  **Phase 6: Final Polish** (Day 15)
    - UI/UX improvements.
    - SEO optimizations (Meta tags, URL slugs).

### Testing Plan
**a. Functionality Testing (Black Box)**
- Test all forms (Registration, Login, Checkout) with valid and invalid data.
- Verify calculations (Total price = (Item Price * Qty) + Shipping).
- Verify stock reduction after purchase.

**b. User Experience (UX) Testing**
- **Responsiveness:** Test on Mobile (Android/iOS) and Desktop.
- **Flow:** Ensure "Add to Cart" to "Payment" takes minimal clicks.
- **Feedback:** Ensure success/error messages are clear (e.g., "Out of Stock").

**c. Security Testing**
- Attempt to access Admin URL (`/admin`) without login (Should redirect).
- Attempt to access Admin URL as Customer (Should 403 Forbidden).
- Verify XSS: Input `<script>alert('hack')</script>` in product comments/forms (Should be escaped).
