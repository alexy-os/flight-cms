import path from 'path';

export default {
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
      '@root': path.resolve(__dirname, '../../'),
      '@public': path.resolve(__dirname, '../../public'),
      '@assets': path.resolve(__dirname, '../../public/assets'),
    },
  },
};