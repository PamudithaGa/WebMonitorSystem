# 🌐 NexusMonitor

> A Smart Website Monitoring & Reporting System – built to automate SSL alerts, SEO audits, uptime tracking, and scheduled reporting.

---

## 📌 Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage Guide](#usage-guide)
- [Scheduled Tasks](#scheduled-tasks)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)

---

## 🚀 Introduction

**NexusMonitor** is an advanced Laravel-based system designed to monitor websites, check SSL certificate expirations, evaluate SEO performance, and generate reports (daily, weekly, monthly). It automates tedious web health checks and helps teams stay proactive with alerts and insights.

---

## ✅ Features

- ✅ Website Uptime Monitoring (every minute)
- ✅ SSL Expiry Alerts (email notifications + calendar view)
- ✅ SEO Auditing (title, meta, H1, canonical, page speed)
- ✅ Daily, Weekly, Monthly PDF Reports
- ✅ FullCalendar integration for SSL & SEO events
- ✅ Admin/User Dashboards
- ✅ Laravel Schedule + Notifications

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11, PHP 8.2.12
- **Database:** MySQL / MongoDB (flexible support)
- **Frontend:** Blade, Tailwind CSS, Alpine.js
- **Notifications:** Laravel Notification Channels (Mail)
- **Reports:** DomPDF
- **Scheduler:** Laravel Scheduler (via `cron`)
- **SEO:** Guzzle + Google PageSpeed API
- **SSL Check:** stream_socket_client + OpenSSL
- **Auth:** Laravel Breeze + Sanctum

---

| Command                  | Frequency       | Purpose                       |
| ------------------------ | --------------- | ----------------------------- |
| `monitor:check-websites` | Every Minute    | Checks uptime of all websites |
| `monitor:check-ssl`      | Daily           | Updates and stores SSL expiry |
| `seo:check`              | Daily @ 2:00 AM | SEO audit via Guzzle          |
| `report notification`    | Daily @ 4:30 PM | Sends report email summary    |
| `SSL alert emails`       | Daily @ 8:00 AM | Sends SSL expiry reminders    |



---

