Job Searching Laravel Application
This is a Laravel-based job searching system built for managing and applying to job postings. It includes separate functionalities for job owners and seekers, with authentication handled by Laravel Fortify.


General Functionality

•	Authentication with Laravel Fortify

•	Role-based access: owner and seeker

For Job Owners

•	Create job listings via a secure form (/jobs/createjob)

•	Store job attributes: title, description (JSON), location, salary, employment type, remote option, end date

•	Jobs are associated with the owner's company and user ID

For Job Seekers

•	View job listings

•	Save jobs to a personal list (like bookmarks)

•	Save job searches and viewed job descriptions for analytics or future suggestions


