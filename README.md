# CV Manager Application

## Overview

This is a web-based quiz application built using Laravel 10 and ES6. It allows users to create their own CVs.

## Features

- Create one new CV.
- List of all users with completely filled CVs by dates of birth period filter.
- Aggregated report by candidates' age and skills.

## Usage

- `/`: Create new CV.
  - A new university could be added with an popup form.
  - A new skill could be added with an popup form.
- `/cv/search_by_dobs`: List of all users with completely filled CVs by dates of birth period filter.
- `/cv/age_skills_report`: Aggregated report by candidates' age and skills.

## Database

**DB Tables**

- `universities`.
- `users`.
- `skills`.
- `skill_user` - The table relates users and skills tables. The relation is "many to many".
- `cvs`.

## Future Improvements

- Multiple languages could be implemented. Also validation errors should be translated.
- DB queries should be more specified (fields restricted) by needed fields only.

## Local Server Installation

1. Clone the repository.
2. Run the following commands to install all needed resources:
   - `composer install`: Installs all needed php packages.
   - `npm install`: Installs all needed node.js packages.
3. Configure your database settings in the `.env` file.
4. You can generate an APP_KEY with: `php artisan key:generate` command.
5. Run the following commands to set up the database:
   - `php artisan migrate`: Run all migrations.
   - `php artisan db:seed --class=UniversitySeeder`: Seed the database with seeder class `UniversitySeeder`.
   - `php artisan db:seed --class=UserSeeder`: Seed the database with seeder class `UserSeeder`.
   - `php artisan db:seed --class=SkillSeeder`: Seed the database with seeder class `SkillSeeder`.
   - `php artisan db:seed --class=SkillUserSeeder`: Seed the database with seeder class `SkillUserSeeder`.
   - `php artisan db:seed --class=CvSeeder`: Seed the database with seeder class `CvSeeder`.
6. Run the following commands to start the local servers:
   - `php artisan serve`: Starts the php server.
   - Start a MySql server on your local machine.
   - `npm run dev`: It starts the Node.js server.

**_Note:_** Please, keep the sequence of the seeds.

## Contributors

- Hristo Hristov

## License

This project is open-source and available under the [MIT License](https://opensource.org/license/mit/).