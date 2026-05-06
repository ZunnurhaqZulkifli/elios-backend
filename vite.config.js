import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

import { cloudflare } from "@cloudflare/vite-plugin";

export default defineConfig({
  plugins: [laravel({
    input: ['resources/css/app.css', 'resources/js/app.jsx'],
    refresh: true,
    ssr: 'resources/js/ssr.jsx',
  }), // i18n(),
  // viteStaticCopy({
  //   targets: [
  //     {
  //       src: ['resources/images/'],
  //       dest: '',
  //     },
  //   ],
  // }),
  react(), cloudflare()],
  esbuild: {
    jsx: 'automatic',
  },
});