import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  server: {
    host: '0.0.0.0', // 外部アクセスを許可する設定
    port: 5173, // 使用するポート
    strictPort: true, // ポートが利用できなければエラーを返す
    hmr: {
      host: 'ec2-35-77-73-212.ap-northeast-1.compute.amazonaws.com', // EC2 のパブリックホスト名
      port: 5173, // HMR（Hot Module Replacement）用のポート
    },
  },
});
