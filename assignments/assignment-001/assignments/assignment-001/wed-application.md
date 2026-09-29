# Part C – Understanding a Web Application

## 1. Difference Between Frontend, Backend and Database

### Frontend

The frontend is the part of a web application that the user can see and interact with. It includes buttons, forms, menus, text, images and webpages.

**Example:**  
In an online booking system, the booking form where a customer enters their name, date and booking details is part of the frontend.

### Backend

The backend is the part of the application that works behind the scenes. It processes requests from the frontend, applies the required business rules and communicates with the database.

**Example:**  
When a customer submits a booking form, the backend receives the information, checks it and processes the booking.

### Database

A database is used to store and organize information so that an application can retrieve and manage it when needed.

**Example:**  
An online booking system can store customer names, email addresses, booking dates and booking details in a database.

## 2. What Happens When a Customer Uses an Online Booking System?

### Step 1: Customer Opens the Website

The customer enters the website address in a browser. The website loads the frontend, which displays the available services and booking options.

### Step 2: Customer Creates an Account

The customer enters information such as their name, email address and password into the registration form.

The frontend collects the information and prepares it to be sent to the backend.

### Step 3: Customer Enters Their Information

The customer fills in the required booking or registration details. The frontend may perform basic validation, such as checking whether required fields have been filled.

### Step 4: Customer Submits the Registration Form

When the customer clicks the submit button, the frontend sends the information to the backend through a request.

### Step 5: Frontend Sends Information to the Backend

The backend receives the information sent by the frontend. It processes the request and checks whether the information is valid.

### Step 6: Backend Processes the Request

The backend applies the application's rules. For example, it can check whether the customer's email is already registered and whether the requested booking information is acceptable.

### Step 7: Information Is Stored in the Database

If the information is valid, the backend sends it to the database. The database stores the customer's account or booking information.

### Step 8: Server Sends a Response Back to the User

After processing the request, the backend sends a response to the frontend. The frontend then displays the result to the customer.

For example, the customer may see a message saying that their registration or booking was successful.

## 3. Web Application Flow

The overall flow is:

**User → Frontend → API/Backend → Database → Backend → Frontend → User**

### Explanation of the Flow

1. The **User** interacts with the application.
2. The **Frontend** collects the user's information.
3. The **API/Backend** receives and processes the request.
4. The **Database** stores or retrieves the required information.
5. The **Backend** receives the database result and prepares a response.
6. The **Frontend** displays the response.
7. The **User** sees the result.
