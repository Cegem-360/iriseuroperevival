# Europe Revival 2026 - Laravel Website

A modern, responsive conference website built with Laravel, Livewire, and Tailwind CSS. Designed based on the RightNow Conference visual style with dark theme, amber accents, and premium aesthetics.

## 🎨 Design System

### Colors
- **Primary (Amber):** `#F59E0B` - Main accent color
- **Secondary (Orange):** `#F97316` - Gradient partner
- **Background:** Stone 950 (`#0C0A09`) - Dark theme base
- **Text:** White with various opacities

### Typography
- **Font:** Inter (Google Fonts)
- **Weights:** 300-900

### Key Visual Elements
- Video backgrounds with gradient overlays
- Glassmorphism cards with backdrop blur
- Noise texture overlays
- Amber glow effects
- Smooth CSS animations

## 📁 Project Structure

```
europe-revival/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   └── RegistrationController.php
│   ├── Livewire/
│   │   └── RegistrationForm.php
│   ├── Models/
│   │   └── Registration.php
│   └── Services/
│       └── StripeService.php
├── database/migrations/
│   └── 2024_01_01_000001_create_registrations_table.php
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── components/
│   │   │   ├── navigation.blade.php
│   │   │   └── footer.blade.php
│   │   ├── livewire/
│   │   │   └── registration-form.blade.php
│   │   ├── pages/
│   │   │   ├── register.blade.php
│   │   │   └── register-success.blade.php
│   │   └── home.blade.php
├── routes/
│   └── web.php
└── tailwind.config.js
```

## 🚀 Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL/PostgreSQL

### Setup Steps

1. **Clone & Install Dependencies**
```bash
git clone [repository-url]
cd europe-revival
composer install
npm install
```

2. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Configure .env**
```env
APP_NAME="Europe Revival 2026"
APP_URL=https://europerevival.org

DB_CONNECTION=mysql
DB_DATABASE=europe_revival

STRIPE_KEY=pk_live_xxx
STRIPE_SECRET=sk_live_xxx
STRIPE_WEBHOOK_SECRET=whsec_xxx
```

4. **Database Migration**
```bash
php artisan migrate
```

5. **Build Assets**
```bash
npm run build
```

6. **Start Development Server**
```bash
php artisan serve
npm run dev
```

## 📦 Required Packages

```bash
# Laravel Livewire
composer require livewire/livewire

# Stripe Integration
composer require stripe/stripe-php

# Tailwind Plugins
npm install @tailwindcss/typography @tailwindcss/forms
```

## 🎯 Features

### Homepage Sections
1. **Hero** - Video background, animated elements, CTA buttons
2. **Speakers** - Grid layout with hover effects
3. **Theme** - Two-column layout with artwork
4. **Schedule** - Tabbed interface (Training/Main Conference)
5. **Pricing** - Dynamic tier selection with Alpine.js
6. **Travel** - Map, venue info, hotel recommendations
7. **Sponsors** - Partner logos grid
8. **FAQ** - Accordion with Alpine.js collapse
9. **Final CTA** - Glow effects, registration prompt

### Registration System
- Multi-step form with Livewire
- Three registration types: Attendee, Ministry Team, Volunteer
- Stripe Checkout integration
- Email confirmations
- Approval workflow for ministry applications

### Pricing Tiers
| Tier | Period | Individual | Team |
|------|--------|------------|------|
| Early Bird | Until June 30 | €49 | €39 |
| Regular | July 1 - Aug 31 | €59 | €49 |
| Late | Sept 1+ | €69 | €59 |

## 🖼️ Required Assets

### Images
```
public/images/
├── europe-revival-logo.svg
├── encounter-jesus-tagline.webp
├── encounter-jesus-artwork.webp
├── hero-video-thumbnail.webp
├── budapest-map.webp
├── og-image.jpg
├── speakers/
│   ├── heidi-baker.webp
│   ├── mel-tari.webp
│   ├── david-gava.webp
│   ├── pastor-josef.webp
│   ├── mary-pat-gokee.webp
│   ├── katey-maddux.webp
│   └── baoyan-lam.webp
├── hotels/
│   ├── hotel-1.webp
│   ├── hotel-2.webp
│   └── hotel-3.webp
├── sponsors/
│   ├── iris-global.svg
│   └── partner-[1-4].svg
└── textures/
    ├── noise.png
    └── transition-subtle.webp
```

### Videos
```
public/videos/
└── worship-background.mp4
```

## 🔧 Customization

### Adding New Speakers
Edit `home.blade.php` speaker grid section or create a Speaker model with seeder.

### Modifying Colors
Update `tailwind.config.js` primary/accent colors:
```javascript
colors: {
    primary: {
        500: '#F59E0B', // Change this
    }
}
```

### Adding Languages
1. Add translation files in `resources/lang/`
2. Update navigation language switcher
3. Add language route in `web.php`

## 📧 Webhook Setup (Stripe)

Configure webhook endpoint in Stripe Dashboard:
```
URL: https://yoursite.com/webhooks/stripe
Events: checkout.session.completed, payment_intent.succeeded
```

## 🚢 Deployment

### Laravel Forge / Vapor
Standard Laravel deployment with:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### Environment Variables
Ensure all production env vars are set:
- `APP_ENV=production`
- `APP_DEBUG=false`
- Stripe live keys
- Mail configuration

## 📝 License

This project is proprietary software for Europe Revival / Iris Global.

## 👥 Credits

- Design inspired by [RightNow Conference](https://www.rightnowconferences.org/)
- Built with Laravel, Livewire, Tailwind CSS
- Icons from Heroicons
