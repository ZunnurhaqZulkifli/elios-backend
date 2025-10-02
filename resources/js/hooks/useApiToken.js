import { usePage } from '@inertiajs/react';
import { useEffect } from 'react';

export function useApiToken() {
    const { props } = usePage();
    const apiToken = props.apiToken;

    useEffect(() => {
        if (apiToken) {
            window.apiToken = apiToken;
            
            let metaTag = document.querySelector('meta[name="api-token"]');
            if (!metaTag) {
                metaTag = document.createElement('meta');
                metaTag.setAttribute('name', 'api-token');
                document.head.appendChild(metaTag);
            }
            metaTag.setAttribute('content', apiToken);
        }
    }, [apiToken]);

    return apiToken;
}
