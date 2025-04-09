import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import path from "path"

export default defineConfig({
  plugins: [
    tailwindcss(),
  ],
  optimizeDeps: {
    exclude: ['@tailwindcss/vite']
  },
  build: {
    outDir: '../../public/assets/css',
    emptyOutDir: false,
    rollupOptions: {
      input: path.resolve(__dirname, 'src/import.css'),
      output: {
        assetFileNames: 'tailwind.css'
      }
    },
    minify: false
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
      '@root': path.resolve(__dirname, '../../'),
      '@public': path.resolve(__dirname, '../../public'),
      '@assets': path.resolve(__dirname, '../../public/assets'),
    },
  },
});