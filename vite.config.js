import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import path from 'path';

export default defineConfig({
  plugins: [
    liveReload([__dirname + '/**/*.php'])
  ],
  base: process.env.NODE_ENV === 'development' 
    ? '/' 
    : '/wp-content/plugins/ellens-lentze/assets/dist/',
  build: {
    outDir: 'assets/dist',
    assetsDir: '', // Assets directly in dist
    manifest: true,
    emptyOutDir: true,
    rollupOptions: {
      input: {
        // Global CSS
        'reset': path.resolve(__dirname, 'assets/css/globals/reset.css'),
        'variables': path.resolve(__dirname, 'assets/css/globals/variables.css'),
        'utilities': path.resolve(__dirname, 'assets/css/globals/utilities.css'),
        'buttons': path.resolve(__dirname, 'assets/css/globals/buttons.css'),
        
        // Global JS
        'button-animations': path.resolve(__dirname, 'assets/js/button-animations.js'),

        // Widget CSS
        'hero': path.resolve(__dirname, 'widgets/hero/assets/css/hero.css'),
        'action-buttons': path.resolve(__dirname, 'widgets/action-buttons/assets/css/action-buttons.css'),
        'usp-grid': path.resolve(__dirname, 'widgets/usp-grid/assets/css/usp-grid.css'),
        'image-text-block': path.resolve(__dirname, 'widgets/image-text-block/assets/css/image-text-block.css'),
        'services-cluster': path.resolve(__dirname, 'widgets/services-cluster/assets/css/services-cluster.css'),
        'team-slider': path.resolve(__dirname, 'widgets/team-slider/assets/css/team-slider.css'),
        'team-grid': path.resolve(__dirname, 'widgets/team-grid/assets/css/team-grid.css'),
        'post-grid': path.resolve(__dirname, 'widgets/post-grid/assets/css/post-grid.css'),
        'services-grid': path.resolve(__dirname, 'widgets/services-grid/assets/css/services-grid.css'),
        'detailed-info-section': path.resolve(__dirname, 'widgets/detailed-info-section/assets/css/detailed-info-section.css'),
        'faq-section': path.resolve(__dirname, 'widgets/faq-section/assets/css/faq-section.css'),
        'sidebar-faq': path.resolve(__dirname, 'widgets/sidebar-faq/assets/css/sidebar-faq.css'),
        'reliability-grid': path.resolve(__dirname, 'widgets/reliability-grid/assets/css/reliability-grid.css'),
        'menu': path.resolve(__dirname, 'widgets/menu/assets/css/menu.css'),
        'footer': path.resolve(__dirname, 'widgets/footer/assets/css/footer.css'),
        'news-overview': path.resolve(__dirname, 'widgets/news-overview/assets/css/news-overview.css'),
        'contact-info': path.resolve(__dirname, 'widgets/contact-info/assets/css/contact-info.css'),

        // Widget JS
        'hero-card-position': path.resolve(__dirname, 'widgets/hero/assets/js/hero-card-position.js'),
        'team-slider-js': path.resolve(__dirname, 'widgets/team-slider/assets/js/team-slider.js'),
        'faq-accordion': path.resolve(__dirname, 'widgets/faq-section/assets/js/faq-accordion.js'),
        'menu-handler': path.resolve(__dirname, 'widgets/menu/assets/js/menu-handler.js'),
        'menu-search': path.resolve(__dirname, 'widgets/menu/assets/js/menu-search.js'),
        'news-overview-js': path.resolve(__dirname, 'widgets/news-overview/assets/js/news-overview.js'),
      }
    }
  },
  server: {
    cors: true,
    strictPort: true,
    port: 5173,
    hmr: {
        host: 'localhost',
    },
  }, 
});
