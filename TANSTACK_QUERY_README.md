# TanStack Query Implementation Example

This project demonstrates how to integrate TanStack Query (React Query) with a Laravel + Inertia.js application.

## 🚀 What's Implemented

### 1. **TanStack Query Setup**
- ✅ QueryClient configured with error handling
- ✅ QueryClientProvider wrapping the entire app
- ✅ React Query DevTools for debugging
- ✅ Automatic retry logic with authentication handling

### 2. **API Service Layer** (`/resources/js/services/api.js`)
- ✅ Axios instance with CSRF token handling
- ✅ Request/response interceptors
- ✅ Users API functions (CRUD operations)
- ✅ Search functionality

### 3. **Custom Hooks** (`/resources/js/hooks/useUsers.js`)
- ✅ `useUsers()` - Fetch paginated users
- ✅ `useUser(id)` - Fetch single user
- ✅ `useUsersSearch(query)` - Search users
- ✅ `useCreateUser()` - Create new user
- ✅ `useUpdateUser()` - Update existing user
- ✅ `useDeleteUser()` - Delete user

### 4. **Example Component** (`/resources/js/Pages/users/tanstack-example.jsx`)
- ✅ Real-time data fetching with loading states
- ✅ Error handling and retry functionality
- ✅ Search with debouncing
- ✅ Optimistic updates
- ✅ Cache invalidation
- ✅ Mutation loading states

### 5. **Backend API** (`/app/Http/Controllers/Api/UsersApiController.php`)
- ✅ RESTful API endpoints
- ✅ Pagination support
- ✅ Search functionality
- ✅ Validation and error handling

## 🛠 How to Use

### 1. **Basic Query Usage**
```jsx
import { useUsers } from '@/hooks/useUsers';

function UsersList() {
    const { data, isLoading, isError, error } = useUsers({ page: 1, per_page: 10 });
    
    if (isLoading) return <div>Loading...</div>;
    if (isError) return <div>Error: {error.message}</div>;
    
    return (
        <div>
            {data?.data?.map(user => (
                <div key={user.id}>{user.name}</div>
            ))}
        </div>
    );
}
```

### 2. **Mutation Usage**
```jsx
import { useCreateUser } from '@/hooks/useUsers';

function CreateUserForm() {
    const createUser = useCreateUser();
    
    const handleSubmit = async (userData) => {
        try {
            await createUser.mutateAsync(userData);
            alert('User created successfully!');
        } catch (error) {
            alert('Error: ' + error.message);
        }
    };
    
    return (
        <button 
            onClick={() => handleSubmit({ name: 'John', email: 'john@example.com' })}
            disabled={createUser.isPending}
        >
            {createUser.isPending ? 'Creating...' : 'Create User'}
        </button>
    );
}
```

### 3. **Search with Real-time Results**
```jsx
import { useState } from 'react';
import { useUsersSearch } from '@/hooks/useUsers';

function UserSearch() {
    const [searchQuery, setSearchQuery] = useState('');
    const { data, isLoading } = useUsersSearch(searchQuery);
    
    return (
        <div>
            <input 
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search users..."
            />
            {isLoading && <div>Searching...</div>}
            {data?.data?.map(user => (
                <div key={user.id}>{user.name} - {user.email}</div>
            ))}
        </div>
    );
}
```

## 🔧 Configuration

### Query Client Setup (`/resources/js/app.jsx`)
```jsx
const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      retry: (failureCount, err) => {
        // Don't retry on 401 errors
        if (err.response?.status === 401) {
          router.reload();
          return false;
        }
        return failureCount < 3;
      },
      staleTime: 5 * 60 * 1000, // 5 minutes
      cacheTime: 10 * 60 * 1000, // 10 minutes
    },
  },
});
```

### API Routes (`/routes/api.php`)
```php
Route::middleware(['auth:web'])->group(function () {
    Route::apiResource('users', UsersApiController::class);
    Route::get('users/search', [UsersApiController::class, 'search']);
});
```

## 🎯 Key Features

### **Automatic Cache Management**
- Queries are automatically cached and reused
- Smart cache invalidation on mutations
- Background refetching for stale data

### **Optimistic Updates**
- UI updates immediately on mutations
- Automatic rollback on error
- Seamless user experience

### **Error Handling**
- Automatic retry with exponential backoff
- Authentication error handling
- User-friendly error messages

### **Performance Optimizations**
- Request deduplication
- Background refetching
- Intelligent caching strategies

### **Developer Experience**
- React Query DevTools
- TypeScript-ready (if using TS)
- Clear separation of concerns

## 🌐 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/users` | Get paginated users |
| GET | `/api/users/{id}` | Get single user |
| POST | `/api/users` | Create new user |
| PUT | `/api/users/{id}` | Update user |
| DELETE | `/api/users/{id}` | Delete user |
| GET | `/api/users/search?q=query` | Search users |

## 🔍 React Query DevTools

The DevTools are automatically included in development mode. Look for the React Query logo in the bottom corner of your browser to:

- Inspect query states
- View cached data
- Debug network requests
- Monitor background refetches

## 📱 Example Page

Visit `/users/tanstack-example` to see the full implementation in action:

- Real-time user list with pagination
- Live search functionality
- Create, update, and delete operations
- Loading states and error handling
- Cache invalidation and optimistic updates

## 🚦 Getting Started

1. The TanStack Query is already installed and configured
2. API routes are set up and ready to use
3. Database migration for user roles/status is applied
4. Example page is available at `/users/tanstack-example`

Just start using the hooks in your components and enjoy the powerful data fetching capabilities!
