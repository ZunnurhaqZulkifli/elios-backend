import '../css/app.css';
import './bootstrap';

import { createInertiaApp, router } from '@inertiajs/react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';

const appName = import.meta.env.VITE_APP_NAME || 'Elios';
const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      retry: (failureCount, err) => {
        if (err.response?.status === 401) {
          router.reload();
          return false; // do not retry, trigger error
        }

        // otherwise, restore default
        const defaultRetry = new QueryClient().getDefaultOptions().queries?.retry;

        return Number.isSafeInteger(defaultRetry) ? failureCount < (defaultRetry ?? 0) : false;
      },
    },
  },
});

createInertiaApp({
    id: 'app',
    title: title => (title ? `${title} / ${appName}` : appName),
    resolve: name => resolvePageComponent(`./pages/${name}.jsx`, import.meta.glob('./pages/**/*.jsx')),
    setup({ el, App, props }) {
         const appElement = (
            <QueryClientProvider client={queryClient}>
                <App {...props} />
            </QueryClientProvider>
        );

        createRoot(el).render(appElement);
    },
    progress: {
        color: '#4B5563',
    },
});
