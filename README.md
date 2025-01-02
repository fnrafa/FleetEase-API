# Vehicle Booking Application (FleetEase)

## **Overview**

This application is designed for a nickel mining company with various regional locations, one headquarters, one branch
office, and six mining sites. It provides a comprehensive solution for monitoring and managing the company's vehicles,
including passenger and cargo types, whether owned by the company or rented. The app enables users to book vehicles,
monitor fuel consumption, track service schedules, and review vehicle usage history.

---

## **Features**

1. **User Management**:
    - Admin can manage users, roles, and hierarchical positions.
    - Approvers can approve bookings at multiple levels.

2. **Vehicle Management**:
    - CRUD operations for vehicles, including type, ownership, and service schedules.

3. **Driver Management**:
    - CRUD operations for driver records.

4. **Booking Management**:
    - Admin can create bookings, assign drivers, and set approvers.
    - Approvers can approve or reject bookings.

5. **Reports**:
    - Export booking and vehicle usage data in Excel format.

6. **Dashboard**:
    - Displays graphical data for vehicle usage and statistics.

---

## **Project Setup**

### **Requirements**

- **PHP**: 8.2
- **MySQL**: 8.0.26
- **Laravel**: ^10.0
- **Composer**: ^2.84

---

### **Installation**

1. Clone the repository:
   ```bash
   git clone https://github.com/fnrafa/FleetEase-API
   ```
2. Navigate to the project directory:
   ```bash
   cd FleetEase-API
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Configure the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Migrate and seed the database:
   ```bash
   php artisan migrate --seed
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```

---

### **Environment Configuration**

Set database credentials in the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

If required, configure mail services in `.env` for notifications.

---

## **Default Admin Credentials**

| **Role** | **Email**          | **Password** |
|----------|--------------------|--------------|
| Admin    | admin@fnrafa.my.id | password123  |

---

## **API Documentation**

The Postman documentation for this project is available at:  
[API Documentation](https://documenter.getpostman.com/view/26168270/2sAYJ7gzNM)

---

## **Activity and Physical Data Diagrams**

1**Physical Data Model**:

- Represents entities like `User`, `Position`, `Vehicle`, `Driver`, and `Booking`.
- Shows relationships:
- `User` to `Position`: One-to-Many
- `Booking` to `Vehicle`, `Driver`, and `User`: Many-to-One

**Note**: Refer to the project folder for detailed diagrams:

- `/diagrams/pdm.png`

---

## **Logs**

Application logs are automatically generated for key actions, such as:

- User login/logout
- Vehicle or driver updates
- Booking approvals or rejections

Logs can be found in the `storage/logs` directory.
