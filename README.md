# admin-laravel-primevue

This template is built with PHP Laravel and Vue.js for SPA web application. It's free to use, It made with laravel x10, vuejs x3, Tailwindcss, webmix, and primevue with [Sakai CLI](https://github.com/primefaces/sakai-vue) free template.

<p align="center">
  <img src="https://github.com/islamsamy214/admin-laravel-primevue/blob/master/public/admin-screenshot.png?raw=true" alt="Screenshot of Admin Dashboard">
</p>

## Installation Steps

1. Clone the repository.
2. Create a MySQL database with your favorite name ex:"blogs".
3. Run the following commands:

```
composer install
```

```
cat .env.example > .env
```

```
php artisan key:generate
```

4. Customize the vars in the `.env` file with your database info.
5. Run migration and seed:

```
php artisan migrate --seed
```

6. Install npm packages and build assets:

```
npm install && npm run production

```

7. Start the application:

```
php artisan serve
```

and open this URL in your browser `127.0.0.1:8000`
use this these credentials for login email: `super_admin@app.com` pass: `12345678`

## Development

For development, you can run:

```
npm run watch
```

or

```
npm run hot
```

## Donation

If you find this helpful, consider buying me a coffee :)

<center>

[![QR Code for Donation](https://github.com/islamsamy214/admin-laravel-vue-bootstrap/blob/master/public/bmc_qr.png?raw=true)](https://www.buymeacoffee.com/islamsamy)

</center>
