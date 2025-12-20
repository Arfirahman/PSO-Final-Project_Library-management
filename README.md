# Library Management System with Automated CI/CD Pipeline

**Final Project for Pengembangan Sistem dan Operasi (PSO) Course – DevOps Track** **Group 3 IUP Class – Institut Teknologi Sepuluh Nopember**

---

## 👥 Team Members
* **Arfiandra Rahman Aziz** (5026231119)
* **Razza Ibrahmwibowo Muktiadi** (5026231224)
* **Shifly Taysir Setiawan** (5026231046)

**Live Production URL**: [http://3.236.150.30/login](http://3.236.150.30/login)

---

## 📖 Project Overview
This is a web-based **Library Management System** built with Laravel 10 and PostgreSQL. It supports user authentication, book CRUD operations, borrowing/return functionality, and advanced features like a searchable dropdown for book selection.

The project features a fully automated **CI/CD pipeline** using GitHub Actions, Docker, and Terraform on AWS. This ensures that every code change is tested, containerized, and deployed to production with minimal manual intervention.



---

## ✨ Features
* **Role-based Access**: Separate dashboards for Admin and User roles.
* **Inventory Management**: Full CRUD capabilities for library books.
* **Transaction System**: Automated borrowing and return workflows.
* **Modern UI**: Built with Bootstrap for a fully responsive experience.
* **Infrastructure as Code**: AWS resources managed entirely via Terraform.

---

## 🛠️ Local Development Setup Steps
To set up this project on your local machine, follow these steps in order:

1. **Clone and Install**: Open your terminal and run `git clone https://github.com/Arfirahman/pso-final-library-management.git`. Navigate into the folder and run `composer install` to handle PHP dependencies, followed by `npm install && npm run build` for the frontend assets.
2. **Environment Configuration**: Create your environment file by running `cp .env.example .env`. Open the `.env` file and update the `DB_CONNECTION=pgsql` section with your local PostgreSQL host, database name, username, and password.
3. **Database Initialization**: Generate your unique application key using `php artisan key:generate`. Then, prepare your database schema and sample data by running `php artisan migrate --seed`.
4. **Launch**: Start the local development server with `php artisan serve`. You can now access the system at `http://localhost:8000`.

---

## 🐳 Docker Deployment Steps
If you prefer to run the application using containers, follow these steps:

* **Manual Build**: Execute `docker build -t library-app .` to create the image. Then, run the container using `docker run -d -p 8000:80 --env-file .env library-app`.
* **Automated Orchestration**: If you have Docker Compose installed, simply run `docker-compose up -d --build` to automatically build and start the application and its dependencies.

---

## ☁️ AWS Infrastructure & CI/CD Steps
To deploy this system to a live production environment on AWS, follow this automated workflow:

1. **Provisioning**: Go to the GitHub Actions tab in the repository, select the **terraform.yml** workflow, and run it manually. This uses Terraform to provision the EC2 instance and RDS PostgreSQL database on AWS.
2. **Automated Pipeline**: Once the infrastructure is ready, any push to the `main` branch triggers the **deploy.yml** and **deploy-to-ec2.yml** workflows. These workflows automatically run PHPUnit/Pest tests, build a multi-stage Docker image, push it to the GitHub Container Registry (GHCR), and pull it onto the EC2 instance for a zero-downtime update.

---

## ⚙️ Pipeline Summary
| Stage | Workflow File | Description |
| :--- | :--- | :--- |
| **Testing** | `laravel-tests.yml` | Validates code via PHPUnit/Pest with a PostgreSQL service |
| **Build & Push** | `deploy.yml` | Builds the Docker image and pushes to GHCR |
| **Deploy** | `deploy-to-ec2.yml` | Updates the EC2 instance with the latest image via SSH |
| **Infrastructure** | `terraform.yml` | Manages AWS EC2 & RDS resources via Terraform |

---

## 📁 Repository Structure
* `app/`: Application logic (Controllers, Models)
* `database/`: Migrations and seeders
* `resources/`: Blade views and frontend source
* `.github/workflows/`: Automation scripts
* `terraform/`: Infrastructure as Code files
* `Dockerfile`: Container configuration

---

## 📜 License
This project is for academic purposes only.
© 2025 Group 3 IUP Class – Institut Teknologi Sepuluh Nopember
