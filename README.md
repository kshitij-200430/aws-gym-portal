# aws-gym-portal
A Gym Management Web Application built with PHP and MySQL, deployed on AWS using EC2, RDS, and S3.

🏋️‍♂️ Gym Management System — AWS Deployment
A fully functional Gym Management Web App built with PHP, MySQL, HTML, and CSS, deployed on AWS using EC2, RDS, and S3. This project demonstrates real-world cloud deployment practices using AWS.

📌 Features
Admin & user login panels

Member management

Workout plans & payments

Database-driven dashboard

Cloud-hosted via AWS services

🧱 Tech Stack
Frontend: HTML, CSS, JavaScript

Backend: PHP

Database: MySQL (via Amazon RDS)

Hosting: AWS EC2

Storage: AWS S3 (for optional assets or backups)

☁️ AWS Services Used
Service	Purpose
EC2	Hosts the PHP web server
RDS	Manages MySQL database
IAM	Provides access control for EC2, RDS
Security Groups	Controls access to app and database

🖼️ Screenshots
Add screenshots here using the format below (place screenshots in a /screenshots folder)

scss
Copy
Edit
![Login Page](<img width="1920" height="934" alt="image" src="https://github.com/user-attachments/assets/8932d27f-bc08-475b-b54b-dd25b138c994" />
)
User Dashboard
<img width="1920" height="927" alt="image" src="https://github.com/user-attachments/assets/8ac86170-174a-4dcd-af4e-bc86c1602888" />

!Booking(<img width="1899" height="928" alt="image" src="https://github.com/user-attachments/assets/eec1b0b8-c87a-49bb-88eb-37a5600b74e0" />
)
⚙️ Setup Instructions
1. Clone the Repo
bash
Copy
Edit
git clone [https://github.com/your-username/gym-management-system-aws.git](https://github.com/kshitij-200430/Gym-Management-System-.git)
cd gym-management-system-aws
2. Launch on AWS
✅ Upload your project to EC2 using scp

✅ Set file permissions & install LAMP stack

✅ Import .sql file to your RDS database

✅ Edit database connection in dbconnection.php

✅ Ensure security groups allow port 80 for EC2 and 3306 for RDS

3. Access the Application
Visit your EC2 Public IP or domain:

cpp
Copy
Edit
http:13.233.227.156/index.php
📂 Folder Structure (Optional)
pgsql
Copy
Edit
.
├── admin/
├── user/
├── includes/
├── dbconnection.php
├── index.php
└── README.md
💡 Future Enhancements


✍️ Author
Kshitij Kadam
Open to internships and DevOps projects
🔗 LinkedIn(www.linkedin.com/in/kshitij-kadam-038b23264)
