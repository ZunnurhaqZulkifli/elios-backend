import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.jsx'],
      refresh: true,
      ssr: 'resources/js/ssr.jsx',
    }),
    react(),
    // i18n(),
    // viteStaticCopy({
    //   targets: [
    //     {
    //       src: ['resources/images/'],
    //       dest: '',
    //     },
    //   ],
    // }),
  ],
  esbuild: {
    jsx: 'automatic',
  },
});
