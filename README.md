# Reeceflix - Netflix Clone Web Application 🎬

**Reeceflix** is a fully-featured, dynamic web application inspired by Netflix, designed to showcase the power of Vanilla JS, jQuery, PHP, MySQL, HTML, and CSS. This project mimics a real-world streaming platform, offering seamless user interaction, secure login functionality, and responsive video controls, providing a smooth user experience across devices.

## 🚀 Features

### 🔐 User Authentication System
- **User Panel**: Users can register, log in, and manage their profiles securely.
- **Login Functionality**: User credentials are validated using PHP and MySQL, ensuring secure authentication with hashed passwords.
- **Session Management**: Users remain logged in across sessions until they choose to log out.

### 🔎 Dynamic Search with AJAX
- **Instant Search**: Implemented with AJAX and jQuery, Reeceflix features a live search bar that updates results in real-time as users type.
- **Dynamic Keyup Trigger**: Efficient searching experience via AJAX requests that respond immediately on every keyup event, displaying the relevant results instantly without page reloads.

### 🎥 Video Control with Vanilla JS
- **Custom Video Controls**: Complete control over the video player using JavaScript, allowing users to play, pause, adjust volume, and seek content.
- **Fully Responsive Design**: The player is designed to work seamlessly on different screen sizes, ensuring an optimal viewing experience on mobile and desktop devices alike.

### 📺 Content Display and Management
- **Dynamic Content Loading**: Reeceflix dynamically loads and displays videos, making it highly adaptable and scalable for a large content base.
- **User-Friendly Interface**: A modern and intuitive user interface built with CSS and HTML, providing users with a familiar and enjoyable experience.

### 📊 Backend and Database
- **PHP & MySQL Integration**: The back end is powered by PHP and MySQL, ensuring data integrity and security. All user data, search queries, and video metadata are stored in a well-structured MySQL database.
- **Content Management**: Administrators can easily manage video content and users via MySQL and PHP backend functionality.

### 💻 Technology Stack
- **Vanilla JavaScript & jQuery**: Used for DOM manipulation, AJAX requests, and interactive elements such as video controls and search functionality.
- **PHP & MySQL**: For backend processing, database management, and user authentication.
- **HTML5 & CSS3**: For the frontend layout, structure, and styling, ensuring a responsive and modern design.
- **AJAX**: Ensures dynamic and asynchronous operations for a smooth user experience without constant page reloads.

## 🔧 Installation & Setup

1. **Clone the repository**:
    ```bash
    git clone https://github.com/AOKeklik/reeceflix.git
    ```

2. **Database Setup**:
   - Import the SQL file (`reeceflix.sql`) in the `database/` folder into your MySQL database.
   - Update the database connection details in `includes/config.php`.

3. **Run the Application**:
   - Ensure your local server (e.g., XAMPP, WAMP, MAMP) is running.
   - Access the application via `http://localhost/reeceflix`.

## 🌐 Live Demo
Coming Soon!

## ✨ Future Improvements
- **Admin Panel**: Add a dedicated admin panel for managing video content and users.
- **Subscription Model**: Integrate payment gateways for premium subscriptions.
- **Multi-language Support**: Implement support for multiple languages to reach a broader audience.
- **Recommendation System**: Add an AI-powered recommendation engine to suggest content based on user preferences and viewing history.

## 🛠️ Contributions
Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](https://github.com/AOKeklik/reeceflix/issues).

## 📄 License
This project is licensed under the MIT License.
