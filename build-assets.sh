#!/usr/bin/env sh

# abort on errors
set -e

# build
npm run build


# navigate into the build output directory
cd ~/www/blog/

# if you are deploying to a custom domain
php artisan vendor:publish --tag="blog-livewire-assets" --force


cd ~/www/book-a-prof/


php artisan vendor:publish --tag="blog-livewire-assets" --force
