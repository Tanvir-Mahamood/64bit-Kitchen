# Online Restaurant and Food Delivery Website

## Overview
This project aims to create a comprehensive online platform for a restaurant, enabling customers to browse, order, and track their food deliveries. 
The platform also provides an administrative panel for managing the restaurant's operations, including menu items, orders, and user interactions. 
The website has two main interfaces: the User Panel and the Admin Panel, each with distinct functionalities to ensure seamless interaction between users and administrators. 


## Technologies Used
1. Frontend:
   - HTML: For structuring the web pages
   - CSS: For styling the web pages
   - JavaScript: For dynamic interactions and user experience enhancements
2. Backend:
   - PHP: For server-side scripting and database interactions
   - SQL (MySQL): For storing and managing data
3. Server:
   - XAMPP: For local development and testing

## Features
This project is divided into user panel and admin panel.

### User Panel
The User Panel is designed for restaurant customers, offering the following functionalities:

1. User Authentication
   - Secure sign-up and login functionality for multiple users.
   - Passwords are securely stored using hashing.

2. Food Search and Categorization
   - Users can search for dishes by name or category.
   - Each dish is displayed with an image and price.

3. Online Ordering
   - Users can select multiple food items for ordering.
   - Ordered items are displayed in the "Add to Cart" section and the total bill is also showed.
   - Users can modify the contents of the cart (Adding or removing items, Changing quantity)
   - Finally the foods can be placed for checkout and payment can be completed.

4. Order Management
   - A dedicated Order Page shows the status of current orders and order history.

5. User Profile Management
   - Users can update their profile information, including their contact details, addresses and preferences and password.

6. Communication with Admin
   - Users can send text messages to the admin as feedback through a contact page.
   - Messages are private and only visible to the admin and user.



### Admin Panel
The Admin Panel is designed for the restaurant's management, providing the following features:

1. Admin Profile
   - Separate login for admin accounts.
   - Admin profiles are editable.

2. Security:
   - There is a secured separate login system for Admin interactions.
   - At first Admin has to collect the login credentials from the programmer.
   - After collecting credentials, he can change it to maintain security.
   - Then the admin can include multiple admins to share management responsibilities.

3. Food Item Management
   - Admin can add, delete, and edit food items displayed on the website.

4. Order Approval
   - Admin can view and approve or decline user orders.

5. User Communication
   - Admin can view messages or feedback sent by users.

6. Transaction Monitoring
   - A detailed overview of all transactions in the restaurant.

7. Admin Management
   - Admin can add additional admin accounts to share management responsibilities.

8. User Management:
   - Admin can view the registered users.





## System Architecture:

The system is primarily divided into two main components:

### User Panel:
| Page | Description |  
|---|---|
| Login Page | User login system. |
| Register Page | Register page for new users. |
| Home Page | Displays featured dishes, offers, and recent orders. |
| Menu Page | Lists available dishes with images, prices, and categories. |
| Cart Page | Allows users to add, remove, and modify items in their cart. |
| Checkout Page | Processes orders and collects payment information. |
| Order Page | Displays past orders and their status. |
| Profile Page | Allows users to update their personal information and preferences. |
| Contact Page | Provides a form for users to send messages to the admin. |
| About Page | Contains information about the restaurant. |
| Quick View Page | Allows user to observe any item. |
| Category Page | To categorize food items. |
| Check Out Page | Page containing ordered items and costing. |
| Search Page | To search food. |
| Update Page | In order to update user information, address, passwords. |

### Admin Panel:
| Page | Description |  
|---|---|
| Login Page | Admin login page. |
| Register Page | Admin register page which is not accessable by the users. |
| Dashboard | Provides an overview of key metrics, such as total orders, revenue, and active users and admins. |
| Admin Account Page | Hold information of admin. |
| Message Page | To receive messages or feedback from users. |
| Placed Order Page | Handle orders. |
| Product page | Display and manage products. |
| Update Product Page | Update products. |
| Update Profile Page | Update admin profile. |

### Image Folder
- [images](https://github.com/Tanvir-Mahamood/Restaurant-and-Food-Delivery-Website-main/tree/main/images) : Images for website frontend.
- [project images](https://github.com/Tanvir-Mahamood/Restaurant-and-Food-Delivery-Website-main/tree/main/project%20images) : Images of products.
- [uploaded_img](https://github.com/Tanvir-Mahamood/Restaurant-and-Food-Delivery-Website-main/tree/main/uploaded_img) : Uploaded product images.


## System Workflow
- User Interaction
  - A user signs up or logs in.
  - Searches and selects dishes to place in the cart.
  - Confirms an order and monitors the order status via the Order Page.
  - Communicates with the admin for support if needed.

- Admin Management
  - Admin logs in and manages dishes.
  - Reviews and approves pending orders.
  - View user message or feedback.
  - Monitors transactions and adds new admin accounts when required.



## Running the Project:
- Download and Install XAMPP Server: Follow the [official XAMPP website](https://www.apachefriends.org/download.html) instructions for your operating system. [Download and install XAMPP](https://www.apachefriends.org/)
- Clone the Project:                 Clone the project repository from GitHub using Git.

```
https://github.com/Tanvir-Mahamood/Restaurant-and-Food-Delivery-Website-main.git
```

- Configure Database:                Create a database within XAMPP and import the provided [SQL script](https://github.com/Tanvir-Mahamood/Restaurant-and-Food-Delivery-Website-main/blob/main/food_db.sql).
- Project Directory:                 Move the folder to the appropriate directory within your XAMPP server's document root.
- Database Configuration:            Edit the connection details in the [connection.php](https://github.com/Tanvir-Mahamood/Restaurant-and-Food-Delivery-Website-main/blob/main/components/connect.php) to point to your created database.
- Start XAMPP:                       Launch XAMPP and ensure Apache and MySQL are running.
- Access the Forum:                  Open your web browser and navigate to `http://localhost/[your_project_directory]`


## Future Enhancements
- Integrate payment gateways.
- Add real-time order notifications.
- Optimize for mobile devices.
- Implement analytics for admins to view order trends.
- Add multilingual support for a wider audience.





