import axios from 'axios';

// Create an axios instance with default configuration
const apiClient = axios.create({
    baseURL: '/api', // Adjust this if your API has a different base URL
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
});

// Add request interceptor to include CSRF token and Authorization header
apiClient.interceptors.request.use((config) => {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (token) {
        config.headers['X-CSRF-TOKEN'] = token;
    }
    
    // Add Bearer token for API authentication
    const apiToken = window.apiToken || document.querySelector('meta[name="api-token"]')?.getAttribute('content');
    if (apiToken) {
        config.headers['Authorization'] = `Bearer ${apiToken}`;
    }
    
    return config;
});

// Add response interceptor for error handling
apiClient.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
          console.log('Unauthorized access - perhaps redirect to login?');
            // Handle unauthorized access
            // window.location.href = '/login';
        }
        return Promise.reject(error);
    }
);

// Users API functions
export const usersApi = {
    // Get all users
    getUsers: async (params = {}) => {
        const response = await apiClient.get('/users', { params });
        return response.data;
    },

    // Get single user
    getUser: async (id) => {
        const response = await apiClient.get(`/users/${id}`);
        return response.data;
    },

    // Create user
    createUser: async (userData) => {
        const response = await apiClient.post('/users', userData);
        return response.data;
    },

    // Update user
    updateUser: async (id, userData) => {
        const response = await apiClient.put(`/users/${id}`, userData);
        return response.data;
    },

    // Delete user
    deleteUser: async (id) => {
        const response = await apiClient.delete(`/users/${id}`);
        return response.data;
    },

    // Search users
    searchUsers: async (query) => {
        const response = await apiClient.get('/users/search', { 
            params: { q: query } 
        });
        return response.data;
    },
};

export default apiClient;
