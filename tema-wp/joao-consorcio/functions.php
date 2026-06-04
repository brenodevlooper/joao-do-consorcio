<?php
function joao_consorcio_assets() {
    wp_enqueue_style('google-fonts',
        'https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap',
        [], null
    );
    wp_enqueue_style('font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [], '6.5.0'
    );
    wp_enqueue_style('aos-css',
        'https://unpkg.com/aos@2.3.4/dist/aos.css',
        [], '2.3.4'
    );
    wp_enqueue_script('tailwind',
        'https://cdn.tailwindcss.com',
        [], null, false
    );
    wp_enqueue_script('aos-js',
        'https://unpkg.com/aos@2.3.4/dist/aos.js',
        [], '2.3.4', true
    );
}
add_action('wp_enqueue_scripts', 'joao_consorcio_assets');

add_theme_support('title-tag');
