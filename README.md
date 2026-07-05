# NTUPROBUDCAM Website

National Trade Union of Professional Bus Drivers of Cameroon - Official Website

## Overview

NTUPROBUDCAM is a professional organization dedicated to promoting professionalism, dignity, and safety in road transport across Cameroon. This website provides information about the union, its leadership, services, and membership opportunities.

## Features

### Public Features
- **Home Page** - Overview of the organization and key information
- **About Us** - Detailed information about NTUPROBUDCAM's mission and vision
- **Membership** - Online membership application with photo upload
- **Training Programs** - Various training courses (Defensive Driving, Customer Service, Vehicle Maintenance, First Aid, Leadership Development, Labor Rights)
- **Events** - Upcoming events and activities
- **News** - Latest news and announcements
- **Gallery** - Photo gallery of union activities
- **Documents** - Downloadable documents and resources
- **Leadership** - Information about the leadership team
- **Partners** - Partner organizations
- **Contact** - Contact form with email confirmation
- **Newsletter** - Newsletter subscription with email confirmation

### Admin Panel Features
- **Dashboard** - Overview of statistics and recent activities
- **News Management** - Add, edit, delete news articles
- **Events Management** - Manage upcoming events
- **Gallery Management** - Upload and manage gallery images
- **Documents Management** - Upload and manage documents
- **Leadership Management** - Manage leadership team profiles
- **Partners Management** - Manage partner organizations
- **Messages** - View and reply to contact messages
- **Newsletter Subscribers** - Manage newsletter subscriptions
- **Membership Applications** - Review and manage membership applications
- **Training Registrations** - Manage training program registrations with status updates
- **Send Messages** - Send emails to specific user groups or individual users
- **Settings** - Configure site settings

### Email Integration
- **PHPMailer Integration** - Reliable email delivery via SMTP
- **Email Confirmations**:
  - Training registration confirmations
  - Membership application confirmations
  - Contact message confirmations
  - Newsletter subscription confirmations
- **Admin Notifications**:
  - Training status updates (confirmed/cancelled)
  - Reply to contact messages
  - Bulk messaging to users

## Technology Stack

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Email**: PHPMailer
- **Icons**: Font Awesome
- **Animations**: AOS (Animate On Scroll)

## Installation

### Prerequisites
- XAMPP or WAMP server
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer (optional, for PHPMailer)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/Nganjibatexbashi/ntuprobudcam-website.git
   ```

2. **Configure Database**
   - Create a MySQL database named `ntuprobudcam`
   - Import the database schema from `database/schema.sql`
   - Update database credentials in `config/database.php`

3. **Configure Site Settings**
   - Update site configuration in `config/config.php`
   - Set SMTP credentials for email functionality

4. **Install PHPMailer**
   - PHPMailer is included in the `vendor/` directory
   - If using Composer, run: `composer require phpmailer/phpmailer`

5. **Configure Email Settings**
   - Update SMTP settings in `config/config.php`:
     ```php
     define('SMTP_HOST', 'smtp.gmail.com');
     define('SMTP_PORT', 587);
     define('SMTP_ENCRYPTION', 'tls');
     define('SMTP_USER', 'your-email@gmail.com');
     define('SMTP_PASS', 'your-app-password');
     define('SMTP_FROM', 'noreply@ntuprobudcam.org');
     define('SMTP_FROM_NAME', SITE_NAME);
     ```

6. **Set Up Directories**
   - Ensure upload directories exist and have write permissions:
     - `/uploads/leadership/`
     - `/uploads/members/`
     - `/uploads/gallery/`
     - `/uploads/documents/`

7. **Admin Access**
   - Default admin login: `admin` / `admin123`
   - Change default credentials after first login

## File Structure

```
bashi/
├── admin/                  # Admin panel
│   ├── dashboard.php
│   ├── news.php
│   ├── events.php
│   ├── gallery.php
│   ├── documents.php
│   ├── leadership.php
│   ├── partners.php
│   ├── messages.php
│   ├── newsletter.php
│   ├── membership.php
│   ├── training-registrations.php
│   ├── send-message.php
│   ├── settings.php
│   ├── login.php
│   └── logout.php
├── assets/                 # Static assets
│   ├── css/
│   ├── js/
│   └── images/
├── config/                 # Configuration files
│   ├── config.php
│   └── database.php
├── database/               # Database schema
│   └── schema.sql
├── includes/               # Reusable components
│   ├── header.php
│   ├── footer.php
│   ├── mailer.php
│   ├── training-registration.php
│   └── newsletter.php
├── uploads/                # Upload directories
│   ├── leadership/
│   ├── members/
│   ├── gallery/
│   └── documents/
├── vendor/                 # PHP dependencies
│   └── phpmailer/
├── index.php              # Home page
├── about.php              # About page
├── membership.php         # Membership application
├── training.php           # Training programs
├── contact.php            # Contact form
├── news.php               # News listing
├── events.php             # Events listing
├── gallery.php            # Gallery
├── documents.php          # Documents
├── leadership.php         # Leadership team
├── partners.php           # Partners
├── organization.php       # Organization structure
├── services.php           # Services
├── what-we-do.php         # What we do
├── road-safety.php        # Road safety information
├── faq.php                # FAQ
├── sitemap.xml            # Sitemap
├── robots.txt             # Robots file
└── README.md              # This file
```

## Database Schema

The database includes the following tables:
- `users` - Admin users
- `news` - News articles
- `events` - Events
- `gallery` - Gallery images
- `documents` - Documents
- `leadership` - Leadership team
- `partners` - Partner organizations
- `contact_messages` - Contact form submissions
- `newsletter` - Newsletter subscribers
- `membership_applications` - Membership applications
- `training_registrations` - Training program registrations
- `settings` - Site settings

## Email Configuration

### Gmail Setup
1. Enable 2-factor authentication on your Google account
2. Go to Google Account → Security → App Passwords
3. Generate a new app password
4. Use the app password in `SMTP_PASS`

### Other SMTP Providers
Update the SMTP settings in `config/config.php` according to your email provider's requirements.

## Security Considerations

- Change default admin credentials
- Use HTTPS in production
- Keep PHP and dependencies updated
- Regular database backups
- Validate and sanitize all user inputs
- Use prepared statements for database queries
- Implement CSRF protection for forms

## Deployment

### Production Deployment
1. Update `config/config.php` with production settings
2. Set proper file permissions
3. Configure HTTPS/SSL certificate
4. Set up regular backups
5. Monitor error logs
6. Use environment variables for sensitive data

## Support

For support or questions, please contact:
- Email: info@ntuprobudcam.org
- Website: https://ntuprobudcam.org

## License

This project is proprietary software for NTUPROBUDCAM. All rights reserved.

## Credits

- Developed for: National Trade Union of Professional Bus Drivers of Cameroon
- Development Team: [Your Development Team]
- Year: 2026

## Version History

- **v1.0.0** (July 2026) - Initial release with core features and PHPMailer integration
