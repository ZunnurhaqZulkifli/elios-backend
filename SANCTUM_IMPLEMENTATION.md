# Laravel Sanctum Implementation

## 🔐 What's Implemented

### 1. **Laravel Sanctum Setup**
- ✅ Sanctum package installed and configured
- ✅ Personal access tokens table migrated
- ✅ User model updated with HasApiTokens trait
- ✅ Sanctum middleware configured for API routes

### 2. **Token Generation on Login**
- ✅ Automatic token creation when user logs in
- ✅ Token stored in user session
- ✅ Old tokens revoked on new login (security)
- ✅ Token shared with frontend via Inertia

### 3. **Token Management**
- ✅ Custom middleware to share API tokens with frontend
- ✅ React hook to manage API tokens
- ✅ Axios interceptor to include Bearer token in requests
- ✅ Token cleanup on logout

### 4. **API Authentication**
- ✅ API routes protected with `auth:sanctum` middleware
- ✅ Frontend automatically includes Bearer token in API calls
- ✅ Seamless integration between web and API authentication

## 🚀 How It Works

### **Token Flow:**

1. **User logs in** → `AuthenticatedSessionController@store`
2. **Old tokens deleted** (security best practice)
3. **New token created** using `$user->createToken('web-session')`
4. **Token stored in session** for frontend access
5. **Token shared via Inertia** through `ShareApiToken` middleware
6. **Frontend receives token** and stores it globally
7. **API calls include Bearer token** via axios interceptor

### **Authentication Process:**

```
Web Login → Sanctum Token → API Requests
    ↓           ↓              ↓
  Session   Bearer Token   auth:sanctum
```

## 🔧 Configuration Files

### **Sanctum Config** (`config/sanctum.php`)
```php
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
    Sanctum::currentApplicationUrlWithPort(),
))),

'guard' => ['web'],
'expiration' => null, // Tokens don't expire
```

### **API Routes** (`routes/api.php`)
```php
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', UsersApiController::class);
    Route::get('users/search', [UsersApiController::class, 'search']);
});
```

### **User Model** (`app/Models/User.php`)
```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    // ...
}
```

## 🔑 Token Management

### **Login Process** (`AuthenticatedSessionController`)
```php
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // Create Sanctum token
    $user = Auth::user();
    $user->tokens()->delete(); // Remove old tokens
    $token = $user->createToken('web-session')->plainTextToken;
    $request->session()->put('api_token', $token);

    return redirect()->intended(route('dashboard'));
}
```

### **Logout Process**
```php
public function destroy(Request $request): RedirectResponse
{
    // Revoke all tokens
    if (Auth::user()) {
        Auth::user()->tokens()->delete();
    }

    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
```

## 🎯 Frontend Integration

### **API Service** (`resources/js/services/api.js`)
```javascript
// Axios interceptor automatically adds Bearer token
apiClient.interceptors.request.use((config) => {
    // CSRF Token
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (token) {
        config.headers['X-CSRF-TOKEN'] = token;
    }
    
    // Bearer Token for API
    const apiToken = window.apiToken || document.querySelector('meta[name="api-token"]')?.getAttribute('content');
    if (apiToken) {
        config.headers['Authorization'] = `Bearer ${apiToken}`;
    }
    
    return config;
});
```

### **Token Hook** (`resources/js/hooks/useApiToken.js`)
```javascript
export function useApiToken() {
    const { props } = usePage();
    const apiToken = props.apiToken;

    useEffect(() => {
        if (apiToken) {
            window.apiToken = apiToken;
            // Also set as meta tag for backup
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
```

### **Layout Integration** (`MasterLayout.jsx`)
```javascript
export default function MasterLayout({ header, children, title }) {
    // Initialize API token for Sanctum authentication
    useApiToken();
    
    // ... rest of component
}
```

## 🔒 Security Features

### **Token Security:**
- ✅ **Single Active Token**: Old tokens are deleted on new login
- ✅ **Session Tied**: Token is tied to user session
- ✅ **Auto Cleanup**: Tokens are removed on logout
- ✅ **No Expiration**: Tokens last as long as the session (configurable)

### **Request Security:**
- ✅ **CSRF Protection**: Web routes protected with CSRF tokens
- ✅ **Bearer Authentication**: API routes use Bearer token authentication
- ✅ **Stateful Domains**: Sanctum configured for your domains
- ✅ **Middleware Protection**: EnsureFrontendRequestsAreStateful middleware

## 🧪 Testing the Implementation

### **1. Login to your application**
```
POST /login
```

### **2. Check if token is created**
```bash
php artisan tinker
>>> App\Models\User::first()->tokens
```

### **3. Test API endpoints**
```javascript
// In browser console after login
fetch('/api/users', {
    headers: {
        'Authorization': `Bearer ${window.apiToken}`,
        'Accept': 'application/json'
    }
})
```

### **4. Use TanStack Query example**
Visit `/users/tanstack-example` and see the API calls working automatically with Sanctum authentication.

## 📊 Benefits

✅ **Seamless Authentication**: Web and API share the same auth state  
✅ **Security**: Proper token management and cleanup  
✅ **Performance**: No need for session-based API calls  
✅ **Scalability**: Ready for SPA or mobile app integration  
✅ **Developer Experience**: Automatic token handling  

## 🚀 Ready to Use

Your application now has:
- Automatic token generation on login
- Secure API authentication with Sanctum
- TanStack Query working with Bearer tokens
- Proper token cleanup and security measures

Just log in to your application and start using the API endpoints!
